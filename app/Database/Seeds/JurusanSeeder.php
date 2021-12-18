<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'id_jurusan' => '01TI',
                'nama_jurusan' => 'TEKNIK INFORMATIKA',
                'nama_program' => 'S1',
            ],
            [
                'id_jurusan' => '02MI',
                'nama_jurusan' => 'MANAJEMEN INFORMATIKA',
                'nama_program' => 'D3',
            ],
        ];
        $this->db->table('tbl_jurusan')->insertBatch($data);
    }
}
