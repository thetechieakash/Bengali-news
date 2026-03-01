<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWebsiteVisitsTable extends Migration
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
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'visit_date' => [
                'type' => 'DATE',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // Prevent duplicate visit per IP per day
        $this->forge->addUniqueKey(['ip_address', 'visit_date']);

        $this->forge->createTable('website_visits');
    }

    public function down()
    {
        $this->forge->dropTable('website_visits');
    }
}
