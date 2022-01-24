<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\ItemPaket;

class ItemPaketController extends BaseController
{
    public function index()
    {
        //
    }

    public function find_item_by_id($id_item)
    {
        try {
            // create model instance
            $m_itempaket = new ItemPaket();
            // get item paket by id_item
            $item_paket = $m_itempaket->where('id_item', $id_item)->find();
            if ($item_paket) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Item paket ditemukan.',
                    'data' => $item_paket,
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Item paket tidak ditemukan.',
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

    /**
     * Create new item paket
     */
    public function create_item()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'angkatan_id' => 'required',
                'semester_id' => 'required',
                'nama_item' => 'required',
                'nominal_item' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_itempaket = new ItemPaket();
                // get last item
                $last_item = $m_itempaket->builder()->orderBy('id_item', 'DESC')->get()->getResultArray();
                $last_kode_item = explode('ITEM', $last_item[0]['kode_item']);
                // insert new data
                $update_item = $m_itempaket->insert([
                    'kode_item' => $last_item ? 'ITEM' . (1 + (int) $last_kode_item[1]) : 'ITEM1',
                    'nama_item' => $this->request->getPost('nama_item'),
                    'nominal_item' => $this->request->getPost('nominal_item'),
                    'keterangan_item' => $this->request->getPost('keterangan_item'),
                    'paket_id' => $this->request->getPost('paket_id') == null ? null : $this->request->getPost('paket_id'),
                    'angkatan_id' => $this->request->getPost('angkatan_id'),
                    'semester_id' => $this->request->getPost('semester_id'),
                ]);
                if ($update_item) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan item paket baru!',
                        'data' => $update_item,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan item paket baru.',
                        'data' => '',
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan lengkap!',
                    'data' => $validator->getErrors(),
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'failed',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }

    /**
     * Update item paket by id_item
     */
    public function update_item($id_item)
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'kode_item' => 'required',
                'paket_id' => 'required',
                'angkatan_id' => 'required',
                'semester_id' => 'required',
                'nama_item' => 'required',
                'nominal_item' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_itempaket = new ItemPaket();
                // update current data
                $update_item = $m_itempaket->update($id_item, [
                    'kode_item' => $this->request->getPost('kode_item'),
                    'nama_item' => $this->request->getPost('nama_item'),
                    'nominal_item' => $this->request->getPost('nominal_item'),
                    'keterangan_item' => $this->request->getPost('keterangan_item'),
                    'paket_id' => $this->request->getPost('paket_id'),
                    'angkatan_id' => $this->request->getPost('angkatan_id'),
                    'semester_id' => $this->request->getPost('semester_id'),
                ]);
                if ($update_item) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil memperbarui item paket!',
                        'data' => $update_item,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui item paket.',
                        'data' => '',
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi field dengan lengkap!',
                    'data' => $validator->getErrors(),
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'failed',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }

    /**
     * Delete item paket by id_item
     */
    public function delete_item($id_item)
    {
        try {
            // create model instance
            $m_itempaket = new ItemPaket();
            // delete item by id_item
            $delete_item = $m_itempaket->delete($id_item);
            if ($delete_item) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Berhasil menghapus item paket!',
                    'data' => $delete_item,
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal menghapus item paket.',
                    'data' => $delete_item,
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'failed',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }
}
