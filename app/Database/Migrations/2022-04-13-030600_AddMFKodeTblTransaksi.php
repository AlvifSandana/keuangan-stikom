<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMFKodeTblTransaksi extends Migration
{
    public function up()
    {
        $field = [
            'mf_kode' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
                'after' => 'jalur_id'
            ],
            'CONSTRAINT tbl_paket_mf_kode_foreign FOREIGN KEY(`mf_kode`) REFERENCES `tbl_master_formula`(`kode_mformula`) ON UPDATE CASCADE'
        ];
        $this->forge->addColumn('tbl_paket', $field);
    }

    public function down()
    {
        $this->forge->dropForeignKey('tbl_paket', '');
        $this->forge->dropColumn('tbl_paket', 'mf_kode');
    }
}
