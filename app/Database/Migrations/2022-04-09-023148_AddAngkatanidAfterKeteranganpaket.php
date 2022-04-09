<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAngkatanidAfterKeteranganpaket extends Migration
{
    public function up()
    {
        $field = [
            'angkatan_id' => ['type' => 'VARCHAR', 'constraint' => 10,'null' => true, 'after' => 'keterangan_paket'],
            'CONSTRAINT tbl_paket_angkatan_id_foreign FOREIGN KEY(`angkatan_id`) REFERENCES `tbl_angkatan`(`id_angkatan`) ON UPDATE CASCADE'
        ];
        $this->forge->addColumn('tbl_paket', $field);
    }

    public function down()
    {
        $this->forge->dropForeignKey('tbl_paket', 'tbl_paket_angkatan_id_foreign',);
        $this->forge->dropColumn('tbl_paket', 'angkatan_id');
    }
}
