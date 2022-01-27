<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\AkunPemasukan;
use App\Models\MetodePembayaran;
use App\Models\Transaksi;

class PemasukanController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data akun pemasukan
        $m_ap = new AkunPemasukan();
        $data['akun_pemasukan'] = $m_ap->findAll();
        // get data metode pembayaran
        $m_mp = new MetodePembayaran();
        $data['metode_pembayaran'] = $m_mp->findAll();
        // show view
        return view('pages/transaksi/pemasukan/index', $data);
    }

    public function create_pemasukan()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // validator rules
            $validator->setRules([
                'kode_akun_pemasukan' => 'required',
                'tanggal_pemasukan' => 'required',
                'nominal_pemasukan' => 'required',
                'metode_pembayaran' => 'required',
                'keterangan_transaksi' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // validation success
                // create model instance
                $m_transaksi = new Transaksi();
                // slice tanggal_pemasukan
                $tanggal_transaksi = explode('-', $this->request->getPost('tanggal_pemasukan'));
                // get bukti transaksi if existed
                $is_bukti_transaksi = $this->request->getPost('is_bukti_transaksi');
                $bukti_transaksi = $this->request->getFile('file') ? $this->request->getFile('file') : false;
                // find previous transaksi
                $prev_transaksi = $m_transaksi
                    ->like('kode_transaksi', $this->request->getPost('kode_akun_pemasukan'))
                    ->orderBy('id_transaksi', 'DESC')
                    ->findAll();
                if ($prev_transaksi && count($prev_transaksi) > 0) {
                    // get previous kode_transaksi
                    $current_kode_transaksi = explode('-', $prev_transaksi[0]['kode_transaksi']);
                    // validate bukti transaksi
                    if ($is_bukti_transaksi) {
                        // validate dokumen pembayaran
                        if (!$bukti_transaksi->isValid()) {
                            // throw error 
                            throw new \RuntimeException($bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')');
                            $result = [
                                'status' => 'error',
                                'message' => $bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')',
                                'data' => []
                            ];
                            return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', $result['message']);
                        }
                        // prevent from tampering upload file .php (backdoor)
                        $validate_file_type = $bukti_transaksi->getMimeType();
                        switch ($validate_file_type) {
                            case 'text/php':
                                return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File validation failed!');
                                break;
                            case 'text/x-php':
                                return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File validation failed!');
                                break;
                            case 'application/php':
                                return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File validation failed!');
                                break;
                            case 'application/x-php':
                                return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File validation failed!');
                                break;
                            case 'application/x-httpd-php':
                                return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File validation failed!');
                                break;
                            case 'application/x-httpd-php-source':
                                return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File validation failed!');
                                break;
                        }
                        // random filename
                        $fn = $this->request->getPost('kode_akun_pemasukan') . '_' . $bukti_transaksi->getRandomName();
                        // move file to public/uploaded/bukti_transaksi
                        $upload_path = $bukti_transaksi->move(ROOTPATH . 'public/uploaded/bukti_transaksi/', $fn);
                        // create new data transaksi
                        $new_transaksi = $m_transaksi->insert([
                            'kode_transaksi' => $this->request->getPost('kode_akun_pemasukan') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . '000' . ((int)$current_kode_transaksi[4] + 1),
                            'kode_unit' => $this->request->getPost('kode_akun_pemasukan'),
                            'kategori_transaksi' => 'D',
                            'q_debit' => $this->request->getPost('nominal_pemasukan'),
                            'kode_metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
                            'tanggal_transaksi' => $this->request->getPost('tanggal_pemasukan'),
                            'keterangan_transaksi' => $this->request->getPost('keterangan_pemasukan'),
                            'bukti_transaksi' => $fn,
                        ]);
                    } else {
                        // create new data transaksi
                        $new_transaksi = $m_transaksi->insert([
                            'kode_transaksi' => $this->request->getPost('kode_akun_pemasukan') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . '000' . ((int)$current_kode_transaksi[4] + 1),
                            'kode_unit' => $this->request->getPost('kode_akun_pemasukan'),
                            'kategori_transaksi' => 'D',
                            'q_debit' => $this->request->getPost('nominal_pemasukan'),
                            'kode_metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
                            'tanggal_transaksi' => $this->request->getPost('tanggal_pemasukan'),
                            'keterangan_transaksi' => $this->request->getPost('keterangan_pemasukan')
                        ]);
                    }
                } else {
                    // first data, create data with first numbering
                    // validate bukti transaksi
                    if ($is_bukti_transaksi) {
                    } else {
                    }
                }
                if ($new_transaksi) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan pemasukan!',
                        'data' => ''
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan transaksi!',
                        'data' => ''
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => $validator->getErrors()
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTraceAsString()
            ]);
        }
    }
}
