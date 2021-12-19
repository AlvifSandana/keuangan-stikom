<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\AkunPemasukan;
use App\Models\MetodePembayaran;

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
}
