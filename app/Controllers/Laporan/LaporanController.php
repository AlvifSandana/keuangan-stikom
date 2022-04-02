<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Transaksi;

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

    public function laporan_pemasukan()
    {
        try {
            // get data pemasukan
            $pemasukan_dari_mhs = $this->generate_data_pemasukan("MHS");
            $pemasukan_lain = $this->generate_data_pemasukan("LAIN");
            dd($pemasukan_dari_mhs, $pemasukan_lain);
            // check
            // if (count($pemasukan_dari_mhs) > 0 || count($pemasukan_lain) > 0) {
            // } else {
            // }
        } catch (\Throwable $th) {
        }
    }

    public function generate_data_pemasukan(String $type)
    {
        try {
            // result
            $result = [];
            // create model
            $m_transaksi = new Transaksi();
            // get data pemasukan
            $pemasukan = $m_transaksi->findTransaksi($type, 'D', 'id_transaksi', 'ASC', '2021-12-01', '2022-12-12');
            // check
            if(is_string($pemasukan)){
                $result = $pemasukan;
            }else{
                $result = "Data tidak ditemukan!";
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function generate_data_pengeluaran()
    {
        try {
        } catch (\Throwable $th) {
        }
    }
}
