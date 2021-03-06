<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Semester;

class SemesterController extends BaseController
{
    public function index()
    {
        //
    }

    /**
     * Create a new data semester
     * 
     * @return JSON
     */
    public function create_semester()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'nama_semester' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_semester = new Semester();
                // get last semester
                $last_semester = $m_semester->orderBy('id_semester', 'DESC')->first();
                // get last id semester
                $matches = [];
                if ($last_semester != null) {
                    preg_match("/([A-Z]+)(\\d+)/", $last_semester['id_semester'],$matches);
                } else {
                    $matches = [0, 0, 0];
                }
                // insert data
                $semester = $m_semester->insert([
                    'id_semester' => 'SMT'.((int) $matches[2] + 1),
                    'nama_semester' => $this->request->getPost('nama_semester'),
                ]);
                // check insert result
                if ($semester) {
                    $result['status'] = 'success';
                    $result['message'] = 'Data berhasil ditambahkan.';
                    $result['data'] = $semester;
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
     * Update data semester by id
     * 
     * @param int @id
     * @return JSON
     */
    public function update_semester($id)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'nama_semester' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid && $id != null) {
                // create model instance
                $m_semester = new Semester();
                // insert data
                $semester = $m_semester->update($id, [
                    'nama_semester' => $this->request->getPost('nama_semester'),
                ]);
                // check insert result
                if ($semester) {
                    $result['status'] = 'success';
                    $result['message'] = 'Data berhasil diperbarui!';
                    $result['data'] = $semester;
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
     * Delete data semester by id
     * 
     * @return JSON
     */
    public function delete_semester($id)
    {
        try {
            if ($id != null) {
                $m_semester = new Semester();
                // insert data
                $semester = $m_semester->delete($id);
                // check insert result
                if ($semester) {
                    $result['status'] = 'success';
                    $result['message'] = 'Berhasil menghapus data semester dengan ID ' . $id;
                    $result['data'] = $semester;
                    return json_encode($result);
                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'Gagal menghapus data semester dengan ID ' . $id;
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
