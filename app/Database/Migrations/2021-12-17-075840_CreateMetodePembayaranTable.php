<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMetodePembayaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: 01MANDIRI, 02BCA
            'id_metode' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'nama_metode_pembayaran' => [
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
        $this->forge->addKey('id_metode', true);
        $this->forge->createTable('tbl_metode_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_metode_pembayaran');
    }
}
