<?php

namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\HTTP\ResponseInterface;

class PostsController extends BaseController
{
    protected $postModel;
    protected $session;
    
    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }
    
    // Display all posts (main page after login)
    public function index()
    {
         // Check if user is logged in
    if (!$this->session->get('isLoggedIn')) {
        return redirect()->to('auth/login');
    }
    
    // Debug - check database connection and table structure
    try {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        log_message('debug', 'Database tables: ' . json_encode($tables));
        
        // Check if posts_table exists
        if (in_array('posts_table', $tables)) {
            $fields = $db->getFieldNames('posts_table');
            log_message('debug', 'posts_table fields: ' . json_encode($fields));
            
            // Check posts_table data
            $query = $db->query('SELECT * FROM posts_table LIMIT 5');
            $results = $query->getResultArray();
            log_message('debug', 'Sample posts data: ' . json_encode($results));
        } else {
            log_message('error', 'posts_table does not exist!');
        }
    } catch (\Exception $e) {
        log_message('error', 'Database error: ' . $e->getMessage());
    }
        
        // Debug - Log session data
        log_message('debug', 'User session data: ' . json_encode($this->session->get()));
        
       // Get all recent posts - ensure we're getting unique records
    // Use distinct() to avoid duplicates or group by post_id
    $data['recentPosts'] = $this->postModel->orderBy('date_created', 'DESC')
    ->groupBy('post_id') // Add this line
    ->findAll();

    // Get featured posts - ensure we're getting unique records
    $data['featuredPosts'] = $this->postModel->where('featured', true)
      ->groupBy('post_id') // Add this line
      ->findAll();
        
        // Get categories for dropdown
        $data['categories'] = ['Lifestyle', 'Travel', 'Food', 'Sports', 'News'];
        
        return view('posts/index', $data);
    }
    
    // Create a new post
    public function create()
    {
        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
        }
        
        // Get database connection for transaction
        $db = \Config\Database::connect();
        
        // Check for existing transaction and rollback if found
        if ($db->transStatus() === true) {
            $db->transRollback();
        }
        
        // Start a new transaction
        $db->transBegin();
        
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));
        log_message('debug', 'FILES data: ' . json_encode($this->request->getFiles()));
        
        try {
            // Make image field optional - this might be causing validation to fail
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'category' => 'required',
                'content' => 'required',
            ];
            
            // Check if image is uploaded
            $file = $this->request->getFile('image');
            if ($file && $file->isValid()) {
                $rules['image'] = 'max_size[image,10240]|mime_in[image,image/jpg,image/jpeg,image/png]|ext_in[image,jpg,jpeg,png]';
            }
            
            if (!$this->validate($rules)) {
                log_message('error', 'Validation errors: ' . json_encode($this->validator->getErrors()));
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false, 
                    'errors' => $this->validator->getErrors()
                ]);
            }
            
            // Handle file upload if provided
            $newName = null;
            if ($file && $file->isValid()) {
                $newName = $file->getRandomName();
                
                // Ensure upload directory exists
                $uploadPath = ROOTPATH . 'public/uploads/posts';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                try {
                    $file->move($uploadPath, $newName);
                    log_message('debug', 'File uploaded successfully: ' . $newName);
                } catch (\Exception $e) {
                    log_message('error', 'File upload error: ' . $e->getMessage());
                    $db->transRollback();
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Error uploading file: ' . $e->getMessage()
                    ]);
                }
            }
            
            // Determine post status (draft or published)
            $status = $this->request->getPost('status');
            
            // Save post to database
            $postData = [
                'user_id' => $this->session->get('user_id'),
                'title' => $this->request->getPost('title'),
                'category' => $this->request->getPost('category'),
                'description' => $this->request->getPost('content'),
                'image' => $newName,
                'featured' => $this->request->getPost('featured') ? true : false,
                'status' => $status
            ];
            
            $result = $this->postModel->insert($postData);
            log_message('debug', 'Post insert result: ' . json_encode($result));
            
            if (!$result) {
                log_message('error', 'Database insert error: ' . json_encode($this->postModel->errors()));
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error saving post to database',
                    'dbErrors' => $this->postModel->errors()
                ]);
            }
            
            // If we got here, commit the transaction
            $db->transCommit();
            
            return $this->response->setJSON([
                'success' => true, 
                'message' => 'Post ' . ($status === 'draft' ? 'saved as draft' : 'published') . ' successfully',
                'post_id' => $result
            ]);
        } catch (\Exception $e) {
            // Roll back transaction on any exception
            $db->transRollback();
            
            log_message('error', 'Exception during post creation: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
    
    // Edit, update, and delete methods remain the same...

    
    // Edit an existing post
    public function edit($id = null)
    {
        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
        }
        
        $post = $this->postModel->find($id);
        
        // Check if post exists and belongs to the user
        if (!$post || $post['user_id'] != $this->session->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Post not found or access denied']);
        }
        
        return $this->response->setJSON(['success' => true, 'post' => $post]);
    }
    
    // Update an existing post
    public function update($id = null)
    {
        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
        }
        
        $post = $this->postModel->find($id);
        
        // Check if post exists and belongs to the user
        if (!$post || $post['user_id'] != $this->session->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Post not found or access denied']);
        }
        
        // Validate form data
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'content' => 'required',
        ];
        
        // Check if image is uploaded
        $file = $this->request->getFile('image');
        if ($file && $file->isValid()) {
            $rules['image'] = 'max_size[image,1024]|mime_in[image,image/jpg,image/jpeg,image/png]|ext_in[image,jpg,jpeg,png]';
        }
        
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false, 
                'errors' => $this->validator->getErrors()
            ]);
        }
        
        // Handle file upload if new image is provided
        $imageName = $post['image'];
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/posts', $newName);
            $imageName = $newName;
            
            // Delete old image
            if (file_exists(ROOTPATH . 'public/uploads/posts/' . $post['image'])) {
                unlink(ROOTPATH . 'public/uploads/posts/' . $post['image']);
            }
        }
        
        // Determine post status (draft or published)
        $status = $this->request->getPost('status');
        
        // Update post in database
        $postData = [
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('content'),
            'image' => $imageName,
            'featured' => $this->request->getPost('featured') ? true : false,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->postModel->update($id, $postData);
        
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Post updated successfully'
        ]);
    }
    
    // Delete a post
    public function delete($id = null)
    {
        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
        }
        
        $post = $this->postModel->find($id);
        
        // Check if post exists and belongs to the user
        if (!$post || $post['user_id'] != $this->session->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Post not found or access denied']);
        }
        
        // Delete image file
        if (file_exists(ROOTPATH . 'public/uploads/posts/' . $post['image'])) {
            unlink(ROOTPATH . 'public/uploads/posts/' . $post['image']);
        }
        
        // Delete post from database
        $this->postModel->delete($id);
        
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Post deleted successfully'
        ]);
    }
}