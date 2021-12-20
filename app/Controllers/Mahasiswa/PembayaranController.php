<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;

class PembayaranController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // show view
        return view('pages/keuangan_mahasiswa/pembayaran/index', $data);
    }
}
