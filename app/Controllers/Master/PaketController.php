<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Angkatan;
use App\Models\ItemPaket;
use App\Models\Jalur;
use App\Models\Jurusan;
use App\Models\Paket;
use App\Models\Semester;
use App\Models\SesiKuliah;

class PaketController extends BaseController
{
    public function index()
    {
        // create model instance
        $m_paket = new Paket();
        $m_jurusan = new Jurusan();
        $m_sesi = new SesiKuliah();
        $m_jalur = new Jalur();
        $m_angkatan = new Angkatan();
        $m_semester = new Semester();
        // get data paket, jurusan, sesi, and jalur
        $data['data_paket'] = $m_paket
            ->join('tbl_jurusan', 'jurusan_id = tbl_jurusan.id_jurusan', 'inner')
            ->join('tbl_sesi_kuliah', 'sesi_id = tbl_sesi_kuliah.id_sesi', 'inner')
            ->join('tbl_jalur', 'jalur_id = tbl_jalur.id_jalur', 'inner')
            ->findAll();
        $data['jurusan'] = $m_jurusan->findAll();
        $data['sesi'] = $m_sesi->findAll();
        $data['jalur'] = $m_jalur->findAll();
        $data['angkatan'] = $m_angkatan->findAll();
        $data['semester'] = $m_semester->findAll();
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // show view
        return view('pages/master/keuangan/paket/index', $data);
    }

    /**
     * get item paket by paket_id
     */
    public function get_item_paket(String $paket_id)
    {
        try {
            // create model instance
            $m_itempaket = new ItemPaket();
            // get item paket by paket_id
            if ($paket_id == 'null') {
                $item_paket = $m_itempaket
                ->where('paket_id IS NULL', NULL)
                ->join('tbl_paket', 'paket_id = tbl_paket.id_paket', 'left')
                ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan', 'left')
                ->join('tbl_semester', 'semester_id = tbl_semester.id_semester', 'left')
                ->join('tbl_formula', 'kode_item = tbl_formula.item_kode', 'left')
                ->notLike('nama_item', 'Diskon')
                ->notLike('nama_item', 'diskon')
                ->findAll();
            } else {
                $item_paket = $m_itempaket
                ->where('paket_id', $paket_id)
                ->join('tbl_paket', 'paket_id = tbl_paket.id_paket', 'left')
                ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan', 'left')
                ->join('tbl_semester', 'semester_id = tbl_semester.id_semester', 'left')
                ->join('tbl_formula', 'kode_item = tbl_formula.item_kode', 'left')
                ->findAll();
            }
            // check
            if (sizeOf($item_paket) > 0) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data item paket ditemukan.',
                    'data' => $item_paket,
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data item paket tidak ditemukan.',
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
     * create new paket
     */
    public function create_paket()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'nama_paket' => 'required',
                'jurusan_id' => 'required',
                'sesi_id' => 'required',
                'jalur_id' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_paket = new Paket();
                // get last record from tbl_paket
                $last_record = $m_paket
                    ->orderBy('id_paket', 'DESC')
                    ->findAll();
                // get last id_paket from last record
                $last_id = explode('PKT', $last_record[0]['id_paket']);
                // insert new paket
                $new_paket = $m_paket
                    ->insert([
                        'id_paket' => 'PKT'.(1 + (int)$last_id[1]),
                        'nama_paket' => $this->request->getPost('nama_paket'),
                        'keterangan_paket' => $this->request->getPost('keterangan_paket'),
                        'jurusan_id' => $this->request->getPost('jurusan_id'),
                        'sesi_id' => $this->request->getPost('sesi_id'),
                        'jalur_id' => $this->request->getPost('jalur_id'),
                    ]);
                if ($new_paket) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan paket baru.',
                        'data' => $new_paket,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan paket baru.',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message'=> $validator->getError(),
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

    /**
     * update paket by id_paket
     */
    public function update_paket()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'id_paket' => 'required',
                'nama_paket' => 'required',
                'jurusan_id' => 'required',
                'sesi_id' => 'required',
                'jalur_id' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model instance
                $m_paket = new Paket();
                // insert new paket
                $update_paket = $m_paket
                    ->update( $this->request->getPost('id_paket'), [
                        'nama_paket' => $this->request->getPost('nama_paket'),
                        'keterangan_paket' => $this->request->getPost('keterangan_paket'),
                        'jurusan_id' => $this->request->getPost('jurusan_id'),
                        'sesi_id' => $this->request->getPost('sesi_id'),
                        'jalur_id' => $this->request->getPost('jalur_id'),
                    ]);
                if ($update_paket) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil memperbarui paket.',
                        'data' => $update_paket,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui paket.',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message'=> $validator->getError(),
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

    /**
     * delete paket by id_paket
     */
    public function delete_paket($id)
    {
        try {
            if ($id != null) {
                $m_paket = new Paket();
                // insert data
                $paket = $m_paket->delete($id);
                // check insert result
                if ($paket) {
                    $result['status'] = 'success';
                    $result['message'] = 'Berhasil menghapus data paket dengan ID ' . $id;
                    $result['data'] = $paket;
                    return json_encode($result);
                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'Gagal menghapus data paket dengan ID ' . $id;
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
