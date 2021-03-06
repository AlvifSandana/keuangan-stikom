<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\AkunPengeluaran;
use App\Models\MetodePembayaran;
use App\Models\Transaksi;

class PengeluaranController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data akun pengeluaran
        $m_ap = new AkunPengeluaran();
        $data['akun_pengeluaran'] = $m_ap->findAll();
        // get data metode pembayaran
        $m_mp = new MetodePembayaran();
        $data['metode_pembayaran'] = $m_mp->findAll();
        // show view
        return view('pages/transaksi/pengeluaran/index', $data);
    }

    public function get_current_kode_transaksi(String $kode_akun_pengeluaran)
    {
        // create model instance
        $m_transaksi = new Transaksi();
        // get previous transaksi
        $prev_transaksi = $m_transaksi
            ->like('kode_transaksi', $kode_akun_pengeluaran)
            ->orderBy('id_transaksi', 'DESC')
            ->findAll();
        // check
        if (count($prev_transaksi) > 0) {
            // get previous kode_transaksi
            $current_kode_transaksi = explode('-', $prev_transaksi[0]['kode_transaksi']);
            return $current_kode_transaksi;
        } else {
            return '0001';
        }
    }

    public function create_pengeluaran()
    {
        try {
            helper(['custom_helper']);
            $insert_data = [];
            // create validator
            $validator = \Config\Services::validation();
            // validator rules
            $validator->setRules([
                'kode_akun_pengeluaran' => 'required',
                'tanggal_pengeluaran' => 'required',
                'nominal_pengeluaran' => 'required',
                'metode_pembayaran' => 'required',
                #'keterangan_transaksi' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // validation success
                // create model instance
                $m_transaksi = new Transaksi();
                // slice tanggal_pengeluaran
                $tanggal_transaksi = explode('-', $this->request->getPost('tanggal_pengeluaran'));
                // get bukti transaksi if existed
                $is_bukti_transaksi = $this->request->getPost('is_bukti_transaksi');
                $bukti_transaksi = $this->request->getFile('bukti_transaksi') ? $this->request->getFile('bukti_transaksi') : false;
                // find previous transaksi and get current kode transaksi
                $current_kode_transaksi = $this->get_current_kode_transaksi($this->request->getPost('kode_akun_pengeluaran'));
                // check current kode transaksi and bukti pembayaran
                if (is_array($current_kode_transaksi) && $is_bukti_transaksi) {
                    // validate dokumen pembayaran
                    if (!$bukti_transaksi->isValid()) {
                        // throw error 
                        throw new \RuntimeException($bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')');
                        $result = [
                            'status' => 'error',
                            'message' => $bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')',
                            'data' => []
                        ];
                        return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('error', $result['message']);
                    }
                    // prevent from tampering upload file .php (backdoor)
                    $file_type = $bukti_transaksi->getMimeType();
                    $validate_file_type = check_file_type($file_type);
                    if ($validate_file_type == true || is_string($validate_file_type)) {
                        return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('error', 'File type is not valid!');
                    }
                    // random filename
                    $fn = $this->request->getPost('kode_akun_pengeluaran') . '_' . $bukti_transaksi->getRandomName();
                    // move file to public/uploaded/bukti_transaksi
                    $upload_path = $bukti_transaksi->move(ROOTPATH . 'public/uploaded/bukti_transaksi/', $fn);
                    // set insert data
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pengeluaran') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . '000' . ((int)$current_kode_transaksi[4] + 1);
                    $insert_data['bukti_transaksi'] = $fn;
                } else if (is_string($current_kode_transaksi) && $is_bukti_transaksi) {
                    // first data, create data with first numbering
                    // validate dokumen pembayaran
                    if (!$bukti_transaksi->isValid()) {
                        // throw error 
                        throw new \RuntimeException($bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')');
                        $result = [
                            'status' => 'error',
                            'message' => $bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')',
                            'data' => []
                        ];
                        return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('error', $result['message']);
                    }
                    // prevent from tampering upload file .php (backdoor)
                    $file_type = $bukti_transaksi->getMimeType();
                    $validate_file_type = check_file_type($file_type);
                    if ($validate_file_type == true || is_string($validate_file_type)) {
                        return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('error', 'File type is not valid!');
                    }
                    // random filename
                    $fn = $this->request->getPost('kode_akun_pengeluaran') . '_' . $bukti_transaksi->getRandomName();
                    // move file to public/uploaded/bukti_transaksi
                    $upload_path = $bukti_transaksi->move(ROOTPATH . 'public/uploaded/bukti_transaksi/', $fn);
                    // set insert data
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pengeluaran') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . $current_kode_transaksi;
                    $insert_data['bukti_transaksi'] = $fn;
                } else if (is_array($current_kode_transaksi)) {
                    // without bukti transaksi
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pengeluaran') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . '000' . ((int)$current_kode_transaksi[4] + 1);
                } else {
                    // without bukti transaksi
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pengeluaran') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . $current_kode_transaksi;
                }
                // set insert data
                $insert_data['kode_unit'] = $this->request->getPost('kode_akun_pengeluaran');
                $insert_data['kategori_transaksi'] = 'K';
                $insert_data['q_kredit'] = $this->request->getPost('nominal_pengeluaran');
                $insert_data['kode_metode_pembayaran'] = $this->request->getPost('metode_pembayaran');
                $insert_data['tanggal_transaksi'] = $this->request->getPost('tanggal_pengeluaran');
                $insert_data['keterangan_transaksi'] = $this->request->getPost('keterangan_pengeluaran');
                // create new data transaksi
                // dd($insert_data);
                $new_transaksi = $m_transaksi->insert($insert_data);
                
                if ($new_transaksi) {
                    // return json_encode([
                    //     'status' => 'success',
                    //     'message' => 'Berhasil menambahkan pemasukan!',
                    //     'data' => ''
                    // ]);
                    return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('success', 'Berhasil menambahkan transaksi baru!');
                } else {
                    // return json_encode([
                    //     'status' => 'failed',
                    //     'message' => 'Gagal menambahkan transaksi!',
                    //     'data' => ''
                    // ]);
                    return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('error', 'Gagal menambahkan transaksi');
                }
            } else {
                // return json_encode([
                //     'status' => 'failed',
                //     'message' => 'Validasi gagal, mohon isi field dengan benar!',
                //     'data' => $validator->getErrors()
                // ]);
                return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('error', 'Data is not valid!\n'.implode($validator->getErrors()));
            }
        } catch (\Throwable $th) {
            // return json_encode([
            //     'status' => 'error',
            //     'message' => $th->getMessage(),
            //     'data' => $th->getTraceAsString()
            // ]);
            return redirect()->to(base_url() . '/transaksi/pengeluaran')->with('error', $th->getMessage());
        }
    }
}
