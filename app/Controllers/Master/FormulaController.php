<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Angkatan;
use App\Models\Formula;
use App\Models\ItemPaket;
use App\Models\Paket;
use App\Models\Semester;
use PhpParser\Node\Stmt\TryCatch;

class FormulaController extends BaseController
{
    public function index()
    {
        // create request and model instance
        $request = \Config\Services::request();
        $m_paket = new Paket();
        $m_semester = new Semester();
        $m_angkatan = new Angkatan();
        $m_item = new ItemPaket();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // get data paket, semester, formula
        $data['paket'] = $m_paket->findAll();
        $data['semester'] = $m_semester->findAll();
        $data['angkatan'] = $m_angkatan->findAll();
        $data['formula'] = $m_item
            ->join('tbl_formula', 'kode_item = tbl_formula.item_kode', 'left')
            ->join('tbl_paket', 'paket_id = tbl_paket.id_paket', 'left')
            ->join('tbl_semester', 'semester_id = tbl_semester.id_semester', 'left')
            ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan', 'left')
            ->findAll();
        // get data akun pemasukan
        return view('pages/master/keuangan/formula/index', $data);
    }

    /**
     * get item paket + formula by id_item
     */
    public function get_item_formula_by_filter()
    {
        try {
            // get filter from request data
            $paket_id = $this->request->getPost('paket_id');
            $semester_id = $this->request->getPost('semester_id');
            $angkatan_id = $this->request->getPost('angkatan_id');
            // create model
            $m_item = new ItemPaket();
            // get data
            $item = $m_item
                ->where('paket_id', $paket_id)
                ->where('semester_id', $semester_id)
                ->where('angkatan_id', $angkatan_id)
                ->join('tbl_formula', 'kode_item = tbl_formula.item_kode', 'left')
                ->findAll();
            // check
            if ($item) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data available!',
                    'data' => $item
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data unavailable!',
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
     * get item paket + formula by id_item
     */
    public function get_item_formula_by_id_item($id_item)
    {
        try {
            // create model
            $m_item = new ItemPaket();
            // get data
            $item = $m_item
                ->where('id_item', $id_item)
                ->join('tbl_formula', 'kode_item = tbl_formula.item_kode', 'left')
                ->findAll();
            // check
            if ($item) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data available!',
                    'data' => $item
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data unavailable!',
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
                        'id_formula' => ((int)$prev_formula[0]['id_formula'] + 1),
                        'kode_formula' => 'FORMULA' . ((int)$prev_kode_formula[1] + 1),
                        'item_kode' => $this->request->getPost('item_kode'),
                        'persentase' => $this->request->getPost('persentase')
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
                        'id_formula' => 1,
                        'kode_formula' => 'FORMULA1',
                        'item_kode' => $this->request->getPost('item_kode'),
                        'persentase' => $this->request->getPost('persentase')
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
                'kode_formula' => 'required',
                'item_kode' => 'required',
                'persentase' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_formula = new Formula();
                // update data
                $update_data = $m_formula->update($this->request->getPost('kode_formula'), [
                    'persentase' => $this->request->getPost('persentase'),
                ]);
                // check
                if ($update_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil memperbarui data formula!',
                        'data' => $update_data
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui data formula!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, mohon isi form dengan benar!',
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

    public function delete_formula()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'id_formula' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
            } else {
            }
        } catch (\Throwable $th) {
        }
    }
}
