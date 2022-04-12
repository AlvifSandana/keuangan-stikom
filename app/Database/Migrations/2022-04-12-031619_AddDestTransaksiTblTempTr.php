<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDestTransaksiTblTempTr extends Migration
{
    public function up()
    {
        $field = [
            'dest_transaksi' => [
                'type' => 'TEXT',
                'null' => 'true',
                'after' => 'tanggal_transaksi'
            ]
        ];
        $this->forge->addColumn('tbl_temp_transaksi', $field);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_temp_transaksi', 'dest_transaksi');
    }
}
