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
        $builder_khs = $db_old->table('tbl_nilai_mahasiswa');
        $builder_frs_detail = $db_old->table('pw_tr_perwalian_detail');
        $builder_frs_dosenwali = $db_old->table('pw_tr_perwalian_header_dw');
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        $nim = $request->uri->getSegment(3);
        // get data perwalian mahasiswa
        $query_mhs = $builder_mhs
            ->select('*, tbl_dosen_wali_mahasiswa.*, tbl_jurusan.*, tbl_paket.*, tbl_dosen.*, tbl_status.status as status_mhs')
            ->where('tbl_mahasiswa.nim', $nim)
            ->join('tbl_dosen_wali_mahasiswa', 'tbl_mahasiswa.nim = tbl_dosen_wali_mahasiswa.nim', 'left')
            ->join('tbl_dosen', 'tbl_dosen_wali_mahasiswa.kode_dosen = tbl_dosen.kode_dosen', 'inner')
            ->join('tbl_jurusan', 'tbl_mahasiswa.id_jur = tbl_jurusan.id_jur', 'left')
            ->join('tbl_paket', 'tbl_mahasiswa.id_paket = tbl_paket.id_paket', 'left')
            ->join('tbl_status', 'tbl_mahasiswa.status = tbl_status.id_sts', 'left')
            ->get();
        // query get next semester
        $query_next_semester = $builder_frs
            ->select('semester, status')
            ->where('nim', $nim)
            ->get();
        // query get data frs
        $query_frs = $builder_frs
            ->select("pw_tr_perwalian_header.nim, tbl_mahasiswa.nama_mhs, PesertaKelas.kode_mk, nama_mk, pw_tr_perwalian_header.semester as smtTempuh, semester as smtMK, jum_sks,jadwal,kapasitas, kode_dosen, nama_dosen, PesertaKelas.kelas, pw_tr_perwalian_header.status, pw_tr_perwalian_header.tgl_perwalian,PesertaKelas.Peserta, PesertaKelas.CalonPeserta")
            ->join("(SELECT nim, tbl_mk.kode_mk, nama_mk, sts,jum_sks, kelas, tbl_dosen.kode_dosen,nama_dosen FROM pw_tr_perwalian_detail LEFT JOIN tbl_mk ON pw_tr_perwalian_detail.kode_mk=tbl_mk.kode_mk LEFT JOIN tbl_dosen ON pw_tr_perwalian_detail.kode_dosen=tbl_dosen.kode_dosen) AS kl", "pw_tr_perwalian_header.nim=kl.nim", "left")
            ->join("tbl_mahasiswa", "pw_tr_perwalian_header.nim=tbl_mahasiswa.nim", "left")
            ->join("(SELECT pw_tr_perwalian_header.nim,jadwal,kapasitas,  pw_tr_perwalian_detail.kode_mk,  pw_tr_perwalian_detail.kelas,  SUM(CASE pw_tr_perwalian_header.Status AND pw_tr_perwalian_header_dw.Status WHEN '1' THEN 1 ELSE 0 END) AS Peserta, SUM(CASE pw_tr_perwalian_header.Status AND pw_tr_perwalian_header_dw.Status WHEN '0' THEN 1 ELSE 0 END) AS CalonPeserta  FROM pw_tr_perwalian_header  LEFT JOIN pw_tr_perwalian_detail  ON pw_tr_perwalian_header.nim = pw_tr_perwalian_detail.nim LEFT JOIN pw_tr_perwalian_header_dw  ON pw_tr_perwalian_header.nim = pw_tr_perwalian_header_dw.nim	 GROUP BY kode_mk,kelas) PesertaKelas", "kl.kode_mk = PesertaKelas.kode_mk AND kl.kelas = PesertaKelas.kelas", "left")
            ->where('pw_tr_perwalian_header.nim', $nim)
            ->orderBy('jadwal', 'DESC')
            ->get();
        // query get data frs dosen wali
        $query_frs_dosenwali = $builder_frs
            ->where('nim', $nim)
            ->get();
        // query get khs mahasiswa by nim
        $next_semester = $query_next_semester->getResultArray();
        $query_khs = $builder_khs
            ->where('nim', $nim)
            ->where('semester_ditempuh', ($next_semester[0]['semester'] - 1))
            ->join('tbl_mk', 'tbl_nilai_mahasiswa.kode_mk = tbl_mk.kode_mk', 'left')
            ->join('tbl_bobot_nilai', 'tbl_nilai_mahasiswa.grade = tbl_bobot_nilai.nilai')
            ->join('tbl_dosen', 'tbl_nilai_mahasiswa.kode_dosen = tbl_dosen.kode_dosen', 'left')
            ->get();
        // get data tahun ajaran
        $query_tahun_ajaran = $builder_frs_detail
            ->select('kode_thn, kls_program')
            ->where('nim', $nim)
            ->groupBy('kode_thn')
            ->get();
        // get tanggal persetujuan dosen wali dan keuangan
        $query_tanggal_persetujuan_dw = $builder_frs_dosenwali
            ->where('nim', $nim)
            ->get();
        $query_tanggal_persetujuan_k = $builder_frs
            ->where('nim', $nim)
            ->get();
        // set to view data
        $data['tanggal_persetujuan_dw'] = $query_tanggal_persetujuan_dw->getResultArray();
        $data['tanggal_persetujuan_k'] = $query_tanggal_persetujuan_k->getResultArray();
        $data['khs'] = $query_khs->getResultArray();
        $data['data_mhs'] = $query_mhs->getResultArray();
        $data['list_frs_dw'] = $query_frs_dosenwali->getResultArray();
        $data['next_semester'] = $query_next_semester->getResultArray();
        $data['tahun_ajaran'] = $query_tahun_ajaran->getResultArray();
        // get nilai mahasiswa
        $total_sks = 0;
        $total_nk = 0;
        foreach ($query_khs->getResultArray() as $value) {
            $total_sks += (int) $value['jum_sks'];
            $total_nk += (int) $value['bobot'] * (int) $value['jum_sks'];
        }
        $sum_ipk = $total_sks != 0 ? $total_nk / $total_sks : 0;
        $data['ipk'] = round($sum_ipk, 2);
        // get beban sks
        if ($data['ipk'] >= 3) {
            $data['beban_sks'] = 24;
        } else if($data['ipk'] >= 2.75 && $data['ipk'] < 3) {
            $data['beban_sks'] = 22;
        } else if($data['ipk'] >= 2.51 && $data['ipk'] < 2.75) {
            $data['beban_sks'] = 20;
        } else if($data['ipk'] >= 2.00 && $data['ipk'] < 2.50) {
            $data['beban_sks'] = 18;
        } else {
            $data['beban_sks'] = 15;
        }
        // pass data frs to view data
        if ($query_frs) {
            $data['list_frs'] = $query_frs->getResultArray();
            $tot_sks = 0;
            foreach ($query_frs->getResultArray() as $value) {
                $tot_sks += (int) $value['jum_sks'];
            }
            $data['total_sks'] = $tot_sks;
        } else {
            $data['list_frs'] = 'Data Perwalian kosong!';
        }
        // show view
        return view('pages/keuangan_mahasiswa/frs/index', $data);
    }

    /**
     * method acc FRS
     */
    public function acc_frs()
    {
        try {
            
        } catch (\Throwable $th) {
            
        }
    }
}
