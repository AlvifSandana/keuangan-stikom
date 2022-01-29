<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\AkunPemasukan;
use App\Models\MetodePembayaran;
use App\Models\Transaksi;

use function PHPUnit\Framework\isType;

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

    public function get_current_kode_transaksi(String $kode_akun_pemasukan)
    {
        // create model instance
        $m_transaksi = new Transaksi();
        // get previous transaksi
        $prev_transaksi = $m_transaksi
            ->like('kode_transaksi', $kode_akun_pemasukan)
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

    public function create_pemasukan()
    {
        try {
            helper(['custom_helper']);
            $insert_data = [];
            // create validator
            $validator = \Config\Services::validation();
            // validator rules
            $validator->setRules([
                'kode_akun_pemasukan' => 'required',
                'tanggal_pemasukan' => 'required',
                'nominal_pemasukan' => 'required',
                'metode_pembayaran' => 'required',
                #'keterangan_transaksi' => 'required',
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
                // find previous transaksi and get current kode transaksi
                $current_kode_transaksi = $this->get_current_kode_transaksi($this->request->getPost('kode_akun_pemasukan'));
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
                        return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', $result['message']);
                    }
                    // prevent from tampering upload file .php (backdoor)
                    $file_type = $bukti_transaksi->getMimeType();
                    $validate_file_type = check_file_type($file_type);
                    if ($validate_file_type == true || is_string($validate_file_type)) {
                        return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File type is not valid!');
                    }
                    // random filename
                    $fn = $this->request->getPost('kode_akun_pemasukan') . '_' . $bukti_transaksi->getRandomName();
                    // move file to public/uploaded/bukti_transaksi
                    $upload_path = $bukti_transaksi->move(ROOTPATH . 'public/uploaded/bukti_transaksi/', $fn);
                    // set insert data
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pemasukan') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . '000' . ((int)$current_kode_transaksi[4] + 1);
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
                        return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', $result['message']);
                    }
                    // prevent from tampering upload file .php (backdoor)
                    $file_type = $bukti_transaksi->getMimeType();
                    $validate_file_type = check_file_type($file_type);
                    if ($validate_file_type == true || is_string($validate_file_type)) {
                        return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'File type is not valid!');
                    }
                    // random filename
                    $fn = $this->request->getPost('kode_akun_pemasukan') . '_' . $bukti_transaksi->getRandomName();
                    // move file to public/uploaded/bukti_transaksi
                    $upload_path = $bukti_transaksi->move(ROOTPATH . 'public/uploaded/bukti_transaksi/', $fn);
                    // set insert data
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pemasukan') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . $current_kode_transaksi;
                    $insert_data['bukti_transaksi'] = $fn;
                } else if (is_array($current_kode_transaksi)) {
                    // without bukti transaksi
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pemasukan') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . '000' . ((int)$current_kode_transaksi[4] + 1);
                } else {
                    // without bukti transaksi
                    $insert_data['kode_transaksi'] = $this->request->getPost('kode_akun_pemasukan') . '-' . $tanggal_transaksi[1] . '-' . $tanggal_transaksi[0] . '-' . $current_kode_transaksi;
                }
                // set insert data
                $insert_data['kode_unit'] = $this->request->getPost('kode_akun_pemasukan');
                $insert_data['kategori_transaksi'] = 'D';
                $insert_data['q_debit'] = $this->request->getPost('nominal_pemasukan');
                $insert_data['kode_metode_pembayaran'] = $this->request->getPost('metode_pembayaran');
                $insert_data['tanggal_transaksi'] = $this->request->getPost('tanggal_pemasukan');
                $insert_data['keterangan_transaksi'] = $this->request->getPost('keterangan_pemasukan');
                // create new data transaksi
                dd($insert_data);
                $new_transaksi = $m_transaksi->insert($insert_data);
                
                if ($new_transaksi) {
                    // return json_encode([
                    //     'status' => 'success',
                    //     'message' => 'Berhasil menambahkan pemasukan!',
                    //     'data' => ''
                    // ]);
                    return redirect()->to(base_url() . '/transaksi/pemasukan')->with('success', 'File type is not valid!');
                } else {
                    // return json_encode([
                    //     'status' => 'failed',
                    //     'message' => 'Gagal menambahkan transaksi!',
                    //     'data' => ''
                    // ]);
                    return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'Gagal menambahkan transaksi');
                }
            } else {
                // return json_encode([
                //     'status' => 'failed',
                //     'message' => 'Validasi gagal, mohon isi field dengan benar!',
                //     'data' => $validator->getErrors()
                // ]);
                return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', 'Data is not valid!\n'.implode($validator->getErrors()));
            }
        } catch (\Throwable $th) {
            // return json_encode([
            //     'status' => 'error',
            //     'message' => $th->getMessage(),
            //     'data' => $th->getTraceAsString()
            // ]);
            return redirect()->to(base_url() . '/transaksi/pemasukan')->with('error', $th->getMessage());
        }
    }
}
