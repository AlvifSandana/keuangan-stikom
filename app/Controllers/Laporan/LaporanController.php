<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;

class LaporanController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // show view
        return view('pages/master/laporan/index', $data);
    }

    public function generate_laporan_pemasukan_dari_mhs()
    {
        try {
            
        } catch (\Throwable $th) {
            
        }
    }
    
    public function generate_laporan_pemasukan_lain()
    {
        try {
            
        } catch (\Throwable $th) {
            
        }
    }

    public function generate_laporan_pengeluaran()
    {
        try {
            
        } catch (\Throwable $th) {
            
        }
    }
}
