<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJalurTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: 01REG, 02BAGI
            'id_jalur' => [
                'type' => 'VARCHAR', 
                'constraint' => 10
            ],
            'nama_jalur' => [
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
        $this->forge->addKey('id_jalur', true, true);
        $this->forge->createTable('tbl_jalur');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_jalur');
    }
}
