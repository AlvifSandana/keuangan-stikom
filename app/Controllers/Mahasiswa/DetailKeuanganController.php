<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\Transaksi;

class DetailKeuanganController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // show view
        // return view('pages/keuangan_mahasiswa/pembayaran/index', $data);
    }

    /**
     * Detail keuangan seluruh semester by NIM
     */
    public function getDetailKeuangan(String $nim)
    {
        try {
            // validate NIM
            if ($nim != null) {
                // create model
                $m_transaksi = new Transaksi();
                $m_semester = new Semester();
                // get data transaksi (tagihan & pembayaran)
                $data_semester = $m_semester->findAll();
                // count all
                $data_keuangan = [];
                foreach ($data_semester as $key => $value) {
                    // get semester
                    $smt = explode(' ', $value['nama_semester']);
                    // get tagihan by kode_transaksi
                    $tagihan = $m_transaksi
                        ->select('SUM(q_kredit) as total_tagihan')
                        ->like('kode_transaksi', 'BY-' . $nim . '-K-' . $smt[1])
                        ->findAll();
                    $pembayaran = $m_transaksi
                        ->select('SUM(q_debit) as total_pembayaran')
                        ->like('kode_transaksi', 'BY-' . $nim . '-D-' . $smt[1])
                        ->findAll();
                    // result
                    $result = [
                        'detail' => [
                            'semester' =>  $smt[1], $tagihan[0], $pembayaran[0]
                        ]
                    ];
                    array_push($data_keuangan, $result);
                }
                // return data
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data available',
                    'data' => $data_keuangan
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal!',
                    'data' => []
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

    public function cetak_bukti_pembayaran(String $kode_transaksi)
    {
        helper('custom_helper');
        try {
            // create model
            $m_tr = new Transaksi();
            $m_mhs = new Mahasiswa();
            $m_jur = new Jurusan();
            // get data
            $split_kode = explode('-', $kode_transaksi);
            $get_mhs = $m_mhs
                ->where('nim', $split_kode[1])
                ->first();
            $get_jur = $m_jur
                ->where('id_jurusan', $get_mhs['id_jur'])
                ->first();
            $get_tr = $m_tr
                ->where('kode_transaksi', $kode_transaksi)
                ->join('tbl_item_paket', 'tbl_transaksi.item_kode = tbl_item_paket.kode_item', 'left')
                ->first();
            // set data to view
            $data['nim'] = $get_tr['kode_unit'];
            $data['nama_mhs'] = $get_mhs['nama_mhs'];
            $data['jurusan'] = $get_jur['nama_program'].' '.$get_jur['nama_jurusan'];
            $data['nominal'] = $get_tr['q_debit'];
            $data['nama_item'] = $get_tr['nama_item'];
            $data['terbilang'] = terbilang((int)$get_tr['q_debit']);
            $data['tgl'] = tgl_indo(date('Y-m-d'));
            // return view
            return view('pages/keuangan_mahasiswa/pembayaran/detail_keuangan/bukti_pembayaran', $data);
        } catch (\Throwable $th) {
            return view('pages/keuangan_mahasiswa/pembayaran/detail_keuangan/bukti_pembayaran', []);
        }
    }
}
