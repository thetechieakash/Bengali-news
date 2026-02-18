<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostViewsTable extends Migration
{
    public function up()
    {
        // Create post_views table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'post_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'viewed_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('post_id');
        $this->forge->addKey('ip_address');

        $this->forge->createTable('post_views');
    }

    public function down()
    {
        $this->forge->dropTable('post_views');
    }
}
