<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SesiKuliahSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'id_sesi' => '01P',
                'nama_sesi' => 'PAGI',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_sesi' => '02M',
                'nama_sesi' => 'MALAM',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('tbl_sesi_kuliah')->insertBatch($data);
    }
}
