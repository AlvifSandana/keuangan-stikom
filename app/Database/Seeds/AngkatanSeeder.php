<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AngkatanSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            [
                'id_angkatan' => 'THN2006',
                'tahun_angkatan' => '2006',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2007',
                'tahun_angkatan' => '2007',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2008',
                'tahun_angkatan' => '2008',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2009',
                'tahun_angkatan' => '2009',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2010',
                'tahun_angkatan' => '2010',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2011',
                'tahun_angkatan' => '2011',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2012',
                'tahun_angkatan' => '2012',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2013',
                'tahun_angkatan' => '2013',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2014',
                'tahun_angkatan' => '2014',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2015',
                'tahun_angkatan' => '2015',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2016',
                'tahun_angkatan' => '2016',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2017',
                'tahun_angkatan' => '2017',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2018',
                'tahun_angkatan' => '2018',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2019',
                'tahun_angkatan' => '2019',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2020',
                'tahun_angkatan' => '2020',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2021',
                'tahun_angkatan' => '2021',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2022',
                'tahun_angkatan' => '2022',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2023',
                'tahun_angkatan' => '2023',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_angkatan' => 'THN2024',
                'tahun_angkatan' => '2024',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $this->db->table('tbl_angkatan')->insertBatch($data);
    }
}
