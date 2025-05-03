<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts_table';
    protected $primaryKey = 'post_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'user_id', 'title', 'category', 'image', 'description', 'featured'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'date_created';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'user_id' => 'required|integer',
        'title' => 'required|min_length[3]|max_length[255]',
        'description' => 'required'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required',
            'integer' => 'User ID must be a number'
        ],
        'title' => [
            'required' => 'Title is required',
            'min_length' => 'Title must be at least 3 characters long'
        ],
        'description' => [
            'required' => 'Description is required'
        ]
    ];

    protected $skipValidation = false;
    
    // Get post with user information
    public function getPostWithUser($postId = null)
    {
        if ($postId === null) {
            return $this->select('posts_table.*, user_table.username, user_table.profile_photo')
                        ->join('user_table', 'user_table.user_id = posts_table.user_id')
                        ->orderBy('date_created', 'DESC')
                        ->findAll();
        }
        
        return $this->select('posts_table.*, user_table.username, user_table.profile_photo')
                    ->join('user_table', 'user_table.user_id = posts_table.user_id')
                    ->where('posts_table.post_id', $postId)
                    ->first();
    }
    
    // Get posts by user ID
    public function getPostsByUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('date_created', 'DESC')
                    ->findAll();
    }
}