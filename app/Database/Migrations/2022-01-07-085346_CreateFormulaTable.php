<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class CreateFormulaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_formula' => [
                'type' => 'INT',
            ],
            'kode_formula' => [
                'type' => 'VARCHAR',
                'constraint' => 15
            ],
            'item_kode' => [
                'type' => 'VARCHAR',
                'constraint' => 15
            ],
            'persentase' => [
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
        $this->forge->addKey('id_formula', false, true);
        $this->forge->addKey('kode_formula', true, true);
        $this->forge->addForeignKey('item_kode', 'tbl_item_paket', 'kode_item', 'CASCADE');
        $this->forge->createTable('tbl_formula');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_formula');
    }
}
