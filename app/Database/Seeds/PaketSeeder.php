<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PaketSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = [
            ["id_paket" => "PKT01", "nama_paket" => "S1 REGULER PAGI", "jurusan_id" => "01TI", "sesi_id" => "01P", "jalur_id" => "01REG"],
            ["id_paket" => "PKT02", "nama_paket" => "S1 REGULER MALAM", "jurusan_id" => "01TI", "sesi_id" => "02M", "jalur_id" => "01REG"],
            ["id_paket" => "PKT03", "nama_paket" => "STIKOM S1 BERBAGI", "jurusan_id" => "01TI", "sesi_id" => "01P", "jalur_id" => "02BAGI"],
            ["id_paket" => "PKT04", "nama_paket" => "STIKOM D3 PEDULI SORE", "jurusan_id" => "02MI", "sesi_id" => "02M", "jalur_id" => "03PEDULI"],
            ["id_paket" => "PKT05", "nama_paket" => "KELAS S1 PAKET", "jurusan_id" => "01TI", "sesi_id" => "02M", "jalur_id" => "04PKT"],
            ["id_paket" => "PKT06", "nama_paket" => "KELAS S1 KARYAWAN", "jurusan_id" => "01TI", "sesi_id" => "02M", "jalur_id" => "05KARYAWAN"],
            ["id_paket" => "PKT07", "nama_paket" => "D3 REGULER MALAM", "jurusan_id" => "02MI", "sesi_id" => "02M", "jalur_id" => "01REG"],
            ["id_paket" => "PKT08", "nama_paket" => "S1 TRANSFER", "jurusan_id" => "01TI", "sesi_id" => "02M", "jalur_id" => "06TF"],
            ["id_paket" => "PKT09", "nama_paket" => "D3 TRANSFER", "jurusan_id" => "02MI", "sesi_id" => "02M", "jalur_id" => "06TF"],
            ["id_paket" => "PKT10", "nama_paket" => "STIKOM D3 BERBAGI MALAM", "jurusan_id" => "02MI", "sesi_id" => "02M", "jalur_id" => "02BAGI"],
            ["id_paket" => "PKT11", "nama_paket" => "STIKOM D3 PEDULI YATIM", "jurusan_id" => "02MI", "sesi_id" => "02M", "jalur_id" => "03PEDULI"],
            ["id_paket" => "PKT12", "nama_paket" => "D3 REGULER PAGI", "jurusan_id" => "02MI", "sesi_id" => "01P", "jalur_id" => "01REG"],
            ["id_paket" => "PKT13", "nama_paket" => "STIKOM D3 BERBAGI PAGI", "jurusan_id" => "02MI", "sesi_id" => "01P", "jalur_id" => "02BAGI"],
            ["id_paket" => "PKT14", "nama_paket" => "STIKOM D3 PEDULI PAGI", "jurusan_id" => "02MI", "sesi_id" => "01P", "jalur_id" => "03PEDULI"],
            ["id_paket" => "PKT15", "nama_paket" => "S1 PRESTASI", "jurusan_id" => "01TI", "sesi_id" => "01P", "jalur_id" => "07PRES"],
            ["id_paket" => "PKT16", "nama_paket" => "D3 MITRA", "jurusan_id" => "02MI", "sesi_id" => "02M", "jalur_id" => "08MITRA"],
            ["id_paket" => "PKT17", "nama_paket" => "S1 MALAM NU", "jurusan_id" => "01TI", "sesi_id" => "02M", "jalur_id" => "09NU"],
            ["id_paket" => "PKT18", "nama_paket" => "D3 MALAM NU", "jurusan_id" => "02MI", "sesi_id" => "02M", "jalur_id" => "09NU"],
            ["id_paket" => "PKT19", "nama_paket" => "SI TRANSFER NU", "jurusan_id" => "01TI", "sesi_id" => "02M", "jalur_id" => "09NU"],
            ["id_paket" => "PKT20", "nama_paket" => "S1 PAGI NU", "jurusan_id" => "01TI", "sesi_id" => "01P", "jalur_id" => "09NU"],
            ["id_paket" => "PKT21", "nama_paket" => "S1 Transfer Pendidik dan Tenaga Kependidikan", "jurusan_id" => "01TI", "sesi_id" => "02M", "jalur_id" => "06TF"],
            ["id_paket" => "PKT22", "nama_paket" => "D3 KIP PAGI", "jurusan_id" => "02MI", "sesi_id" => "01P", "jalur_id" => "10KIP"]
        ];
        $this->db->table('tbl_paket')->insertBatch($data);
    }
}
