<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ItemPaketSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            ['kode_item' => 'ITEM0001', 'nama_item' => 'Pengembangan', 'nominal_item' => '10000000', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
            ['kode_item' => 'ITEM0002', 'nama_item' => 'PLK', 'nominal_item' => '300000', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
            ['kode_item' => 'ITEM0003', 'nama_item' => 'Konversi', 'nominal_item' => '0', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
            ['kode_item' => 'ITEM0004', 'nama_item' => 'Jaket Almamater', 'nominal_item' => '250000', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
        ];
        $this->db->table('tbl_item_paket')->insertBatch($data);
    }
}
