<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsPostSubCategoriesTable extends Migration
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
            'sub_category_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['news_post_id', 'sub_category_id']);
        $this->forge->addForeignKey('news_post_id', 'news_posts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sub_category_id', 'sub_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('news_post_sub_categories');
    }

    public function down()
    {
        $this->forge->dropTable('news_post_sub_categories', true);
    }
}
