<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Jurusan;

class JurusanController extends BaseController
{
    public function index()
    {
        //
    }

    /**
     * Create a new data jurusan
     * 
     * @return JSON
     */
    public function create_jurusan()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'nama_jurusan' => 'required',
                'nama_program' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_jurusan = new Jurusan();
                // get last id_jurusan
                $last_jurusan = $m_jurusan->orderBy('id_jurusan', 'DESC')->first();
                $last_id = $last_jurusan != null ? preg_split('#(?<=\d)(?=[a-z])#i', $last_jurusan['id_jurusan']) : [0];
                // create new id from last_id + nama jurusan
                $split_nama_jurusan = explode(' ', $this->request->getPost('nama_jurusan'));
                $two_caps = substr($split_nama_jurusan[0], 0, 1).substr($split_nama_jurusan[1], 0, 1);
                $new_id = '0' . ((int) $last_id[0] + 1) . strtoupper($two_caps);
                // dd($last_jurusan, $last_id, $split_nama_jurusan, $two_caps,$new_id);
                // insert data
                $jurusan = $m_jurusan->insert([
                    'id_jurusan' => $new_id,
                    'nama_jurusan' => $this->request->getPost('nama_jurusan'),
                    'nama_program' => $this->request->getPost('nama_program'),
                ]);
                // check insert result
                if ($jurusan) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil ditambahkan.',
                        'data' => $jurusan,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan data.',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal validasi data.',
                    'data' => $validator->getErrors(),
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }

    /**
     * Update data jurusan by id
     * 
     * @param int @id
     * @return JSON
     */
    public function update_jurusan($id)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'nama_jurusan' => 'required',
                'nama_program' => 'required',
            ]);
            // validation check
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid && $id != null) {
                // create model instance
                $m_jurusan = new Jurusan();
                // insert data
                $jurusan = $m_jurusan->update($id, [
                    'nama_jurusan' => $this->request->getPost('nama_jurusan'),
                    'nama_program' => $this->request->getPost('nama_program'),
                ]);
                // check update result
                if ($jurusan) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil memperbarui data jurusan.',
                        'data' => $jurusan,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui data.',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal validasi data.',
                    'data' => $validator->getErrors(),
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }

    /**
     * Delete data jurusan by id
     * 
     * @return JSON
     */
    public function delete_jurusan($id)
    {
        try {
            if ($id != null) {
                $m_jurusan = new Jurusan();
                // insert data
                $jurusan = $m_jurusan->delete($id);
                // check insert result
                if ($jurusan) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menghapus data jurusan!',
                        'data' => $jurusan,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menghapus data jurusan.',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Invalid ID!',
                    'data' => [],
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }
}
