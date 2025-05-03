<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLikesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'like_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'post_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'date_liked' => [
                'type'       => 'TIMESTAMP',
                'null'       => false,
                'default'    => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        
        $this->forge->addPrimaryKey('like_id');
        $this->forge->addForeignKey('user_id', 'user_table', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('post_id', 'posts_table', 'post_id', 'CASCADE', 'CASCADE');
        // Add unique constraint to prevent multiple likes from same user on same post
        $this->forge->addUniqueKey(['user_id', 'post_id']);
        $this->forge->createTable('likes_table');
    }

    public function down()
    {
        $this->forge->dropTable('likes_table');
    }
}