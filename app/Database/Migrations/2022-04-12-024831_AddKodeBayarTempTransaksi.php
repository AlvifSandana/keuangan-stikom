<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKodeBayarTempTransaksi extends Migration
{
    public function up()
    {
        $field = [
            'kode_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'kode_temp_transaksi'
            ]
        ];
        $this->forge->addColumn('tbl_temp_transaksi', $field);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_temp_transaksi', 'kode_bayar');
    }
}
