<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Mahasiswa;
use App\Models\Transaksi;
use CodeIgniter\I18n\Time;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
     * Get laporan pemasukan (JSON)
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
                $pemasukan_dari_mhs = $this->generate_data_pemasukan("MHS", $this->request->getPost('waktu_mulai_income'), $this->request->getPost('waktu_akhir_income'));
                $pemasukan_lain = $this->generate_data_pemasukan("LAIN", $this->request->getPost('waktu_mulai_income'), $this->request->getPost('waktu_akhir_income'));
                // dd($pemasukan_dari_mhs, $pemasukan_lain);
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
     * Get laporan pengeluaran (JSON)
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
     * Get data laporan global (JSON)
     */
    public function laporan_global()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'waktu_mulai_global' => 'required',
                'waktu_akhir_global' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // get data pengeluaran
                $pemasukan = $this->generate_data_pemasukan('PEMASUKAN_ALL');
                $pengeluaran = $this->generate_data_pengeluaran('PENGELUARAN');
                // check
                if (!is_string($pengeluaran) || !is_string($pemasukan)) {
                    $global = array_merge($pemasukan, $pengeluaran);
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data available!',
                        'data' => $global
                    ]);
                } else {
                    $global = array_merge($pemasukan, $pengeluaran);
                    return json_encode([
                        'status' => 'failed',
                        'message' => $global,
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

    public function show_laporan_pemasukan(String $mulai, String $akhir)
    {
        helper('custom_helper');
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // result
        $result = [];
        // create model
        $m_transaksi = new Transaksi();
        // get data pemasukan
        $pemasukan = $m_transaksi->findTransaksi('PEMASUKAN_ALL', 'D', 'id_transaksi', 'ASC', $mulai, $akhir);
        // check
        if (!is_string($pemasukan)) {
            $data['n_pemasukan_akun_pemasukan'] = count(array_unique(array_column($pemasukan, 'kode_unit')));
            $data['n_pemasukan_dari_mhs'] = count($pemasukan) - $data['n_pemasukan_akun_pemasukan'];
            $data['total_pemasukan_akun_pemasukan'] = 0;
            $data['total_pemasukan_dari_mhs'] = 0;
            foreach ($pemasukan as $key => $value) {
                if (strpos($value['kode_unit'], "-")) {
                    $data['total_pemasukan_akun_pemasukan'] += (int)$value['q_debit'];
                } else {
                    $data['total_pemasukan_dari_mhs'] += (int)$value['q_debit'];
                }
            }
            $result = $pemasukan;
        } else {
            $result = "Data tidak ditemukan!";
        }
        $data['pemasukan'] = $result;
        $data['tgl_mulai'] = tgl_indo($mulai);
        $data['tgl_akhir'] = tgl_indo($akhir);
        return view('pages/master/laporan/laporan-pemasukan/index', $data);
    }

    public function show_laporan_pengeluaran(String $mulai, String $akhir)
    {
        helper('custom_helper');
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // result
        $result = [];
        // create model
        $m_transaksi = new Transaksi();
        // get data pemasukan
        $pengeluaran = $m_transaksi->findTransaksi('PENGELUARAN', 'K', 'id_transaksi', 'ASC', $mulai, $akhir);
        // check
        if (!is_string($pengeluaran)) {
            $data['n_pengeluaran'] = count($pengeluaran);
            $data['total_pengeluaran'] = 0;
            foreach ($pengeluaran as $key => $value) {
                $data['total_pengeluaran'] += (int)$value['q_kredit'];
            }
            $result = $pengeluaran;
        } else {
            $result = "Data tidak ditemukan!";
        }
        $data['pengeluaran'] = $result;
        $data['tgl_mulai'] = tgl_indo($mulai);
        $data['tgl_akhir'] = tgl_indo($akhir);
        return view('pages/master/laporan/laporan-pengeluaran/index', $data);
    }

    public function show_laporan_global(String $mulai, String $akhir)
    {
        helper('custom_helper');
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // result
        $result = [];
        // create model
        $m_transaksi = new Transaksi();
        // get data pemasukan
        $pemasukan = $m_transaksi->findTransaksi('PEMASUKAN_ALL', 'D', 'id_transaksi', 'ASC', $mulai, $akhir);
        $pengeluaran = $m_transaksi->findTransaksi('PENGELUARAN', 'K', 'id_transaksi', 'ASC', $mulai, $akhir);
        // check
        if (!is_string($pengeluaran) || !is_string($pemasukan)) {
            $data['n_pemasukan_akun_pemasukan'] = count(array_unique(array_column($pemasukan, 'kode_unit')));
            $data['n_pengeluaran'] = count($pengeluaran);
            $data['n_pemasukan_dari_mhs'] = count($pemasukan) - $data['n_pemasukan_akun_pemasukan'];
            $data['total_pemasukan_akun_pemasukan'] = 0;
            $data['total_pemasukan_dari_mhs'] = 0;
            $data['total_pengeluaran'] = 0;
            // generate .xlsx data
            // create spreadsheet instance
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load(WRITEPATH . 'templates/template-lk-global.xlsx');
            // set spreadsheet styles
            $spreadsheet->getDefaultStyle()->getFont()->setName('CALIBRI');
            $spreadsheet->getDefaultStyle()->getFont()->setSize(12);
            foreach ($pemasukan as $key => $value) {
                if (strpos($value['kode_unit'], "-")) {
                    $data['total_pemasukan_akun_pemasukan'] += (int)$value['q_debit'];
                } else {
                    $data['total_pemasukan_dari_mhs'] += (int)$value['q_debit'];
                }
            }
            foreach ($pengeluaran as $key => $value) {
                $data['total_pengeluaran'] += (int)$value['q_kredit'];
            }
            // merge array pemasukan and pengeluaran
            $result = array_merge($pemasukan, $pengeluaran);
            // set first xlsx index column
            $idcol = 14;
            foreach ($result as $key => $value) {
                // actual xlsx column index 
                $idx = $key + $idcol;
                // get keterangan
                if (strpos($value['kode_unit'], "-")) {
                    $ket = $value['nama_akun'];
                } else {
                    $ket = $value['nama_item'];
                }
                // write data to cell
                $spreadsheet
                    ->setActiveSheetIndex(0)
                    ->setCellValue("B$idx", $key + 1)
                    ->setCellValue("C$idx", "'".$value['kode_unit'])
                    ->setCellValue("D$idx", $value['kategori_transaksi'] == "D" ? 'PEMASUKAN' : "PENGELUARAN")
                    ->setCellValue("E$idx", $ket)
                    ->setCellValue("F$idx", $value['kategori_transaksi'] == "D" ? $value['q_debit'] : $value['q_kredit'])
                    ->setCellValue("G$idx", date('d-M-Y H:i:s', strtotime($value['tanggal_transaksi'])));
            }
            // write data to cell
            $spreadsheet
                ->setActiveSheetIndex(0)
                ->setCellValue('B3', 'PERIODE '.strtoupper(tgl_indo($mulai)).' - '.strtoupper(tgl_indo($akhir)))
                ->setCellValue('G5', $data['n_pemasukan_dari_mhs'])
                ->setCellValue('G6', $data['n_pemasukan_akun_pemasukan'])
                ->setCellValue('G7', $data['n_pengeluaran'])
                ->setCellValue('G8', $data['total_pemasukan_dari_mhs'])
                ->setCellValue('G9', $data['total_pemasukan_akun_pemasukan'])
                ->setCellValue('G10', $data['total_pengeluaran']);
            // write spreadsheet to file
            $filename = 'lk-global-'.date('d-m-Y-H-i-s').'.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save(WRITEPATH.'lk/'.$filename);
            // move file to the public folder
            $file = new \CodeIgniter\Files\File(WRITEPATH.'lk/'.$filename);
            $data['filename'] = $filename;
            $file->move(ROOTPATH.'public/lk', $filename);
        } else {
            $result = "Data tidak ditemukan!";
        }
        $data['global_data'] = $result;
        $data['tgl_mulai'] = tgl_indo($mulai);
        $data['tgl_akhir'] = tgl_indo($akhir);
        return view('pages/master/laporan/laporan-global/index', $data);
    }

    public function laporan_tagihan_mhs_by_nim(String $nim)
    {
        try {
            // begin validation
            $isDataValid = $nim != null ? true : false;
            if ($isDataValid) {
                // create model
                $m_transaksi = new Transaksi();
                // get data tagihan mhs by nim
                $tagihan = $m_transaksi->findTransaksi($nim, 'K', 'semester_id', 'ASC', '', '');
                $pembayaran = $m_transaksi->findTransaksi($nim, 'D', 'semester_id', 'ASC', '', '');
                // validate
                if (!is_string($tagihan) || !is_string($pembayaran)) {
                    // get semester 
                    $smt = [];
                    for ($i = 0; $i < count($tagihan); $i++) {
                        array_push($smt, $tagihan[$i]['semester_id']);
                    }
                    $smt_unique = array_values(array_unique($smt));
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data available!',
                        'data' => [
                            'semester' => $smt_unique,
                            'tagihan' => $tagihan,
                            'pembayaran' => $pembayaran
                        ]
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Data not found!',
                        'data' => []
                    ]);
                }
                // dd($smt_unique);
                // arrange data by semester
                // $data = [];
                // $idx = 0;
                // for($i=0; $i < count($smt_unique); $i++){
                //     for ($j=$idx; $j < count($tagihan); $j++) { 
                //         if ($smt_unique[$i] == $tagihan[$j]['semester_id']) {
                //             array_push($data, $tagihan[$j]);
                //             $idx++;
                //         } else {
                //             break;
                //         }
                //     }
                // }
                // dd($tagihan, $pembayaran, $smt_unique, $data);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon masukkan NIM yang valid!',
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

    public function laporan_tagihan_mhs()
    {
        try {
            // create model
            $m_transaksi = new Transaksi();
            $m_mhs = new Mahasiswa();
            // get data tagihan semua mahasiswa
            $mhs = $m_mhs->where('status', '0')->findAll();
            // check
            if (count($mhs) > 0) {
                // get tagihan per mhs
                $all_tagihan = [];
                for ($i = 0; $i < count($mhs); $i++) {
                    $tagihan = $m_transaksi->findTransaksi($mhs[$i]['nim'], 'K', 'semester_id', 'ASC', '', '');
                    if (!is_string($tagihan)) {
                        array_push($all_tagihan, $tagihan);
                    }
                }
                // dd($mhs, $all_tagihan);
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data available!',
                    'data' => []
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data not found!',
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
    public function generate_data_pemasukan(String $type, String $from = '', String $to = '')
    {
        try {
            // result
            $result = [];
            // create model
            $m_transaksi = new Transaksi();
            // get data pemasukan
            $pemasukan = $m_transaksi->findTransaksi($type, 'D', 'id_transaksi', 'ASC', '2021-12-21', '2022-01-01');
            // check
            if (is_string($pemasukan)) {
                $result = "Data tidak ditemukan!";
            } else {
                $result = $pemasukan;
            }
            return json_encode($result);
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
