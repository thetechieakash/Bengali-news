<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubCatagoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true
            ],
            'cat_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'sub_cat_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sub_cat_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique' => true
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null'       => false,
            ],
            'status' => [
                'type' => 'BOOLEAN',
                'default' => true,
                'null'       => false,
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
        $this->forge->createTable('sub_catagories');
    }

    public function down()
    {
        $this->forge->dropTable('sub_catagories');
    }
}
