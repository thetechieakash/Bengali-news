<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsPostCategoriesTable extends Migration
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
            'category_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // id as PK
        $this->forge->addKey(['news_post_id', 'category_id']); // just a unique index if needed

        $this->forge->addForeignKey('news_post_id', 'news_posts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('news_post_categories');
    }

    public function down()
    {
        $this->forge->dropTable('news_post_categories', true);
    }
}
