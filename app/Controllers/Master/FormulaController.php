<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Formula;
use App\Models\ItemPaket;

class FormulaController extends BaseController
{
    public function index()
    {
        // create request and model instance
        $request = \Config\Services::request();
        $m_formula = new Formula();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data formula
        $data['formula'] = $m_formula->findAll();
        // get data akun pemasukan
        return view('pages/master/keuangan/formula/index', $data);
    }

    /**
     * get item paket + formula by id_item
     */
    public function get_item_formula_by_id($id_item)
    {
        try {
            if ($id_item != null) {
                // create model
                $m_item = new ItemPaket();
                // get data
                $item = $m_item
                    ->where('id_item', $id_item)
                    ->join('tbl_formula', 'kode_item = tbl_formula.item_kode', 'left')
                    ->first();
                // check
                if($item) {
                    return json_encode([
                        'status' => 'success',
                        'message'=> 'Data available!',
                        'data' => $item
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message'=> 'Data unavailable!',
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

    /**
     * create new formula
     */
    public function create_formula()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'item_kode' => 'required',
                'persentase' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_formula = new Formula();
                // get previous kode_formula
                $prev_formula = $m_formula->orderBy('id_formula', 'DESC')->findAll();
                // check
                if (count($prev_formula) > 0) {
                    // get kode formula
                    $prev_kode_formula = explode('FORMULA', $prev_formula[0]['kode_formula']);
                    // insert new data
                    $insert_data = $m_formula->insert([
                        'kode_formula' => 'FORMULA' . ((int)$prev_kode_formula[1] + 1),
                        'item_kode' => $this->request->getPost('item_kode'),
                        'persentase' => $this->request->getPost('presentase')
                    ]);
                    // check
                    if ($insert_data) {
                        return json_encode([
                            'status' => 'success',
                            'message' => 'Berhasil menambahkan formula!',
                            'data' => $insert_data
                        ]);
                    } else {
                        return json_encode([
                            'status' => 'failed',
                            'message' => 'Gagal menambahkan formula!',
                            'data' => []
                        ]);
                    }
                } else {
                    // insert new data
                    $insert_data = $m_formula->insert([
                        'kode_formula' => 'FORMULA1',
                        'item_kode' => $this->request->getPost('item_kode'),
                        'persentase' => $this->request->getPost('presentase')
                    ]);
                    // check
                    if ($insert_data) {
                        return json_encode([
                            'status' => 'success',
                            'message' => 'Berhasil menambahkan formula!',
                            'data' => $insert_data
                        ]);
                    } else {
                        return json_encode([
                            'status' => 'failed',
                            'message' => 'Gagal menambahkan formula!',
                            'data' => []
                        ]);
                    }
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, silahkan isi form dengan benar',
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
     * update formula
     */
    public function update_formula()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            // set validator rules
            $validator->setRules([
                'id_formula' => 'required',
                'kode_formula' => 'required',
                'item_kode' => 'required',
                'presentase' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->require)->run();
            if ($isDataValid) {
                // create model instance
                $m_formula = new Formula();
                // update data
                $update_data = $m_formula->update($this->request->getPost('id_formula'), [
                    'persentase' => $this->request->getPost('persentase'),
                ]);
                // check
                if ($update_data) {
                    return json_encode([
                        'status' => 'success',
                        'message'=> 'Berhasil memperbarui data formula!',
                        'data' => $update_data
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message'=> 'Gagal memperbarui data formula!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message'=> 'Validasi gagal, mohon isi form dengan benar!',
                    'data' => $validator->getErrors()
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
