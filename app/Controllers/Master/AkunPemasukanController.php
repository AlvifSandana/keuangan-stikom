<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AkunPemasukan;

class AkunPemasukanController extends BaseController
{
    public function index()
    {
        // create request and model instance
        $request = \Config\Services::request();
        $m_akun_pemasukan = new AkunPemasukan();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data akun pemasukan
        $data['akun_pemasukan'] = $m_akun_pemasukan->findAll();
        // show view
        return view('pages/master/keuangan/akun_pemasukan/index', $data);
    }

    /**
     * get data akun pemasukan by id
     */
    public function get_akun_by_id($id_akun)
    {
        try {
            // create model instance
            $m_akun_pemasukan = new AkunPemasukan();
            // find data by id
            $find_data = $m_akun_pemasukan->where('id_akun', $id_akun)->first();
            // check
            if ($find_data) {
                return json_encode([
                    'status' => 'success',
                    'message'=> 'Data available!',
                    'data' => $find_data
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message'=> 'Data unavailable!',
                    'data' => []
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message'=> $th->getMessage(),
                'data' => $th->getTrace()
            ]);
        }
    }

    /**
     * create new akun pemasukan
     */
    public function create_akun()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            // set validation rules
            $validator->setRules([
                'kode_akun' => 'required',
                'nama_akun' => 'required'
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_akun_pemasukan = new AkunPemasukan();
                // insert new data
                $insert_data = $m_akun_pemasukan->insert([
                    'kode_akun' => $this->request->getPost('kode_akun'),
                    'nama_akun' => $this->request->getPost('nama_akun'),
                ]);
                // check
                if ($insert_data) {
                    return json_encode([
                        'status' => 'success',
                        'message'=> 'Berhasil menambahkan akun baru!',
                        'data' => [],
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message'=> 'Gagal menambahkan akun baru!',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message'=> 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => [],
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message'=> $th->getMessage(),
                'data' => $th->getTrace()
            ]);
        }
    
    }
    /**
     * update akun pemasukan by id
     */
    public function update_akun()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            // set validation rules
            $validator->setRules([
                'kode_akun' => 'required',
                'nama_akun' => 'required'
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_akun_pemasukan = new AkunPemasukan();
                // insert new data
                $update_data = $m_akun_pemasukan->update($this->request->getPost('id_akun'), [
                    'kode_akun' => $this->request->getPost('kode_akun'),
                    'nama_akun' => $this->request->getPost('nama_akun'),
                ]);
                // check
                if ($update_data) {
                    return json_encode([
                        'status' => 'success',
                        'message'=> 'Berhasil memperbarui data akun!',
                        'data' => [],
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message'=> 'Gagal memperbarui data akun!',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message'=> 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => [],
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message'=> $th->getMessage(),
                'data' => $th->getTrace()
            ]);
        }
    }

    /**
     * delete akun pemasukan by id
     */
    public function delete_akun($id_akun)
    {
        try {
            if (!$id_akun) {
                return redirect()->to(base_url().'/master-keuangan/akun-pemasukan')->with('error', 'Invalid id_akun !');
            } else {
                // create model instance
                $m_akun_pemasukan = new AkunPemasukan();
                // delete data
                $delete_data = $m_akun_pemasukan->delete($id_akun);
                // check
                if ($delete_data) {
                    return redirect()->to(base_url().'/master-keuangan/akun-pemasukan')->with('success', 'Berhasil menghapus akun!');
                } else {
                    return redirect()->to(base_url().'/master-keuangan/akun-pemasukan')->with('failed', 'Gagal menghapus akun!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->to(base_url().'/master-keuangan/akun-pemasukan')->with('error', $th->getMessage());
        }
    }
}
