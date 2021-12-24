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

    /**
     * Create new item paket
     */
    public function create_item()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
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
                // get last item
                $last_item = $m_itempaket->builder()->orderBy('kode_item', 'DESC')->get()->getResultArray();
                $last_kode_item = explode('ITEM', $last_item[0]['kode_item']);
                // insert new data
                $new_item = $m_itempaket->insert([
                    'kode_item' => $last_item ? 'ITEM'.(1 + (int) $last_kode_item[1]) : 'ITEM1',
                    'nama_item' => $this->request->getPost('nama_item'),
                    'nominal_item' => $this->request->getPost('nominal_item'),
                    'paket_id' => $this->request->getPost('paket_id'),
                    'angkatan_id' => $this->request->getPost('angkatan_id'),
                    'semester_id' => $this->request->getPost('semester_id'),
                ]);
                if ($new_item) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan item paket baru!',
                        'data' => $new_item,
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
}
