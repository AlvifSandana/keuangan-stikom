<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Transaksi;

class DashboardController extends BaseController
{
    public function index()
    {
        // create model instance
        $db = \Config\Database::connect('default_old');
        $db1 = \Config\Database::connect('default');
        $m_transaksi = new Transaksi();
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
        $data['total_tagihan'] = $m_transaksi
            ->select('SUM(q_kredit) as total_tagihan')
            ->where('kategori_transaksi', 'K')
            ->like('kode_transaksi', 'BY-')
            ->find();
        $data['total_pembayaran'] = $m_transaksi
            ->select('SUM(q_debit) as total_pembayaran')
            ->where('kategori_transaksi', 'D')
            ->like('kode_transaksi', 'BY-')
            ->find();
        return view('pages/dashboard', $data);
    }

    public function chart_pemasukan_pengeluaran(String $tahun, String $semester = "")
    {
        try {
            // create model object
            $m_transaksi = new Transaksi();
            // define year
            $prev_year = (int)$tahun - 1;
            // get data 1 year and prev year
            $data_in = $m_transaksi->getChartDataByYear($tahun, 'q_debit');
            $data_in_prev = $m_transaksi->getChartDataByYear($prev_year, 'q_debit');
            $data_out = $m_transaksi->getChartDataByYear($tahun, 'q_kredit');
            $data_out_prev = $m_transaksi->getChartDataByYear($prev_year, 'q_kredit');
            // check data
            if(!is_string($data_in) && count($data_in) > 0 || !is_string($data_out) && count($data_out) > 0){
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data available!',
                    'data' => [
                        'pembayaran' => $data_in,
                        'pembayaran_prev' => $data_in_prev,
                        'tagihan' => $data_out,
                        'tagihan_prev' => $data_out_prev
                    ]
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data not available!',
                    'data' => [
                        'pembayaran' => $data_in,
                        'pembayaran_prev' => $data_in_prev,
                        'tagihan' => $data_out,
                        'tagihan_prev' => $data_out_prev
                    ]
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
