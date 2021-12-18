<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class JalurSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'id_jalur' => '01REG',
                'nama_jalur' => 'reguler',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '02BAGI',
                'nama_jalur' => 'berbagi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '03PEDULI',
                'nama_jalur' => 'peduli',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '04PKT',
                'nama_jalur' => 'paket',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '05KARYAWAN',
                'nama_jalur' => 'karyawan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '06TF',
                'nama_jalur' => 'transfer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '07PRES',
                'nama_jalur' => 'prestasi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '08MITRA',
                'nama_jalur' => 'mitra',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_jalur' => '09NU',
                'nama_jalur' => 'NU',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('tbl_jalur')->insertBatch($data);
    }
}
