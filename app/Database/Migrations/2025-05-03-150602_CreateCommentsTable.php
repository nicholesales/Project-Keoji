<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comment_id' => [
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
            'comment_text' => [
                'type'       => 'TEXT',
            ],
            'date_commented' => [
                'type'       => 'TIMESTAMP',
                'null'       => false,
                'default'    => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        
        $this->forge->addPrimaryKey('comment_id');
        $this->forge->addForeignKey('user_id', 'user_table', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('post_id', 'posts_table', 'post_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('comments_table');
    }

    public function down()
    {
        $this->forge->dropTable('comments_table');
    }
}