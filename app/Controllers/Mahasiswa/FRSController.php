<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;

class FRSController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // create DB and builder instance
        $db_old = \Config\Database::connect('default_old');
        $builder_mhs = $db_old->table('tbl_mahasiswa');
        $builder_frs = $db_old->table('pw_tr_perwalian_header');
        $builder_frs_detail = $db_old->table('pw_tr_perwalian_detail');
        $builder_frs_dosenwali = $db_old->table('pw_tr_perwalian_header_dw');
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        $nim = $request->uri->getSegment(3);
        // get data perwalian mahasiswa
        $query_mhs = $builder_mhs
            ->select('*, tbl_dosen_wali_mahasiswa.*, tbl_jurusan.*, tbl_paket.*')
            ->where('tbl_mahasiswa.nim', $nim)
            ->join('tbl_dosen_wali_mahasiswa', 'tbl_mahasiswa.nim = tbl_dosen_wali_mahasiswa.nim', 'left')
            ->join('tbl_jurusan', 'tbl_mahasiswa.id_jur = tbl_jurusan.id_jur', 'left')
            ->join('tbl_paket', 'tbl_mahasiswa.id_paket = tbl_paket.id_paket', 'left')
            ->join('tbl_status', 'tbl_mahasiswa.status = tbl_status.id_sts', 'left')
            ->get();
        $query_next_semester = $builder_frs
            ->select('semester, status')
            ->where('nim', $nim)
            ->get();
        $query_frs = $builder_frs
            ->select("pw_tr_perwalian_header.nim, tbl_mahasiswa.nama_mhs, PesertaKelas.kode_mk, nama_mk, pw_tr_perwalian_header.semester as smtTempuh, semester as smtMK, jum_sks,jadwal,kapasitas, kode_dosen, nama_dosen, PesertaKelas.kelas, pw_tr_perwalian_header.status, pw_tr_perwalian_header.tgl_perwalian,PesertaKelas.Peserta, PesertaKelas.CalonPeserta")
            ->join("(SELECT nim, tbl_mk.kode_mk, nama_mk, jum_sks, kelas, tbl_dosen.kode_dosen,nama_dosen FROM pw_tr_perwalian_detail LEFT JOIN tbl_mk ON pw_tr_perwalian_detail.kode_mk=tbl_mk.kode_mk LEFT JOIN tbl_dosen ON pw_tr_perwalian_detail.kode_dosen=tbl_dosen.kode_dosen) AS kl", "pw_tr_perwalian_header.nim=kl.nim", "left")
            ->join("tbl_mahasiswa", "pw_tr_perwalian_header.nim=tbl_mahasiswa.nim", "left")
            ->join("(SELECT pw_tr_perwalian_header.nim,jadwal,kapasitas,  pw_tr_perwalian_detail.kode_mk,  pw_tr_perwalian_detail.kelas,  SUM(CASE pw_tr_perwalian_header.Status AND pw_tr_perwalian_header_dw.Status WHEN '1' THEN 1 ELSE 0 END) AS Peserta, SUM(CASE pw_tr_perwalian_header.Status AND pw_tr_perwalian_header_dw.Status WHEN '0' THEN 1 ELSE 0 END) AS CalonPeserta  FROM pw_tr_perwalian_header  LEFT JOIN pw_tr_perwalian_detail  ON pw_tr_perwalian_header.nim = pw_tr_perwalian_detail.nim LEFT JOIN pw_tr_perwalian_header_dw  ON pw_tr_perwalian_header.nim = pw_tr_perwalian_header_dw.nim	 GROUP BY kode_mk,kelas) PesertaKelas", "kl.kode_mk = PesertaKelas.kode_mk AND kl.kelas = PesertaKelas.kelas", "left")
            ->where('pw_tr_perwalian_header.nim', $nim)
            ->orderBy('jadwal', 'DESC')
            ->get();
        $query_frs_dosenwali = $builder_frs
            ->where('nim', $nim)
            ->get();
        if ($query_frs) {
            $data['list_frs'] = $query_frs->getResultArray();
        } else {
            $data['list_frs'] = 'Data Perwalian kosong!';
        }
        // show view
        return view('pages/keuangan_mahasiswa/frs/index', $data);
    }
}
