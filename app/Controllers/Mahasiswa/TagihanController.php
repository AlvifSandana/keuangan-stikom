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
    public function create_tagihan()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'kode_unit' => 'required',
                'q_kredit' => 'required',
                'tanggal_transaksi' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_transaksi = new Transaksi();
                // get last tagihan by nim
                $last_tagihan = $m_transaksi->findTransaksi($this->request->getPost('kode_unit'), 'K', 'id_transaksi', 'DESC');
                // get semester
                $current_semester = explode('SMT', $this->request->getPost('semester_id'));
                // get last kode_transaksi
                if ($last_tagihan != 'Data tidak ditemukan!') {
                    $kode_transaksi = explode('-', $last_tagihan[0]['kode_transaksi']);
                    $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-' . (1 + (int)$kode_transaksi[4]);
                } else {
                    $last_kode_transaksi = 'BY-' . $this->request->getPost('kode_unit') . '-K-' . number_format($current_semester[1]) . '-1';
                }
                // insert new tagihan
                $new_tagihan = $m_transaksi->insert([
                    'kode_transaksi' => $last_kode_transaksi,
                    'kode_unit' => $this->request->getPost('kode_unit'),
                    'kategori_transaksi' => 'K',
                    'item_kode' => $this->request->getPost('item_kode'),
                    'q_kredit' => $this->request->getPost('q_kredit'),
                    'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi')
                ]);
                if ($new_tagihan) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan tagihan baru!',
                        'data' => $new_tagihan,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan tagihan baru.',
                        'data' => ''
                    ]);
                }
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
}
