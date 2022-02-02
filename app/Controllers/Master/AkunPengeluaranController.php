<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AkunPengeluaran;

class AkunPengeluaranController extends BaseController
{
    public function index()
    {
        // create request and model instance
        $request = \Config\Services::request();
        $m_akun_pengeluaran = new AkunPengeluaran();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data akun pengeluaran
        $data['akun_pengeluaran'] = $m_akun_pengeluaran->findAll();
        // show view
        return view('pages/master/keuangan/akun_pengeluaran/index', $data);
    }

    /**
     * get data akun pengeluaran by id
     */
    public function get_akun_by_id($id_akun)
    {
        try {
            // create model instance
            $m_akun_pengeluaran = new AkunPengeluaran();
            // find data by id
            $find_data = $m_akun_pengeluaran->where('id_akun', $id_akun)->first();
            // check
            if ($find_data) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data available!',
                    'data' => $find_data
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data unavailable!',
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
     * create new akun pengeluaran
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
                $m_akun_pengeluaran = new AkunPengeluaran();
                // insert new data
                $insert_data = $m_akun_pengeluaran->insert([
                    'kode_akun' => $this->request->getPost('kode_akun'),
                    'nama_akun' => $this->request->getPost('nama_akun'),
                ]);
                // check
                if ($insert_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan akun baru!',
                        'data' => [],
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan akun baru!',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => [],
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
     * update akun pengeluaran by id
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
                $m_akun_pengeluaran = new AkunPengeluaran();
                // insert new data
                $update_data = $m_akun_pengeluaran->update($this->request->getPost('id_akun'), [
                    'kode_akun' => $this->request->getPost('kode_akun'),
                    'nama_akun' => $this->request->getPost('nama_akun'),
                ]);
                // check
                if ($update_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil memperbarui data akun!',
                        'data' => [],
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui data akun!',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => [],
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
     * delete akun pengeluaran by id
     */
    public function delete_akun($id_akun)
    {
        try {
            if (!$id_akun) {
                return redirect()->to(base_url() . '/master-keuangan/akun-pengeluaran')->with('error', 'Invalid id_akun !');
            } else {
                // create model instance
                $m_akun_pengeluaran = new AkunPengeluaran();
                // delete data
                $delete_data = $m_akun_pengeluaran->delete($id_akun);
                // check
                if ($delete_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menghapus akun!',
                        'data' => []
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menghapus akun!',
                        'data' => []
                    ]);
                }
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
