<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'likes_table';
    protected $primaryKey = 'like_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'user_id', 'post_id'
    ];

    // Dates
    protected $useTimestamps = false;
    
    // Validation
    protected $validationRules = [
        'user_id' => 'required|integer',
        'post_id' => 'required|integer'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required',
            'integer' => 'User ID must be a number'
        ],
        'post_id' => [
            'required' => 'Post ID is required',
            'integer' => 'Post ID must be a number'
        ]
    ];

    protected $skipValidation = false;
    
    // Check if user has liked post
    public function hasUserLiked($userId, $postId)
    {
        return $this->where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->countAllResults() > 0;
    }
    
    // Count likes on a post
    public function countLikesOnPost($postId)
    {
        return $this->where('post_id', $postId)->countAllResults();
    }
    
    // Get likes by user
    public function getLikesByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}