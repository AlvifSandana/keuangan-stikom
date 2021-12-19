<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AkunPemasukanSeeder extends Seeder
{
    public function run()
    {
        $now = Time::now('Asia/Jakarta', 'en_US');
        $data = array(
            array('kode_akun' => '4100-1000', 'nama_akun' => 'Dana Tarikan dari Rek BNI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4100-1100', 'nama_akun' => 'Dana Pengembalian dari Kegiatan', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4100-2100', 'nama_akun' => 'Pembayaran Mhs Lama', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4100-3000', 'nama_akun' => 'Beasiswa', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-0001', 'nama_akun' => 'Praktikum SMP PGRI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-0002', 'nama_akun' => 'Diklat & Kegiatan2 non Rutin', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-0009', 'nama_akun' => 'Pendaftaran Maba 2009', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2001', 'nama_akun' => 'Pemby UTS susulan', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2002', 'nama_akun' => 'Pemby UAS Susulan', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2003', 'nama_akun' => 'Pemby Pratikum', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2017', 'nama_akun' => 'Pemby Pratikum 2007 Ti', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2018', 'nama_akun' => 'Pemby Pratikum 2008 TI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2019', 'nama_akun' => 'Pemby Pratikum 2009 TI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2020', 'nama_akun' => 'Pemby Praktikum 2010 TI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2037', 'nama_akun' => 'Pemby Pratikum 2007 MI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2038', 'nama_akun' => 'Pemby Pratikum 2008 MI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2039', 'nama_akun' => 'Pemby Pratikum 2009 MI', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4300-0001', 'nama_akun' => 'Penjualan Komputer Lama', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4300-0002', 'nama_akun' => 'Penjualan Peralatan Lama', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4400-1000', 'nama_akun' => 'Pemasukan Lain-lain', 'created_at' => $now, 'updated_at' => $now),
            array('kode_akun' => '4200-2040', 'nama_akun' => 'Pemby Praktikum 2010 MI', 'created_at' => $now, 'updated_at' => $now)
        );
        $this->db->table('tbl_akun_pemasukan')->insertBatch($data);
    }
}
