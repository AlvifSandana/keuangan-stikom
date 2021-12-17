<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemPaketTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_item' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            // format: ITEM0001
            'kode_item' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'nama_item' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'nominal_item' => [
                'type' => 'INT'
            ],
            'keterangan_item' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'paket_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'semester_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
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
        $this->forge->addKey('id_item', true, true);
        $this->forge->addKey('kode_item', false, true);
        $this->forge->addForeignKey('paket_id', 'tbl_paket', 'id_paket', 'CASCADE');
        $this->forge->addForeignKey('semester_id', 'tbl_semester', 'id_semester', 'CASCADE');
        $this->forge->createTable('tbl_item_paket');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_item_paket');
    }
}
