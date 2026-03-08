<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChildCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'sub_cat_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'constraint' => 11,
            ],

            'child_cat_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'child_cat_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],

            'status' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],

            'created_at DATETIME NULL',
            'updated_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);

        // Foreign key to sub_categories
        $this->forge->addForeignKey('sub_cat_id', 'sub_categories', 'id', 'CASCADE', 'CASCADE');

        // Composite unique (better than global unique)
        $this->forge->addUniqueKey(['sub_cat_id', 'child_cat_slug']);

        $this->forge->createTable('child_categories');
    }

    public function down()
    {
        $this->forge->dropTable('child_categories');
    }
}
