<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsPostCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'news_post_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            // Self reference (admin reply / threaded comment)
            'parent_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],

            'guest_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
            ],

            'guest_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'comment' => [
                'type' => 'TEXT',
            ],

            // Admin reply flag
            'is_admin_reply' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '1 = admin reply',
            ],

            // Moderation
            'status' => [
                'type'    => 'TINYINT',
                'default' => 0,
                'comment' => '0 = pending, 1 = approved',
            ],

            // reCAPTCHA v3 score
            'recaptcha_score' => [
                'type'       => 'DECIMAL',
                'constraint' => '3,2',
                'null'       => true,
            ],

            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],

            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('news_post_id');
        $this->forge->addKey('parent_id');
        $this->forge->addKey('status');

        $this->forge->addForeignKey('news_post_id', 'news_posts', 'id', 'CASCADE', 'CASCADE');

        $this->forge->addForeignKey('parent_id', 'news_post_comments', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('news_post_comments');
    }

    public function down()
    {
        $this->forge->dropTable('news_post_comments');
    }
}
