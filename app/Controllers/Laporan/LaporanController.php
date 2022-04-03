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

    /**
     * Get laporan pemasukan
     */
    public function laporan_pemasukan()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'waktu_mulai_income' => 'required',
                'waktu_akhir_income' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // get data pemasukan
                $pemasukan_dari_mhs = $this->generate_data_pemasukan("MHS");
                $pemasukan_lain = $this->generate_data_pemasukan("LAIN");
                dd($pemasukan_dari_mhs, $pemasukan_lain);
                // check
                if (!is_string($pemasukan_dari_mhs) || !is_string($pemasukan_lain)) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data available!',
                        'data' => [$pemasukan_dari_mhs, $pemasukan_lain]
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => '',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field waktu mulai dan berakhir dengan benar!',
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

    /**
     * Get laporan pengeluaran
     */
    public function laporan_pengeluaran()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'waktu_mulai_outcome' => 'required',
                'waktu_akhir_outcome' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_transaksi = new Transaksi();
                // get data pengeluaran
                $pengeluaran = $this->generate_data_pengeluaran('PENGELUARAN');
                // check
                if (!is_string($pengeluaran)) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data available!',
                        'data' => $pengeluaran
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => $pengeluaran,
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field waktu mulai dan berakhir dengan benar!',
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

    /**
     * generate data pemasukan by type (MHS, LAIN)
     */
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
            if (!is_string($pemasukan)) {
                $result = $pemasukan;
            } else {
                $result = "Data tidak ditemukan!";
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Generate data pengeluaran by type (PENGELUARAN)
     */
    public function generate_data_pengeluaran(String $type)
    {
        try {

            // result
            $result = [];
            // create model
            $m_transaksi = new Transaksi();
            // get data pemasukan
            $pemasukan = $m_transaksi->findTransaksi($type, 'K', 'id_transaksi', 'ASC', '2021-12-01', '2022-12-12');
            // check
            if (!is_string($pemasukan)) {
                $result = $pemasukan;
            } else {
                $result = "Data tidak ditemukan!";
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
