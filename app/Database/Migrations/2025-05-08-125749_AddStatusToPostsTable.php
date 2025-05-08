<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts_table', [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'published',
                'after'      => 'featured'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts_table', 'status');
    }
}