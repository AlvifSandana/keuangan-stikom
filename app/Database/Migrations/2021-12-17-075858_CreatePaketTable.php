<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaketTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: PKT01, PKT02, ...
            'id_paket' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'nama_paket' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'keterangan_paket' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // format: 01TI, 02MI, ...
            'jurusan_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            // format: 01P, 02M, ...
            'sesi_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            // format: 
            'jalur_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
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
        $this->forge->addKey('id_paket', true, true);
        $this->forge->addForeignKey('jurusan_id', 'tbl_jurusan', 'id_jurusan', 'CASCADE');
        $this->forge->addForeignKey('sesi_id', 'tbl_sesi_kuliah', 'id_sesi', 'CASCADE');
        $this->forge->addForeignKey('jalur_id', 'tbl_jalur', 'id_jalur', 'CASCADE');
        $this->forge->createTable('tbl_paket');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_paket');
    }
}
