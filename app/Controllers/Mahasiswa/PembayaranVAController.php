<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Formula;
use App\Models\ItemPaket;
use App\Models\Mahasiswa;
use App\Models\MasterFormula;
use App\Models\Semester;
use App\Models\Transaksi;
use App\Models\Transaksitmp;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class PembayaranVAController extends BaseController
{
    public function index()
    {
        // create request instance & model
        $request = \Config\Services::request();
        $m_temptr = new Transaksitmp();
        $m_formula = new MasterFormula();
        $m_semester = new Semester();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        $data['temp_tr'] = $m_temptr->findAll();
        $data['formula'] = $m_formula->findAll();
        $data['semester'] = $m_semester->findAll();
        // show view
        return view('pages/keuangan_mahasiswa/pembayaran-va/index', $data);
    }

    /**
     * Upload VA file
     */
    public function upload_va()
    {
        try {
            // get file from POST requst
            $file = $this->request->getFile('file_va');
            // validate uploaded file
            if (!$file->isValid()) {
                // throw error 
                throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
                return redirect()
                    ->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')
                    ->with('error', $file->getErrorString() . '(' . $file->getError() . ')');
            } else {
                // random filename
                $fn = $file->getRandomName();
                // move file to uploaded folder
                $path = $file->move(WRITEPATH . 'uploads/va/', $fn);
                // dd($file, $fn, $path);
                // create reader
                if ($file->getClientExtension() == 'xls') {
                    // create obj reader
                    $reader = new Xls();
                    // load file xlsx
                    $spreadsheet = $reader->load(WRITEPATH . 'uploads/va/' . $fn);
                    // get active sheet
                    $active_sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                } else {
                    // create obj reader & model
                    $reader = new Csv();
                    $m_temptr = new Transaksitmp();
                    $m_mhs = new Mahasiswa();
                    // config for CSV
                    $reader->setInputEncoding('CP1252');
                    // set delimiter
                    $reader->setDelimiter(';');
                    // set enclosure
                    $reader->setEnclosure('');
                    // set default sheet index
                    $reader->setSheetIndex(0);
                    // load file CSV
                    $spreadsheet = $reader->load(WRITEPATH . 'uploads/va/' . $fn);
                    // get active sheet
                    $active_sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                    // iterate rows in active sheet
                    foreach ($active_sheet as $idx => $data) {
                        // skip first row
                        if ($idx == 1 || $data['A'] == null) {
                            continue;
                        }
                        // fix datetime format
                        $split_date = explode('/', $data['T']);
                        $fixed_date = $split_date[1] . '/' . $split_date[0] . '/' . $split_date[2];
                        // get nim by nama mhs
                        $mhs = $m_mhs->like('nama_mhs', $data['K'])->first();
                        if ($mhs) {
                            // insert data into tbl_temp_transaksi
                            $insert_data = $m_temptr->insert([
                                'kode_temp_transaksi' => 'BY-' . $mhs['nim'] . '-D-0-' . $idx,
                                'kode_unit' => $mhs['nim'],
                                'kategori_transaksi' => 'D',
                                'q_debit' => floatval(str_replace(',', '', $data['P'])),
                                'tanggal_transaksi' => date("Y-m-d h:i:s", strtotime($fixed_date)),
                            ]);
                        }
                    }
                    return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('success', 'Berhasil upload file VA!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('error', $th->getMessage() . '\n' . $th->getTraceAsString());
        }
    }

    public function acc_va()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'id_tmp_tr' => 'required',
                'id_mf' => 'required',
                'q_debit' => 'required',
                'nim' => 'required',
                'smts' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                $item_tagihan_wajib = [];
                $item_tagihan_baru = [];
                // get data from post
                $nim = $this->request->getPost('nim');
                $id_mf = $this->request->getPost('id_mf');
                $id_temp_tr = $this->request->getPost('id_tmp_tr');
                $nom_tmp_tr = (int)$this->request->getPost('q_debit');
                $semester = $this->request->getPost('smts');
                // create models
                $m_transaksi = new Transaksi();
                $m_temptr = new Transaksitmp();
                $m_mformula = new MasterFormula();
                // check total tagihan by NIM
                $total_tagihan = $m_transaksi->getTotalTransaksiMhs($this->request->getPost('nim'), 'K');
                // get all tagihan by NIM
                $all_tagihan = $m_transaksi->findTransaksi($this->request->getPost('nim'), 'K', 'id_transaksi', 'ASC');
                // validate all tagihan & total tagihan
                if (!is_string($total_tagihan) && !is_string($all_tagihan)) {
                    // split item tagihan (TW & TB) 
                    
                    // get value of master formula
                    $master_formula = $m_mformula->getByKodeMFormula($this->request->getPost('id_mf'));
                    // set ratio TW & TB
                    $TW = (int)$master_formula[0]['persentase_tw'] / 100;
                    $TB = (int)$master_formula[0]['persentase_tb'] / 100;
                    // set nominal TW & TB
                    $nom_TW = $nom_tmp_tr * $TW;
                    $nom_TB = $nom_tmp_tr * $TB;
                    // check keuangan mhs
                    $keuangan_mhs = $m_transaksi->getInfoKeuanganMhs($nim);
                    $total_tagihan = $keuangan_mhs[0]['total_tagihan'] == null ? 0 : (int)$keuangan_mhs[0]['total_tagihan'];
                    $total_pembayaran = $keuangan_mhs[0]['total_pembayaran'] == null ? 0 : (int)$keuangan_mhs[0]['total_pembayaran'];
                    $sisa_tagihan = $keuangan_mhs[0]['sisa_tagihan'] == null ? $total_tagihan - $total_pembayaran : (int)$keuangan_mhs[0]['sisa_tagihan'];
                    // do insert new pembayaran
                    dd($TW, $TB, $nom_TW, $nom_TB, $semester, $total_tagihan, $total_pembayaran, $sisa_tagihan, $item_tagihan_wajib, $item_tagihan_baru);
                    // insert new transaksi (pembayaran) by NIM
                    // check
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Data Keuangan tidak ditemukan! Mohon cek data.',
                        'data' => []
                    ]);
                }
                // dd($this->request->getPost('id_tmp_tr'),$this->request->getPost('id_mf'),$this->request->getPost('smts'),$this->request->getPost('nim'), $total_tagihan);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal! Mohon pilih minimal 1 semester.',
                    'data' => []
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => []
            ]);
        }
    }

    /**
     * update temp transaksi VA
     */
    public function update_temp_va($id_temp_transaksi)
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'q_debit' => 'required',
                'tanggal_transaksi' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_temptr = new Transaksitmp();
                // update data
                $update_data = $m_temptr->update($id_temp_transaksi, [
                    'q_debit' => $this->request->getPost('q_debit'),
                    'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
                ]);
                // check
                if ($update_data) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil diperbarui!',
                        'data' => [],
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal memperbarui data!',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal, data invalid!',
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
     * delete temp transaksi va
     */
    public function delete_temp_va($id_temp_transaksi)
    {
        try {
            // create model
            $m_temptr = new Transaksitmp();
            // delete temp va
            $delete_data = $m_temptr->delete($id_temp_transaksi);
            // check
            if ($delete_data) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Berhasil menghapus data!',
                    'data' => []
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal menghapus data!',
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
     * reset temp transaksi va
     */
    public function reset_temp_va()
    {
        try {
            // create db builder
            $db = \Config\Database::connect('default');
            $builder_temptr = $db->table('tbl_temp_transaksi');
            // delete ALL temp va
            $delete_all = $builder_temptr->emptyTable();
            // check
            if ($delete_all) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Berhasil reset tabel data!',
                    'data' => []
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Gagal reset tabel data!',
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
}
