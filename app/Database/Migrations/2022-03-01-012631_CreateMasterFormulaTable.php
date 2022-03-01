<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterFormulaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mformula' => [
                'type' => 'INT',
            ],
            'kode_mformula' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'persentase_tw' => [
                'type' => 'INT',
            ],
            'persentase_tb' => [
                'type' => 'INT',
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
        $this->forge->addKey('id_mformula', false, true);
        $this->forge->addKey('kode_mformula', true, true);
        $this->forge->createTable('tbl_master_formula');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_master_formula');
    }
}
