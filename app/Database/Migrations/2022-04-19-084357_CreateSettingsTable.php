<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: 01TI, 02MI
            'id_setting' => [
                'type'      => 'VARCHAR',
                'constraint' => 5,
            ],
            'nama_setting' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'deskripsi_settings' => [
                'type' => 'TEXT',
            ],
            'value' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_setting', true, true);
        $this->forge->createTable('tbl_settings');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_settings');
    }
}
