<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_table';
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'username', 'email', 'password', 'profile_photo', 'bio', 
        'is_admin', 'security_question', 'security_answer'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[30]|is_unique[user_table.username,user_id,{user_id}]',
        'email' => 'required|valid_email|is_unique[user_table.email,user_id,{user_id}]',
        'password' => 'required|min_length[8]',
        'security_question' => 'required',
        'security_answer' => 'required'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required',
            'min_length' => 'Username must be at least 3 characters long',
            'is_unique' => 'This username is already taken'
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique' => 'This email is already registered'
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 8 characters long'
        ],
        'security_question' => [
            'required' => 'Security question is required'
        ],
        'security_answer' => [
            'required' => 'Security answer is required'
        ]
    ];

    protected $skipValidation = false;
    
    // Hash password before insert or update
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
    
    public function beforeInsert(array $data)
    {
        return $this->hashPassword($data);
    }
    
    public function beforeUpdate(array $data)
    {
        return $this->hashPassword($data);
    }
}