<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\MetodePembayaran;

class MetodePembayaranController extends BaseController
{
    public function index()
    {
        //
    }

    /**
     * Create MP
     */
    public function create_mp()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'nama_mp' => 'required'
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_mp = new MetodePembayaran();
                // get previous mp
                $prev_mp = $m_mp->orderBy('id_metode', 'DESC')->findAll();
                if(count($prev_mp) > 0){
                    // get current id
                    $current_id = preg_split('#(?<=\d)(?=[a-z])#i', $prev_mp[0]['id_metode']);
                    $new_nama_mp = str_replace(' ', '', $this->request->getPost('nama_mp'));
                    $new_id = '0'.((int)$current_id[0] + 1).$new_nama_mp;
                } else {
                    $new_nama_mp = str_replace(' ', '',  $this->request->getPost('nama_mp'));
                    $new_id = '01'.$new_nama_mp;
                }
                // dd($prev_mp, $new_nama_mp, $new_id);
                // insert new mp
                $insert_data = $m_mp->insert([
                    'id_metode' => $new_id,
                    'nama_metode_pembayaran' => $this->request->getPost('nama_mp')
                ]);
                // check
                if ($insert_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil ditambahkan!',
                        'data' => ''
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan data!',
                        'data' => ''
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed', 
                    'message' => 'Validasi gagal! Mohon isi form dengan benar!',
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
     * Update MP
     */
    public function update_mp($id_metode)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'nama_mp' => 'required'
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_mp = new MetodePembayaran();
                // update mp
                $insert_data = $m_mp->update($id_metode, [
                    'nama_metode_pembayaran' => $this->request->getPost('nama_mp')
                ]);
                // check
                if ($insert_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil diperbarui!',
                        'data' => ''
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui data!',
                        'data' => ''
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed', 
                    'message' => 'Validasi gagal! Mohon isi form dengan benar!',
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
     * Delete MP
     */
    public function delete_mp($id_metode)
    {
        try {
            // create model
            $m_mp = new MetodePembayaran();
            // delete data by id
            $delete_data = $m_mp->delete($id_metode);
            // check
            if ($delete_data) {
                return json_encode([
                    'status' => 'success', 
                    'message' => 'Data berhasil dihapus!',
                    'data' => ''
                ]);
            } else {
                return json_encode([
                    'status' => 'failed', 
                    'message' => 'Gagal menghapus data!',
                    'data' => ''
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
}
