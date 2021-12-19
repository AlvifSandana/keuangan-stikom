<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;

class PengeluaranController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment
        $data['uri_segment'] = $request->uri->getSegment(2);
        return view('pages/transaksi/pengeluaran/index', $data);
    }
}
