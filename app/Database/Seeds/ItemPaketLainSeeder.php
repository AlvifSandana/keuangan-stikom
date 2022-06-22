<?php

namespace App\Database\Seeds;

use App\Models\ItemPaket;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ItemPaketLainSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $m_item = new ItemPaket();
        $counter_item = (int)$m_item->getLastId();
        $angkatan = [2020, 2021, 2022];
        $now = Time::now('Asia/Jakarta', 'en_US');
        for ($h = 0; $h < sizeof($angkatan); $h++) {
            for ($i = 0; $i < 8; $i++) {
                $counter_item += 1;
                array_push($data, [
                    'kode_item' => 'ITEM' . $counter_item,
                    'nama_item' => 'Praktikum Software',
                    'nominal_item' => '50000',
                    'keterangan_item' => 'Praktikum Software semester ' . ($i + 1) . " angkatan $angkatan[$h]",
                    'paket_id' => NULL,
                    'angkatan_id' => 'THN' . $angkatan[$h],
                    'semester_id' => "SMT0" . ($i + 1),
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
                $counter_item += 1;
                array_push($data, [
                    'kode_item' => 'ITEM' . $counter_item,
                    'nama_item' => 'Praktikum Hardware',
                    'nominal_item' => '60000',
                    'keterangan_item' => 'Praktikum Hardware semester ' . ($i + 1) . " angkatan $angkatan[$h]",
                    'paket_id' => NULL,
                    'angkatan_id' => 'THN' . $angkatan[$h],
                    'semester_id' => "SMT0" . ($i + 1),
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
        }
        $this->db->table('tbl_item_paket')->insertBatch($data);
    }
}
