<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCatagoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true
            ],
            'cat' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'slug' => [
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
        $this->forge->createTable('catagories');
    }

    public function down()
    {
        $this->forge->dropTable('catagories');
    }
}
