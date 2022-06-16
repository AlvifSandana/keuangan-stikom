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
                    $semester = (int)$this->request->getPost('semester');
                    $angkatan = (int)$this->request->getPost('angkatan');
                    $p_soft = (int)$this->request->getPost('p_soft');
                    $p_hard = (int)$this->request->getPost('p_hard');
                    $n_sks = (int)$this->request->getPost('n_sks');
                    $new_tagihan_hard = null;
                    $new_tagihan_soft = null;
                    $new_tagihan_sks = null;
                    // create new tagihan praktikum
                    if ($p_soft > 0) {
                        $new_tagihan_soft = $this->addTagihan('software', $p_soft, $semester, $angkatan, $nim);
                        if ($new_tagihan_soft != 'success') {
                            // return JSON
                            return json_encode([
                                'status' => 'failed',
                                'message' => 'Gagal ACC FRS! Mohon cek master item tagihan untuk praktikum SOFTWARE di menu MASTER DATA > Keuangan > Paket (Mahasiswa).',
                                'data' => []
                            ]);
                        }
                    }
                    if ($p_hard > 0) {
                        $new_tagihan_hard = $this->addTagihan('hardware', $p_hard, $semester, $angkatan, $nim);
                        if ($new_tagihan_hard != 'success') {
                            // return JSON
                            return json_encode([
                                'status' => 'failed',
                                'message' => 'Gagal ACC FRS! Mohon cek master item tagihan untuk praktikum HARDWARE di menu MASTER DATA > Keuangan > Paket (Mahasiswa).',
                                'data' => []
                            ]);
                        }
                    }
                    // check new tagihan SKS
                    if ($n_sks > 0) {
                        $new_tagihan_sks = $this->addTagihan('sks', $n_sks, $semester, $angkatan, $nim);
                        if ($new_tagihan_sks != 'success') {
                            return json_encode([
                                'status' => 'failed',
                                'message' => 'Gagal ACC FRS! Mohon cek master item tagihan untuk SKS di menu MASTER DATA > Keuangan > Paket (Mahasiswa).',
                                'data' => []
                            ]);
                        }
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
                    // get current semester from post data
                    $semester = $this->request->getPost('semester');
                    // delete tagihan praktikum hardware, software, and SKS
                    $del_p_h = $this->removeTagihan('hardware', $semester, $nim);
                    $del_p_s = $this->removeTagihan('software', $semester, $nim);
                    $del_sks = $this->removeTagihan('sks', $semester, $nim);
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
     * create new tagihan for SKS, praktikum software & hardware
     * 
     */
    public function addTagihan(String $type, String $n, int $semester, int $thnangkatan, String $nim)
    {
        try {
            // create model
            $m_item = new ItemPaket();
            $m_transaksi = new Transaksi();
            // get previous kode transaksi
            $current_kode = '';
            $prev_kode = $this->getPreviousKodeTransaksi($nim, 'K', $semester);
            if (is_string($prev_kode) || $prev_kode == 'first transaksi') {
                $current_kode = 'BY-' . $nim . '-K-' . $semester . '-1';
            } else if (is_array($prev_kode)) {
                $current_kode = $prev_kode[0] . '-' . $prev_kode[1] . '-' . $prev_kode[2] . '-' . $prev_kode[3] . '-' . ((int)$prev_kode[4] + 1);
            } else {
                return $prev_kode;
            }
            // check type of tagihan
            if ($type == 'software') {
                // find item tagihan Praktikum Software
                $item = $m_item
                    ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan')
                    ->join('tbl_semester', 'semester_id = tbl_semester.id_semester')
                    ->like('angkatan_id', $thnangkatan)
                    ->like('semester_id', $semester)
                    ->like('nama_item', 'Praktikum Software')
                    ->first();
                // check 
                if ($item != null) {
                    // create new tagihan
                    $new_tagihan = $m_transaksi->insert([
                        'kode_transaksi' => $current_kode,
                        'kode_unit' => $nim,
                        'kategori_transaksi' => 'K',
                        'item_kode' => $item['kode_item'],
                        'q_kredit' => (int)$item['nominal_item'] * $n,
                        'keterangan_transaksi' => $n.' praktikum_s'
                    ]);
                    if ($new_tagihan) {
                        return 'success';
                    } else {
                        return 'failed';
                    }
                }
            } else if ($type == 'hardware') {
                // find item tagihan Praktikum Hardware
                $item = $m_item
                    ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan')
                    ->join('tbl_semester', 'semester_id = tbl_semester.id_semester')
                    ->like('angkatan_id', $thnangkatan)
                    ->like('semester_id', $semester)
                    ->like('nama_item', 'Praktikum Hardware')
                    ->first();
                // check 
                if ($item != null) {
                    // create new tagihan
                    $new_tagihan = $m_transaksi->insert([
                        'kode_transaksi' => $current_kode,
                        'kode_unit' => $nim,
                        'kategori_transaksi' => 'K',
                        'item_kode' => $item['kode_item'],
                        'q_kredit' => (int)$item['nominal_item'] * $n,
                        'keterangan_transaksi' => $n.' praktikum_h'
                    ]);
                    if ($new_tagihan) {
                        return 'success';
                    } else {
                        return 'failed';
                    }
                }
            } else if ($type == 'sks'){
                // find item tagihan SKS
                $item = $m_item
                    ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan')
                    ->join('tbl_semester', 'semester_id = tbl_semester.id_semester')
                    ->like('angkatan_id', $thnangkatan)
                    ->like('semester_id', $semester)
                    ->like('nama_item', 'SKS')
                    ->first();
                // check 
                if ($item != null) {
                    // create new tagihan
                    $new_tagihan = $m_transaksi->insert([
                        'kode_transaksi' => $current_kode,
                        'kode_unit' => $nim,
                        'kategori_transaksi' => 'K',
                        'item_kode' => $item['kode_item'],
                        'q_kredit' => (int)$item['nominal_item'] * $n,
                        'keterangan_transaksi' => $n.' SKS'
                    ]);
                    if ($new_tagihan) {
                        return 'success';
                    } else {
                        return 'failed';
                    }
                }
            } else {
                return 'error';
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove tagihan of SKS, praktikum hardware & software
     */
    public function removeTagihan(String $type, int $semester, String $nim)
    {
        try {
            // create model
            $m_transaksi = new Transaksi();
            // check type of tagihan
            if ($type == 'hardware') {
                // get tagihan by kode_transaksi and keterangan transaksi
                $tagihan = $m_transaksi
                    ->like('kode_transaksi', 'BY-'.$nim.'-K-'.$semester)
                    ->like('keterangan_transaksi', 'praktikum_h')
                    ->first();
                // delete tagihan by kode_transaksi and keterangan transaksi
                $delete_tagihan = $m_transaksi->delete($tagihan['id_transaksi']);
                // check
                if ($delete_tagihan) {
                    return 'success';
                } else {
                    return 'failed';
                }
            } else if($type == 'software'){
                // get tagihan by kode_transaksi and keterangan transaksi
                $tagihan = $m_transaksi
                    ->like('kode_transaksi', 'BY-'.$nim.'-K-'.$semester)
                    ->like('keterangan_transaksi', 'praktikum_s')
                    ->first();
                // delete tagihan by kode_transaksi and keterangan transaksi
                $delete_tagihan = $m_transaksi->delete($tagihan['id_transaksi']);
                // check
                if ($delete_tagihan) {
                    return 'success';
                } else {
                    return 'failed';
                }
            } else if($type == 'sks'){
                // get tagihan by kode_transaksi and keterangan transaksi
                $tagihan = $m_transaksi
                    ->like('kode_transaksi', 'BY-'.$nim.'-K-'.$semester)
                    ->like('keterangan_transaksi', 'SKS')
                    ->first();
                // delete tagihan by kode_transaksi and keterangan transaksi
                $delete_tagihan = $m_transaksi->delete($tagihan['id_transaksi']);
                // check
                if ($delete_tagihan) {
                    return 'success';
                } else {
                    return 'failed';
                }
            } else {
                return 'error';
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * get previous kode transaksi
     */
    public function getPreviousKodeTransaksi(String $kode_unit, String $tipe_transaksi, int $semester)
    {
        try {
            // create model 
            $m_transaksi = new Transaksi();
            // get previous transasik
            $prev_transaksi = $m_transaksi
                ->where('kode_unit', $kode_unit)
                ->where('kategori_transaksi', $tipe_transaksi)
                ->like('kode_transaksi', 'K-'.$semester.'-')
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
