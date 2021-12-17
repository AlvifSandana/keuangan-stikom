<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSesiKuliahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: 01P
            'id_sesi' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'nama_sesi' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('id_sesi', true);
        $this->forge->createTable('tbl_sesi_kuliah');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_sesi_kuliah');
    }
}
