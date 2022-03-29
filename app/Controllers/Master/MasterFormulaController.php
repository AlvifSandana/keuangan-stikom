<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\MasterFormula;

class MasterFormulaController extends BaseController
{
    public function index()
    {
    }

    /**
     * Create new master formula
     */
    public function create_master_formula()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validation rules
            $validator->setRules([
                'formula_tw' => 'required',
                'formula_tb' => 'required'
            ]);
            // begin validation 
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_mformula = new MasterFormula();
                // check previous formula
                $prev_formula = $m_mformula->orderBy('id_mformula', 'DESC')->findAll();
                if (count($prev_formula) > 0) {
                    // get previous kode formula
                    $prev_kode = explode('MF', $prev_formula[0]['kode_mformula']);
                    // create new kode formula
                    $new_kode = 'MF' . ((int)$prev_kode[1] + 1);
                    // new id
                    $new_id = (int)$prev_formula[0]['id_mformula'] + 1;
                } else {
                    // create new kode formula
                    $new_kode = 'MF1';
                    // new id
                    $new_id = 1;
                }
                // insert new master formula
                $insert_data = $m_mformula->insert([
                    'id_mformula' => $new_id == 1? 1 : $new_id,
                    'kode_mformula' => $new_kode,
                    'persentase_tw' => $this->request->getPost('formula_tw'),
                    'persentase_tb' => $this->request->getPost('formula_tb'),
                ]);
                // check
                if ($insert_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan master formula!',
                        'data' => []
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan master formula!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi form dengan benar!',
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
     * Update master formula
     */
    public function update_master_formula(String $id_mformula)
    {
        try {
            if ($id_mformula != null) {
                // create validator
                $validator = \Config\Services::validation();
                // set validation rules
                $validator->setRules([
                    'formula_tw' => 'required',
                    'formula_tb' => 'required'
                ]);
                // begin validation 
                $isDataValid = $validator->withRequest($this->request)->run();
                if ($isDataValid) {
                    // create model
                    $m_mformula = new MasterFormula();
                    // update new master formula
                    $update_data = $m_mformula->update($id_mformula, [
                        'persentase_tw' => $this->request->getPost('formula_tw'),
                        'persentase_tb' => $this->request->getPost('formula_tb'),
                    ]);
                    // check
                    if ($update_data) {
                        return json_encode([
                            'status' => 'success',
                            'message' => 'Berhasil memperbarui master formula!',
                            'data' => []
                        ]);
                    } else {
                        return json_encode([
                            'status' => 'failed',
                            'message' => 'Gagal memperbarui master formula!',
                            'data' => []
                        ]);
                    }
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Validasi gagal, mohon isi form dengan benar!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi form dengan benar!',
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
     * Delete master formula by kode_mformula
     */
    public function delete_master_formula(String $kode_mformula)
    {
        try {
            if ($kode_mformula != null) {
                // create model 
                $m_mformula = new MasterFormula();
                // delete master formula by id
                $delete_formula = $m_mformula->delete($kode_mformula);
                // check
                if ($delete_formula) {
                    return json_encode([
                        'status' => 'success', 
                        'message'=> 'Berhasil menghapus master formula!', 
                        'data' => []
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed', 
                        'message'=> 'Gagal menghapus master formula!', 
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message'=> 'Validasi gagal!', 
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
}
