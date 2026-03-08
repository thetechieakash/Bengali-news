<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdsManagerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],

            'ad_type' => [
                'type' => 'ENUM',
                'constraint' => ['image', 'script'],
                'default' => 'image',
            ],

            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'script' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'pages' => [
                'type' => 'JSON',
                'null' => false,
            ],

            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],

            'view_count' => [
                'type' => 'INT',
                'default' => 0,
            ],

            'click_count' => [
                'type' => 'INT',
                'default' => 0,
            ],

            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->createTable('ads');
    }

    public function down()
    {
        $this->forge->dropTable('ads');
    }
}
