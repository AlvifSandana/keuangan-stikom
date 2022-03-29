<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBiayaSKSTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sks' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'angkatan_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'paket_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'biaya_sks' => [
                'type' => 'INT'
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
        $this->forge->addKey('id_sks', true, true);
        $this->forge->addForeignKey('angkatan_id', 'tbl_angkatan', 'id_angkatan', 'CASCADE');
        $this->forge->addForeignKey('paket_id', 'tbl_paket', 'id_paket', 'CASCADE');
        $this->forge->createTable('tbl_biaya_sks');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_biaya_sks');
    }
}
