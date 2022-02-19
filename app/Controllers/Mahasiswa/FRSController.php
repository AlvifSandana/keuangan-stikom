<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\ItemPaket;
use App\Models\Transaksi;

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
            ->select("pw_tr_perwalian_header.nim, tbl_mahasiswa.nama_mhs, PesertaKelas.kode_mk, nama_mk, pw_tr_perwalian_header.semester as smtTempuh, semester as smtMK, jum_sks,jadwal,kapasitas, kode_dosen, nama_dosen, PesertaKelas.kelas, pw_tr_perwalian_header.status, pw_tr_perwalian_header.tgl_perwalian,PesertaKelas.Peserta, PesertaKelas.CalonPeserta, kl.jenis")
            ->join("(SELECT nim, tbl_mk.kode_mk, nama_mk, jenis, sts, jum_sks, kelas, tbl_dosen.kode_dosen,nama_dosen FROM pw_tr_perwalian_detail LEFT JOIN tbl_mk ON pw_tr_perwalian_detail.kode_mk=tbl_mk.kode_mk LEFT JOIN tbl_dosen ON pw_tr_perwalian_detail.kode_dosen=tbl_dosen.kode_dosen) AS kl", "pw_tr_perwalian_header.nim=kl.nim", "left")
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
        } else if ($data['ipk'] >= 2.75 && $data['ipk'] < 3) {
            $data['beban_sks'] = 22;
        } else if ($data['ipk'] >= 2.51 && $data['ipk'] < 2.75) {
            $data['beban_sks'] = 20;
        } else if ($data['ipk'] >= 2.00 && $data['ipk'] < 2.50) {
            $data['beban_sks'] = 18;
        } else {
            $data['beban_sks'] = 15;
        }
        // pass data frs to view data
        if ($query_frs) {
            $data['list_frs'] = $query_frs->getResultArray();
            foreach ($query_frs->getResultArray() as $key => $value) {
                $q = $db_old->table('tbl_mk')->select('sts')->where('kode_mk', $value['kode_mk'])->get();
                $sts = $q->getResultArray();
                $data['list_frs'][$key]['sts_mk'] = $sts[0]['sts'];
            }

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
    public function acc_frs($nim)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'status_frs' => 'required',
                'p_soft' => 'required',
                'p_hard' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create db & builder instance
                $db_old = \Config\Database::connect('default_old');
                $builder_frs_k = $db_old->table('pw_tr_perwalian_header');
                // query for update status frs keuangan
                $q_frs_k = $builder_frs_k->update([
                    'status' => 1,
                    'tgl_persetujuan' => date('d-m-Y'),
                    'id_admin' => session()->get('id_user'),
                ], "nim = $nim");
                // check query
                if ($q_frs_k) {
                    // get semester, angkatan, p_soft, p_hard
                    $semester = $this->request->getPost('semester');
                    $angkatan = $this->request->getPost('angkatan');
                    $p_soft = (int)$this->request->getPost('p_soft');
                    $p_hard = (int)$this->request->getPost('p_hard');
                    // create new tagihan praktikum
                    if ($p_soft > 0) {
                        $new_tagihan_soft = $this->addTagihan('software', $p_soft, $semester, $angkatan, $nim);
                        // dd($new_tagihan_soft);
                    }
                    if ($p_hard > 0) {
                        $new_tagihan_hard = $this->addTagihan('hardware', $p_hard, $semester, $angkatan, $nim);
                        // dd($new_tagihan_hard);
                    }
                    // return JSON
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil ACC FRS!',
                        'data' => []
                    ]);
                } else {
                    // return JSON
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal ACC FRS!',
                        'data' => []
                    ]);
                }
            } else {
                // return JSON
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal ACC FRS!',
                    'data' => []
                ]);
            }
        } catch (\Throwable $th) {
            // return JSON
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }

    /**
     * method acc FRS
     */
    public function batal_frs($nim)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'status_frs' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create db & builder instance
                $db_old = \Config\Database::connect('default_old');
                $builder_frs_k = $db_old->table('pw_tr_perwalian_header');
                // query for update status frs keuangan
                $q_frs_k = $builder_frs_k->update([
                    'status' => 0,
                    'tgl_persetujuan' => '-',
                    'id_admin' => session()->get('id_user'),
                ], "nim = $nim");
                // check query
                if ($q_frs_k) {
                    // return JSON
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil membatalkan FRS!',
                        'data' => []
                    ]);
                } else {
                    // return JSON
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal ACC FRS!',
                        'data' => []
                    ]);
                }
            } else {
                // return JSON
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal ACC FRS!',
                    'data' => []
                ]);
            }
        } catch (\Throwable $th) {
            // return JSON
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }

    /**
     * create new tagihan for praktikum software & hardware
     * 
     */
    public function addTagihan(String $type, String $n, String $semester, String $thnangkatan, String $nim)
    {
        try {
            // create model
            $m_item = new ItemPaket();
            $m_transaksi = new Transaksi();
            // get previous kode transaksi
            $current_kode = '';
            $prev_kode = $this->getPreviousKodeTransaksi($nim, 'K');
            // dd($prev_kode);
            if (is_string($prev_kode) || $prev_kode == 'first transaksi') {
                $current_kode = 'BY-' . $nim . '-K-' . $semester . '1';
                // dd($current_kode);
            } else if (is_array($prev_kode)) {
                $current_kode = $prev_kode[0] . '-' . $prev_kode[1] . '-' . $prev_kode[2] . '-' . $prev_kode[3] . '-' . ((int)$prev_kode[4] + 1);
                // dd($current_kode);
            } else {
                return $prev_kode;
            }
            // check type of tagihan
            // dd($type);
            if ($type == 'software') {
                // find item tagihan Praktikum Software
                $item = $m_item
                    ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan')
                    ->join('tbl_semester', 'semester_id = tbl_semester.id_semester')
                    ->like('angkatan_id', $thnangkatan)
                    // ->like('semester_id', $semester)
                    ->like('nama_item', 'Software')
                    ->first();
                // check 
                dd($item, $semester, $thnangkatan);
                if ($item != null) {
                    // create new tagihan
                    $new_tagihan = $m_transaksi->insert([
                        'kode_transaksi' => $current_kode,
                        'kode_unit' => $nim,
                        'kategori_transaksi' => 'K',
                        'item_kode' => $item['kode_item'],
                        'q_kredit' => (int)$item['nominal'] * $n,
                        'keterangan_transaksi' => $n
                    ]);
                    dd($new_tagihan);
                    return 'success';
                }
            } else if ($type == 'hardware') {
                // find item tagihan Praktikum Hardware
                $item = $m_item
                    ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan')
                    ->join('tbl_semester', 'semester_id = tbl_semester.id_semester')
                    ->like('angkatan_id', $thnangkatan)
                    // ->like('semester_id', $semester)
                    ->like('nama_item', 'Hardware')
                    ->first();
                // check 
                dd($item, $semester, $thnangkatan);
                if ($item != null) {
                    // create new tagihan
                    $new_tagihan = $m_transaksi->insert([
                        'kode_transaksi' => $current_kode,
                        'kode_unit' => $nim,
                        'kategori_transaksi' => 'K',
                        'item_kode' => $item['kode_item'],
                        'q_kredit' => (int)$item['nominal'] * $n,
                        'keterangan_transaksi' => $n
                    ]);
                    dd($new_tagihan);
                    return 'success';
                }
            } else {
                return 'error';
            }
        } catch (\Throwable $th) {
            return 'nnnnn';
        }
    }

    /**
     * get previous kode transaksi
     */
    public function getPreviousKodeTransaksi(String $kode_unit, String $tipe_transaksi)
    {
        try {
            // create model 
            $m_transaksi = new Transaksi();
            // get previous transasik
            $prev_transaksi = $m_transaksi
                ->where('kode_unit', $kode_unit)
                ->where('kategori_transaksi', $tipe_transaksi)
                ->orderBy('id_transaksi', 'DESC')
                ->findAll();
            // slice kode_transaksi
            if (count($prev_transaksi) > 0) {
                $sliced_kt = explode('-', $prev_transaksi[0]['kode_transaksi']);
                return $sliced_kt;
            } else {
                return 'first transaksi';
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
