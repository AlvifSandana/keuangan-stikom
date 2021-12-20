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
            ['kode_item' => 'ITEM0001', 'nama_item' => 'Praktikum Hardware', 'nominal_item' => '100000', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
        ];
        $this->db->table('tbl_item_paket')->insertBatch($data);
    }
}
