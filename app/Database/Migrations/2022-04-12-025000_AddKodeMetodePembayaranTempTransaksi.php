<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKodeMetodePembayaranTempTransaksi extends Migration
{
    public function up()
    {
        $field = [
            'metode_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'kategori_transaksi'
            ],
        ];
        $this->forge->addColumn('tbl_temp_transaksi', $field);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_temp_transaksi', 'kode_metode_pembayaran');
    }
}
