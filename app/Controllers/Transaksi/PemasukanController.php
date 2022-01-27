<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\AkunPemasukan;
use App\Models\MetodePembayaran;
use App\Models\Transaksi;

class PemasukanController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data akun pemasukan
        $m_ap = new AkunPemasukan();
        $data['akun_pemasukan'] = $m_ap->findAll();
        // get data metode pembayaran
        $m_mp = new MetodePembayaran();
        $data['metode_pembayaran'] = $m_mp->findAll();
        // show view
        return view('pages/transaksi/pemasukan/index', $data);
    }

    public function create_pemasukan()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // validator rules
            $validator->setRules([
                'kode_akun_pemasukan' => 'required',
                'tanggal_pemasukan' => 'required',
                'nominal_pemasukan' => 'required',
                'metode_pembayaran' => 'required',
                'keterangan_transaksi' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // validation success
                // slice tanggal_pemasukan
                $tanggal_transaksi = explode('-', $this->request->getPost('tanggal_pemasukan'));
                // create model instance
                $m_transaksi = new Transaksi();
                // create new data transaksi
                $new_transaksi = $m_transaksi->insert([
                    'kode_transaksi' => $this->request->getPost('kode_akun_pemasukan') . $tanggal_transaksi[1] . $tanggal_transaksi[0],
                    'kode_unit' => '',
                    'kategori_transaksi' => 'D',
                    'q_debit' => '',
                    'kode_metode_pembayaran' => '',
                    'tanggal_transaksi' => $this->request->getPost('tanggal_pemasukan'),
                    'keterangan_transaksi' => $this->request->getPost('keterangan_pemasukan')
                ]);
                if ($new_transaksi) {
                    return json_encode([
                        'status' => '',
                        'message' => '',
                        'data' => ''
                    ]);
                } else {
                    return json_encode([
                        'status' => '',
                        'message' => '',
                        'data' => ''
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => $validator->getErrors()
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTraceAsString()
            ]);
        }
    }
}
