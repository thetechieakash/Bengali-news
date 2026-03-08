<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsPostChildCategoriesTable extends Migration
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
            'child_category_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['news_post_id', 'child_category_id']);
        $this->forge->addForeignKey('news_post_id', 'news_posts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('child_category_id', 'child_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('news_post_child_categories');
    }

    public function down()
    {
        $this->forge->dropTable('news_post_child_categories');
    }
}
