<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments_table';
    protected $primaryKey = 'comment_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'user_id', 'post_id', 'comment_text'
    ];

    // Dates
    protected $useTimestamps = false;
    
    // Validation
    protected $validationRules = [
        'user_id' => 'required|integer',
        'post_id' => 'required|integer',
        'comment_text' => 'required'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required',
            'integer' => 'User ID must be a number'
        ],
        'post_id' => [
            'required' => 'Post ID is required',
            'integer' => 'Post ID must be a number'
        ],
        'comment_text' => [
            'required' => 'Comment text is required'
        ]
    ];

    protected $skipValidation = false;
    
    // Get comments with user information for a post
    public function getCommentsWithUser($postId)
    {
        return $this->select('comments_table.*, user_table.username, user_table.profile_photo')
                    ->join('user_table', 'user_table.user_id = comments_table.user_id')
                    ->where('comments_table.post_id', $postId)
                    ->orderBy('date_commented', 'DESC')
                    ->findAll();
    }
    
    // Count comments on a post
    public function countCommentsOnPost($postId)
    {
        return $this->where('post_id', $postId)->countAllResults();
    }
}