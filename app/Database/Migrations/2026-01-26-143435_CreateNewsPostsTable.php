<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'headline' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'unique'     => true,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'sub_author_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'post_date_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'short_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'description' => [
                'type' => 'LONGTEXT',
            ],
            'views' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
                'null'       => false,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => '1=published,0=draft',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('news_posts');
    }

    public function down()
    {
        $this->forge->dropTable('news_posts', true);
    }
}
