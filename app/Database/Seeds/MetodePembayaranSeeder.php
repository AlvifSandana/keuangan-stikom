<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class MetodePembayaranSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'id_metode' => '01MANDIRI',
                'nama_metode_pembayaran' => 'TRANSFER MANDIRI',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_metode' => '02BRI',
                'nama_metode_pembayaran' => 'TRANSFER BRI',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_metode' => '03BNI',
                'nama_metode_pembayaran' => 'TRANSFER BNI',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('tbl_metode_pembayaran')->insertBatch($data);
    }
}
