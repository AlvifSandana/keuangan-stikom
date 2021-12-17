<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'fullname' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'username' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true,
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true,
            ],
            'password' => [
                'type'              => 'VARCHAR',
                'constraint'        => 60,
            ],
            'user_level' => [
                'type'              => 'VARCHAR',
                'constraint'        => 60,
                'null'              => true,
            ],
            'created_at' => [
                'type'              => 'TIMESTAMP',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'TIMESTAMP',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addKey('username', false, true);
        $this->forge->addKey('email', false, true);
        $this->forge->createTable('tbl_user');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user');
    }
}
