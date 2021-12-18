<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'fullname' => 'Administrator',
                'username' => 'administrator',
                'email'    => 'admin@example.com',
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'user_level' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('tbl_user')->insertBatch($data);
    }
}
