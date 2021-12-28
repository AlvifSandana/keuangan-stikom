<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Angkatan;

class AngkatanController extends BaseController
{
    public function index()
    {
        //
    }

    /**
     * Create a new data tahun angkatan
     * 
     * @return JSON
    */
    public function create_angkatan()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validation rules
            $validator->setRules([
                'tahun_angkatan' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_angkatan = new Angkatan();
                // insert data
                $angkatan = $m_angkatan->insert([
                    'tahun_angkatan' => $this->request->getPost('tahun_angkatan')
                ]);
                // result check
                if ($angkatan) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan data tahun angkatan baru.',
                        'data' => $angkatan
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan data tahun angkatan.',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal validasi data.',
                    'data' => $validator->getErrors()
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
     * Update data tahun angkatan by id
     * 
     * @param int $id
     * @return JSON
     */
    public function updateAngkatan($id)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validation rules
            $validator->setRules([
                'tahun_angkatan' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid && $id != null) {
                // create model instance
                $m_angkatan = new Angkatan();
                // insert data
                $angkatan = $m_angkatan->update($id, [
                    'tahun_angkatan' => $this->request->getPost('tahun_angkatan')
                ]);
                // result check
                if ($angkatan) {
                    $result['status'] = 'success';
                    $result['message'] = 'Berhasil memperbarui data tahun angkatan dengan ID ' . $id;
                    $result['data'] = $angkatan;
                    return json_encode($result);
                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'Gagal memperbarui data tahun angkatan dengan ID ' . $id;
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
            $result['data'] = [];
            return json_encode($result);
        }
    }

    /**
     * Delete data tahun angkatan by id
     * 
     * @param int $id
     * @return JSON
     */
    public function deleteAngkatan($id)
    {
        try {
            if ($id) {
                // create model instance
                $m_angkatan = new Angkatan();
                // insert data
                $angkatan = $m_angkatan->delete($id);
                // result check
                if ($angkatan) {
                    $result['status'] = 'success';
                    $result['message'] = 'Berhasil menghapus data tahun angkatan dengan ID ' . $id;
                    $result['data'] = $angkatan;
                    return json_encode($result);
                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'Gagal menghapus data tahun angkatan dengan ID ' . $id;
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
            $result['data'] = [];
            return json_encode($result);
        }
    }
}
