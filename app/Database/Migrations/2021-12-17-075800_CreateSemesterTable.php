<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSemesterTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // format: SMT01
            'id_semester' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'nama_semester' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->addKey('id_semester', true, true);
        $this->forge->createTable('tbl_semester');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_semester');
    }
}
