<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SemesterSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'id_semester' => 'SMT01',
                'nama_semester' => 'SEMESTER 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT02',
                'nama_semester' => 'SEMESTER 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT03',
                'nama_semester' => 'SEMESTER 3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT04',
                'nama_semester' => 'SEMESTER 4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT05',
                'nama_semester' => 'SEMESTER 5',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT06',
                'nama_semester' => 'SEMESTER 6',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT07',
                'nama_semester' => 'SEMESTER 7',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT08',
                'nama_semester' => 'SEMESTER 8',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT09',
                'nama_semester' => 'SEMESTER 9',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT10',
                'nama_semester' => 'SEMESTER 10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT11',
                'nama_semester' => 'SEMESTER 11',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT12',
                'nama_semester' => 'SEMESTER 12',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT13',
                'nama_semester' => 'SEMESTER 13',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT14',
                'nama_semester' => 'SEMESTER 14',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semester' => 'SMT15',
                'nama_semester' => 'SEMESTER 15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('tbl_semester')->insertBatch($data);
    }
}
