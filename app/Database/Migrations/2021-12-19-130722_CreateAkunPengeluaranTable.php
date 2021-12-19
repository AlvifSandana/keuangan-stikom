<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAkunPengeluaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_akun' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode_akun' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'nama_akun' => [
                'type' => 'TEXT'
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
        $this->forge->addKey('id_akun', false, true);
        $this->forge->addKey('kode_akun', true, true);
        $this->forge->createTable('tbl_akun_pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_akun_pengeluaran');
    }
}
