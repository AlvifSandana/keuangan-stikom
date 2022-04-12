<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusTblTempTr extends Migration
{
    public function up()
    {
        $field = [
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => 'true',
                'after' => 'tanggal_transaksi'
            ]
        ];
        $this->forge->addColumn('tbl_temp_transaksi', $field);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_temp_transaksi', 'status');
    }
}
