<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // create model instance
        $db = \Config\Database::connect('default_old');
        $db1 = \Config\Database::connect('default');
        $builder_mhs = $db->table('tbl_mahasiswa');
        $builder_jurusan = $db1->table('tbl_jurusan');
        $builder_jalur = $db1->table('tbl_jalur');
        $builder_paket = $db1->table('tbl_paket');
        $query = $builder_mhs
            ->select('COUNT(*) as jumlah_mahasiswa')
            ->where('status', '0')
            ->get();
        $query1 = $builder_jurusan
            ->select('COUNT(*) as jumlah_jurusan')
            ->get();
        $query2 = $builder_paket
            ->select('COUNT(*) as jumlah_paket')
            ->get();
        $query3 = $builder_jalur
            ->select('COUNT(*) as jumlah_jalur')
            ->get();
        // create request instance
        $request = \Config\Services::request();
        // get uri segment
        $data['uri_segment'] = $request->uri->getSegment(1);
        // get data
        $data['mahasiswa'] = $query->getResultArray();
        $data['jurusan'] = $query1->getResultArray();
        $data['jalur'] = $query3->getResultArray();
        $data['paket'] = $query2->getResultArray();
        return view('pages/dashboard', $data);
    }
}
