<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AppSettingsSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'nama_setting' => 'Batas Show Data MHS (angkatan)',
                'deskripsi_settings' => 'Hanya tampilkan data mahasiswa berdasarkan batas tahun angkatan yang ditentukan.',
                'value'    => '2021',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('tbl_settings')->insertBatch($data);
    }
}
