<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTempTransaksiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_temp_transaksi' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode_temp_transaksi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kode_unit' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kategori_transaksi' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'q_debit' => [
                'type' => 'INT',
                'null' => true,
            ],
            'q_kredit' => [
                'type' => 'INT',
                'null' => true,
            ],
            'tanggal_transaksi' => [
                'type' => 'DATETIME',
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
        $this->forge->addKey('id_temp_transaksi', false, true);
        $this->forge->addKey('kode_temp_transaksi', true, true);
        $this->forge->createTable('tbl_temp_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_temp_transaksi');
    }
}
