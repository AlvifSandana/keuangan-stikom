<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Semester;
use App\Models\Transaksi;

class TagihanController extends BaseController
{
    public function index()
    {
        //
    }

    /**
     * Create new tagihan
     */
    public function createTagihan()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'kode_unit' => 'required',
                'item_kode' => 'required',
                // 'q_kredit' => 'required',
                'tanggal_transaksi' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_transaksi = new Transaksi();
                // get item tagihan from request
                $raw_item_tagihan = $this->request->getPost('item_kode');
                $req_item_tagihan = [];
                $req_id_smt = [];
                $req_nom_item_tagihan = [];
                // split
                for ($i = 0; $i < count($raw_item_tagihan); $i++) {
                    $split = explode('-', $raw_item_tagihan[$i]);
                    array_push($req_item_tagihan, $split[0]);
                    array_push($req_id_smt, $split[1]);
                    array_push($req_nom_item_tagihan, $split[2]);
                }
                // get current tagihan
                $current_tagihan = $m_transaksi->findTransaksi($this->request->getPost('kode_unit'), 'K', 'id_transaksi', 'DESC', '', '');
                $current_item_tagihan = [];
                if (!is_string($current_tagihan)) {
                    foreach ($current_tagihan as $key => $value) {
                        array_push($current_item_tagihan, $value['kode_item']);
                    }
                }
                // dd($req_item_tagihan, $current_item_tagihan, $req_id_smt, $req_nom_item_tagihan);
                /**
                 * Update tagihan:
                 * 
                 * When N of current tagihan > 0 AND < N of paket_tagihan, 
                 * insert new tagihan from paket_tagihan.
                 * 
                 * When N of current tagihan > 0 AND = N of paket_tagihan AND current tagihan != paket_tagihan, 
                 * update each tagihan with paket_tagihan.
                 * 
                 * When N of current tagihan == 0 AND N of paket_tagihan > 0,
                 * insert each paket_tagihan
                 * 
                 */
                // check item tagihan 
                if (count($current_item_tagihan) > 0 && count($current_item_tagihan) < count($req_item_tagihan)) {
                    // get different current_tagihan
                    $union_arr = array_merge($current_item_tagihan, $req_item_tagihan);
                    $intersect_arr = array_intersect($current_item_tagihan, $req_item_tagihan);
                    $differents = array_values(array_diff($union_arr, $intersect_arr));
                    // iterate diffrent
                    for ($i = 0; $i < count($differents); $i++) {
                        // get semester
                        $search_idx_smt = array_search($differents[$i], $req_item_tagihan);
                        $current_semester = explode('SMT', $req_id_smt[$search_idx_smt]);
                        // get last kode_transaksi
                        $current_tagihan = $m_transaksi->findTransaksi($this->request->getPost('kode_unit'), 'K', 'id_transaksi', 'DESC', '', '');
                        if ($current_tagihan != 'Data tidak ditemukan!') {
                            $kode_transaksi = explode('-', $current_tagihan[0]['kode_transaksi']);
                            $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-' . (1 + (int)$kode_transaksi[4]);
                        } else {
                            $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-1';
                        }
                        // insert new tagihan
                        $new_tagihan = $m_transaksi->insert([
                            'kode_transaksi' => $last_kode_transaksi,
                            'kode_unit' => $this->request->getPost('kode_unit'),
                            'kategori_transaksi' => 'K',
                            'item_kode' => $differents[$i],
                            'q_kredit' => $req_nom_item_tagihan[$search_idx_smt],
                            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi')
                        ]);
                    }
                } else if (count($current_item_tagihan) > 0 && count($current_item_tagihan) == count($req_item_tagihan)) {
                    // get different current_tagihan
                    $union_arr = array_merge($current_item_tagihan, $req_item_tagihan);
                    $intersect_arr = array_intersect($current_item_tagihan, $req_item_tagihan);
                    $differents = array_values(array_diff($union_arr, $intersect_arr));
                    // dd($union_arr, $intersect_arr, $differents);
                    // iterate diffrent 
                    for ($i = 0; $i < count($differents); $i++) {
                        // get semester
                        $search_idx_smt = array_search($differents[$i], $req_item_tagihan);
                        $current_semester = explode('SMT', $req_id_smt[$search_idx_smt]);
                        // get last kode_transaksi
                        $current_tagihan = $m_transaksi->findTransaksi($this->request->getPost('kode_unit'), 'K', 'id_transaksi', 'DESC', '', '');
                        if ($current_tagihan != 'Data tidak ditemukan!') {
                            $kode_transaksi = explode('-', $current_tagihan[0]['kode_transaksi']);
                            $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-' . (1 + (int)$kode_transaksi[4]);
                        } else {
                            $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-1';
                        }
                        // insert new tagihan
                        $new_tagihan = $m_transaksi->insert([
                            'kode_transaksi' => $last_kode_transaksi,
                            'kode_unit' => $this->request->getPost('kode_unit'),
                            'kategori_transaksi' => 'K',
                            'item_kode' => $differents[$i],
                            'q_kredit' => $req_nom_item_tagihan[$search_idx_smt],
                            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi')
                        ]);
                    }
                } else if (count($current_item_tagihan) == 0 || count($req_item_tagihan) > 0) {
                    // iterate item tagihan
                    for ($i = 0; $i < count($req_item_tagihan); $i++) {
                        // get semester
                        $search_idx_smt = array_search($req_item_tagihan[$i], $req_item_tagihan);
                        $current_semester = explode('SMT', $req_id_smt[$search_idx_smt]);
                        // get last kode_transaksi
                        $current_tagihan = $m_transaksi->findTransaksi($this->request->getPost('kode_unit'), 'K', 'id_transaksi', 'DESC', '', '');
                        if ($current_tagihan != 'Data tidak ditemukan!') {
                            $kode_transaksi = explode('-', $current_tagihan[0]['kode_transaksi']);
                            $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-' . (1 + (int)$kode_transaksi[4]);
                        } else {
                            $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-1';
                        }
                        // insert new tagihan
                        $new_tagihan = $m_transaksi->insert([
                            'kode_transaksi' => $last_kode_transaksi,
                            'kode_unit' => $this->request->getPost('kode_unit'),
                            'kategori_transaksi' => 'K',
                            'item_kode' => $req_item_tagihan[$i],
                            'q_kredit' => $req_nom_item_tagihan[$search_idx_smt],
                            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi')
                        ]);
                    }
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan tagihan baru.',
                        'data' => ''
                    ]);
                }
                return json_encode([
                    'status' => 'success',
                    'message' => 'Berhasil menambahkan tagihan baru!',
                    'data' => $new_tagihan,
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon cek field input!',
                    'data' => $validator->getErrors(),
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }

    public function get_tagihan_by_nim(String $nim)
    {
        try {
            // create model
            $m_tr = new Transaksi();
            // get data tagihan by nim
            $tagihan = $m_tr->findTransaksi($nim, 'K', 'id_transaksi', 'ASC', '', '');
            // check
            if (!is_string($tagihan)) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'data available!',
                    'data' => $tagihan
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => $tagihan,
                    'data' => []
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace()
            ]);
        }
    }
}
