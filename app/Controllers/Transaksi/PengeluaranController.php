<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\AkunPengeluaran;
use App\Models\MetodePembayaran;

class PengeluaranController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data akun pengeluaran
        $m_ap = new AkunPengeluaran();
        $data['akun_pengeluaran'] = $m_ap->findAll();
        // get data metode pembayaran
        $m_mp = new MetodePembayaran();
        $data['metode_pembayaran'] = $m_mp->findAll();
        // show view
        return view('pages/transaksi/pengeluaran/index', $data);
    }
}
