<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAngkatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_angkatan' => [
                'type' => 'INT',
                'constraint' => 5, 
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tahun_angkatan' => [
                'type' => 'VARCHAR', 
                'constraint' => 100
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
        $this->forge->addKey('id_angkatan', true);
        $this->forge->createTable('tbl_angkatan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_angkatan');
    }
}
