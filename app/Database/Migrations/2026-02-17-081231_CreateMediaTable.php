<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'comment'    => 'image, video, pdf etc'
            ],
            'folder' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'comment'    => 'example: 02_26'
            ],
            'file_size' => [
                'type' => 'INT',
                'null' => true,
                'comment' => 'size in bytes'
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('file_type');
        $this->forge->addKey('folder');

        $this->forge->createTable('media');
    }

    public function down()
    {
        $this->forge->dropTable('media');
    }
}
