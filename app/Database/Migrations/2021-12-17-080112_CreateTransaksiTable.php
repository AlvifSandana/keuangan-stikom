<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode_transaksi' => [
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
            'item_kode' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'q_debit' => [
                'type' => 'INT',
                'null' => true,
            ],
            'q_kredit' => [
                'type' => 'INT',
                'null' => true,
            ],
            'kode_metode_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'bukti_transaksi' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('id_transaksi', true, true);
        $this->forge->addKey('kode_transaksi', false, true);
        $this->forge->addForeignKey('item_kode', 'tbl_item_paket', 'kode_item', 'CASCADE');
        $this->forge->addForeignKey('kode_metode_pembayaran', 'tbl_metode_pembayaran', 'id_metode', 'CASCADE');
        $this->forge->createTable('tbl_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_transaksi');
    }
}
