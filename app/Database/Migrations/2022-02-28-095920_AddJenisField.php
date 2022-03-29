<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJenisField extends Migration
{
    public function up()
    {
        // add jenis field
        $fields = [
            'jenis' => ['type' => 'ENUM', 'constraint' => ['TW', 'TB'], 'default' => 'TW'],
        ];
        $this->forge->addColumn('tbl_item_paket', $fields);
    }

    public function down()
    {
        // remove column jenis
        $this->forge->dropColumn('tbl_item_paket', 'jenis');
    }
}
