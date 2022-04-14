<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\SesiKuliah;

class SesiKuliahController extends BaseController
{
    public function index()
    {
        //
    }

     /**
     * Create a new data sesikuliah
     * 
     * @return JSON
     */
    public function create_sesikuliah()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'nama_sesikuliah' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_sesikuliah = new SesiKuliah();
                // get last sesikuliah
                $last_sesikuliah = $m_sesikuliah->orderBy('id_sesi', 'DESC')->first();
                // get last id sesikuliah
                $matches = [];
                if ($last_sesikuliah != null) {
                    $matches = preg_split("/(?<=[0-9])(?=[a-z]+)/i", $last_sesikuliah['id_sesi']);
                } else {
                    $matches = [0, 0, 0];
                }
                // insert data
                $sesikuliah = $m_sesikuliah->insert([
                    'id_sesi' => '0'.((int) $matches[0] + 1).strtoupper(substr($this->request->getPost('nama_sesikuliah'), 0, 1)),
                    'nama_sesi' => $this->request->getPost('nama_sesikuliah'),
                ]);
                // check insert result
                if ($sesikuliah) {
                    $result['status'] = 'success';
                    $result['message'] = 'Data berhasil ditambahkan.';
                    $result['data'] = $sesikuliah;
                    return json_encode($result);
                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'Gagal menambahkan data.';
                    $result['data'] = [];
                    return json_encode($result);
                }
            } else {
                $result['status'] = 'failed';
                $result['message'] = 'Gagal validasi data.';
                $result['data'] = $validator->getErrors();
                return json_encode($result);
            }
        } catch (\Throwable $th) {
            $result['status'] = 'error';
            $result['message'] = $th->getMessage();
            $result['data'] = $th->getTrace();
            return json_encode($result);
        }
    }

    /**
     * Update data sesikuliah by id
     * 
     * @param int @id
     * @return JSON
     */
    public function update_sesikuliah($id)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'nama_sesikuliah' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid && $id != null) {
                // create model instance
                $m_sesikuliah = new SesiKuliah();
                // insert data
                $sesikuliah = $m_sesikuliah->update($id, [
                    'nama_sesi' => $this->request->getPost('nama_sesikuliah'),
                ]);
                // check insert result
                if ($sesikuliah) {
                    $result['status'] = 'success';
                    $result['message'] = 'Data berhasil diperbarui!';
                    $result['data'] = $sesikuliah;
                    return json_encode($result);
                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'Gagal memperbarui data.';
                    $result['data'] = [];
                    return json_encode($result);
                }
            } else {
                $result['status'] = 'failed';
                $result['message'] = 'Gagal validasi data.';
                $result['data'] = $validator->getErrors();
                return json_encode($result);
            }
        } catch (\Throwable $th) {
            $result['status'] = 'error';
            $result['message'] = $th->getMessage();
            $result['data'] = $th->getTrace();
            return json_encode($result);
        }
    }

    /**
     * Delete data sesikuliah by id
     * 
     * @return JSON
     */
    public function delete_sesikuliah($id)
    {
        try {
            if ($id != null) {
                $m_sesikuliah = new SesiKuliah();
                // insert data
                $sesikuliah = $m_sesikuliah->delete($id);
                // check insert result
                if ($sesikuliah) {
                    $result['status'] = 'success';
                    $result['message'] = 'Berhasil menghapus data sesikuliah dengan ID ' . $id;
                    $result['data'] = $sesikuliah;
                    return json_encode($result);
                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'Gagal menghapus data sesikuliah dengan ID ' . $id;
                    $result['data'] = [];
                    return json_encode($result);
                }
            } else {
                $result['status'] = 'failed';
                $result['message'] = 'ID invalid!';
                $result['data'] = [];
                return json_encode($result);
            }
        } catch (\Throwable $th) {
            $result['status'] = 'error';
            $result['message'] = $th->getMessage();
            $result['data'] = $th->getTrace();
            return json_encode($result);
        }
    }
}
