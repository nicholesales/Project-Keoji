<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts_table';
    protected $primaryKey = 'post_id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'user_id', 'title', 'category', 'image', 
        'description', 'featured', 'status'
    ];
    
    // If your table has created_at and updated_at fields
    protected $useTimestamps = true;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'updated_at';
    
    // Validation rules (optional)
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'category' => 'required',
        'description' => 'required'
    ];
}