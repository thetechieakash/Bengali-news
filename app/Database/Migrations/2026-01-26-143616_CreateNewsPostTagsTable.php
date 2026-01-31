<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsPostTagsTable extends Migration
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
            'tag_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['news_post_id', 'tag_id']);
        $this->forge->addForeignKey('news_post_id', 'news_posts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('news_post_tags');
    }

    public function down()
    {
        $this->forge->dropTable('news_post_tags', true);
    }
}
