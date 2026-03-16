<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactMessagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 120
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],

            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],

            'subject' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],

            'message' => [
                'type' => 'TEXT'
            ],

            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true
            ],

            'user_agent' => [
                'type' => 'TEXT',
                'null' => true
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('contact_messages');
    }

    public function down()
    {
        $this->forge->dropTable('contact_messages');
    }
}
