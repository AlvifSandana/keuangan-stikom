<?php

namespace App\Database\Seeds;

use App\Models\Paket;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ItemPaketSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $counter_semester = 1;
        $counter_item = 0;
        $angkatan = [2020, 2021, 2022];
        $now = Time::now('Asia/Jakarta', 'en_US');
        $m_pkt = new Paket();
        $pkt = $m_pkt->findAll();
        foreach ($pkt as $key => $value) {
            if (strpos($value['nama_paket'], 'BERBAGI')) {
                continue;
            } else {
                for ($h = 0; $h < sizeof($angkatan); $h++) {
                    for ($i = 0; $i < 48; $i++) {
                        $counter_item += 1;
                        // index-0
                        if ($i == 0) {
                            array_push($data, [
                                'kode_item' => 'ITEM' . $counter_item,
                                'nama_item' => 'Tagihan bulan ke-' . 1,
                                'nominal_item' => '1000000',
                                'keterangan_item' => 'Tagihan bulan ke-' . 1 . " angkatan $angkatan[$h]",
                                'paket_id' => $value['id_paket'],
                                'angkatan_id' => 'THN' . $angkatan[$h],
                                'semester_id' => 'SMT01',
                                'created_at' => $now,
                                'updated_at' => $now
                            ]);
                            continue;
                        }
                        // next index
                        if ($i % 6 == 0) {
                            $counter_semester += 1;
                            array_push($data, [
                                'kode_item' => 'ITEM' . $counter_item,
                                'nama_item' => 'Tagihan bulan ke-' . ($i + 1),
                                'nominal_item' => '1000000',
                                'keterangan_item' => 'Tagihan bulan ke-' . ($i + 1) . " angkatan $angkatan[$h]",
                                'paket_id' => $value['id_paket'],
                                'angkatan_id' => 'THN' . $angkatan[$h],
                                'semester_id' => $counter_semester < 10 ? "SMT0$counter_semester":"SMT$counter_semester",
                                'created_at' => $now,
                                'updated_at' => $now
                            ]);
                        } else {
                            array_push($data, [
                                'kode_item' => 'ITEM' . $counter_item,
                                'nama_item' => 'Tagihan bulan ke-' . ($i + 1),
                                'nominal_item' => '1000000',
                                'keterangan_item' => 'Tagihan bulan ke-' . ($i + 1) . " angkatan $angkatan[$h]",
                                'paket_id' => $value['id_paket'],
                                'angkatan_id' => 'THN' . $angkatan[$h],
                                'semester_id' => $counter_semester < 10 ? "SMT0$counter_semester":"SMT$counter_semester",
                                'created_at' => $now,
                                'updated_at' => $now
                            ]);
                        }
                    }
                    $counter_semester = 1;
                }
            }
        }
        // $data = [
        //     ['kode_item' => 'ITEM1', 'nama_item' => 'Pengembangan', 'nominal_item' => '10000000', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
        //     ['kode_item' => 'ITEM2', 'nama_item' => 'PLK', 'nominal_item' => '300000', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
        //     ['kode_item' => 'ITEM3', 'nama_item' => 'Konversi', 'nominal_item' => '0', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
        //     ['kode_item' => 'ITEM4', 'nama_item' => 'Jaket Almamater', 'nominal_item' => '250000', 'keterangan_item' => '-', 'paket_id' => 'PKT01', 'angkatan_id' => 'THN2020', 'semester_id' => 'SMT01', 'created_at' => $now, 'updated_at' => $now],
        // ];
        $this->db->table('tbl_item_paket')->insertBatch($data);
    }
}
