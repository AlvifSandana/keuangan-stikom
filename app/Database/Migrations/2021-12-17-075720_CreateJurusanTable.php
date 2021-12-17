<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJurusanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: 01TI, 02MI
            'id_jurusan' => [
                'type'      => 'VARCHAR',
                'constraint' => 5,
            ],
            'nama_jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_program' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
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
        $this->forge->addKey('id_jurusan', true, true);
        $this->forge->createTable('tbl_jurusan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_jurusan');
    }
}
