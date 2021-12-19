<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAngkatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: THN2006 , THN2007, ...
            'id_angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 10, 
            ],
            'tahun_angkatan' => [
                'type' => 'VARCHAR', 
                'constraint' => 100
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
        $this->forge->addKey('id_angkatan', true, true);
        $this->forge->createTable('tbl_angkatan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_angkatan');
    }
}
