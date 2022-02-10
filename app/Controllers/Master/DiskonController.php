<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\ItemPaket;

class DiskonController extends BaseController
{
    public function index()
    {
        //
    }

    /**
     * create new diskon
     */
    public function create_diskon()
    {
        try {
            // create validator 
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'nama_item' => 'required',
                'angkatan_id' => 'required',
                'semester_id' => 'required',
                'nominal_item' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_itempaket = new ItemPaket();
                // get previous item paket
                $prev_item = $m_itempaket->orderBy('id_item', 'DESC')->findAll();
                if (count($prev_item) > 0) {
                    // get previous kode item
                    $prev_kode = explode('ITEM', $prev_item[0]['kode_item']);
                    // insert data
                    $insert_data = $m_itempaket->insert([
                        'kode_item' => 'ITEM' . ((int)$prev_kode[1] + 1),
                        'nama_item' => $this->request->getPost('nama_item'),
                        'nominal_item' => $this->request->getPost('nominal_item'),
                        'keterangan_item' => $this->request->getPost('keterangan_item'),
                        'angkatan_id' => $this->request->getPost('angkatan_id'),
                        'semester_id' => $this->request->getPost('semester_id'),
                    ]);
                } else {
                    // insert data
                    $insert_data = $m_itempaket->insert([
                        'kode_item' => 'ITEM1',
                        'nama_item' => $this->request->getPost('nama_item'),
                        'nominal_item' => $this->request->getPost('nominal_item'),
                        'keterangan_item' => $this->request->getPost('keterangan_item'),
                        'angkatan_id' => $this->request->getPost('angkatan_id'),
                        'semester_id' => $this->request->getPost('semester_id'),
                    ]);
                }
                // check
                if ($insert_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan diskon baru!',
                        'data' => []
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan diskon baru!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => $validator->getError()
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
     * update diskon by id_item
     */
    public function update_diskon()
    {
        try {
            // create validator 
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'id_item' => 'required',
                'nama_item' => 'required',
                'angkatan_id' => 'required',
                'semester_id' => 'required',
                'nominal_item' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_itempaket = new ItemPaket();
                // insert data
                $update_data = $m_itempaket->update($this->request->getPost('id_item'), [
                    'nama_item' => $this->request->getPost('nama_item'),
                    'nominal_item' => $this->request->getPost('nominal_item'),
                    'keterangan_item' => $this->request->getPost('keterangan_item'),
                    'angkatan_id' => $this->request->getPost('angkatan_id'),
                    'semester_id' => $this->request->getPost('semester_id'),
                ]);
                // check
                if ($update_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil memperbarui data diskon!',
                        'data' => []
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui data diskon!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan benar!',
                    'data' => $validator->getError()
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

    public function delete_diskon($id_item)
    {
        try {
            // create model
            $m_itempaket = new ItemPaket();
            // delete diskon
            $delete_data = $m_itempaket->delete($id_item);
            // check
            if ($delete_data) {
                return json_encode([
                    'status' => '',
                    'message'=> '',
                    'data' => []
                ]);
            } else {
                return json_encode([
                    'status' => '',
                    'message'=> '',
                    'data' => []
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => '',
                'message'=> '',
                'data' => []
            ]);
        }
    }
}
