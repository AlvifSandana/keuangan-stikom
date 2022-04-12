<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKodeMetodePembayaranTempTransaksi extends Migration
{
    public function up()
    {
        $field = [
            'kode_metode_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'kategori_transaksi'
            ],
            'CONSTRAINT tbl_temp_tr_kode_mp_foreign FOREIGN KEY(`kode_metode_pembayaran`) REFERENCES `tbl_metode_pembayaran`(`id_metode`) ON UPDATE CASCADE'
        ];
        $this->forge->addColumn('tbl_temp_transaksi', $field);
    }

    public function down()
    {
        $this->forge->dropForeignKey('tbl_temp_transaksi', 'tbl_temp_tr_kode_mp_foreign');
        $this->forge->dropColumn('tbl_temp_transaksi', 'kode_metode_pembayaran');
    }
}
