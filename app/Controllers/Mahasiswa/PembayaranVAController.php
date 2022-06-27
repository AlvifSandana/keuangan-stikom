<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Mahasiswa;
use App\Models\MasterFormula;
use App\Models\MetodePembayaran;
use App\Models\Semester;
use App\Models\Transaksi;
use App\Models\Transaksitmp;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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
        $data['temp_tr'] = $m_temptr->findAllTransaksiTempWithItemTagihanStatus();
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
                if ($file->getClientExtension() == 'xlsx') {
                    // create obj reader
                    $reader = new Xlsx();
                    $m_temptr = new Transaksitmp();
                    $m_mhs = new Mahasiswa();
                    // load file xlsx
                    $spreadsheet = $reader->load(WRITEPATH . 'uploads/va/' . $fn);
                    // get active sheet
                    $active_sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                    // iterate rows in active sheet
                    // dd($active_sheet);
                    foreach ($active_sheet as $idx => $data) {
                        // skip first row
                        if ($idx == 1 || $data['A'] == null) {
                            continue;
                        }
                        // skip TXN AMOUNT = 0
                        if ($data['G'] == 0) {
                            continue;
                        }
                        // get nim by nama mhs
                        $mhs = $m_mhs->like('nama_mhs', $data['K'])->first();
                        if ($mhs) {
                            // insert data into tbl_temp_transaksi
                            $insert_data = $m_temptr->insert([
                                'kode_temp_transaksi' => 'BY-' . $mhs['nim'] . '-D-0-' . $idx,
                                'kode_bayar' => $data['J'],
                                'kode_unit' => $mhs['nim'],
                                'kategori_transaksi' => 'D',
                                'metode_pembayaran' => $data['W'],
                                'q_debit' => floatval(str_replace(',', '', $data['G'])),
                                'tanggal_transaksi' => date("Y-m-d h:i:s", strtotime($data['T'])),
                            ]);
                        }
                    }
                    return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('success', 'Berhasil upload file VA!');
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
                        // skip TXN AMOUNT = 0
                        if ($data['G'] == 0) {
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
                                'kode_bayar' => $data['J'],
                                'kode_unit' => $mhs['nim'],
                                'kategori_transaksi' => 'D',
                                'metode_pembayaran' => $data['W'],
                                'q_debit' => floatval(str_replace(',', '', $data['G'])),
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
                'q_debit' => 'required',
                'mp' => 'required',
                'nim' => 'required',
                'item_tagihan' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // get data from post
                $nim = $this->request->getPost('nim');
                $id_temp_tr = $this->request->getPost('id_tmp_tr');
                $nom_tmp_tr = (int)$this->request->getPost('q_debit');
                $item_tagihan = $this->request->getPost('item_tagihan');
                // create model
                $m_transaksi = new Transaksi();
                $m_temptr = new Transaksitmp();
                $m_mp = new MetodePembayaran();
                // count selected item_tagihan
                $n_item = count($item_tagihan);
                // when n_item > 1 , divide nominal va by n_item
                if ($n_item == 1) {
                    // check nominal tagihan by item
                    $check_item_tagihan = $m_transaksi->findTransaksiByItemKode($nim, 'K', $item_tagihan[0], 'id_transaksi', 'ASC');
                    $nom_tagihan = !is_string($check_item_tagihan) ? (int)$check_item_tagihan[0]['q_kredit'] : 0;
                    $semester = !is_string($check_item_tagihan) ? explode('SMT', $check_item_tagihan[0]['semester_id']) : 1;
                    // check nominal temp transaksi - nominal item tagihan
                    if (($nom_tagihan - $nom_tmp_tr) >= 0) {
                        // get last kode transaksi pembayaran
                        $last_pembayaran = $m_transaksi->findTransaksi($nim, 'D', 'id_transaksi', 'DESC', '', '');
                        $kode_pembayaran = !is_string($last_pembayaran) ? explode('-', $last_pembayaran[0]['kode_transaksi']) : array('BY', $nim, 'K', 1, 1);
                        // get metode pembayaran
                        $mp = $m_mp->like('nama_metode_pembayaran', $this->request->getPost('mp'))->first();
                        $metode_pembayaran = $mp != null ? $mp['id_metode'] : '07VA';
                        // create pembayaran
                        $new_pembayaran = $m_transaksi->insert([
                            'kode_transaksi' => 'BY-' . $nim . '-D-' . (int)$semester[1] . '-' . ((int)$kode_pembayaran[4] + 1),
                            'kode_unit' => $nim,
                            'kategori_transaksi' => 'D',
                            'kode_metode_pembayaran' => $metode_pembayaran,
                            'tanggal_transaksi' => $this->request->getPost('tgl'),
                            'item_kode' => $item_tagihan[0],
                            'q_debit' => $nom_tmp_tr,
                        ]);
                        // check
                        if ($new_pembayaran) {
                            // delete selectad temp_transaksi
                            $delete_temp_tr = $m_temptr->delete($id_temp_tr);
                            if ($delete_temp_tr) {
                                return json_encode([
                                    'status' => 'success',
                                    'message' => 'Berhasil ACC!',
                                    'data' => []
                                ]);
                            } else {
                                return json_encode([
                                    'status' => 'failed',
                                    'message' => 'Gagal ACC!',
                                    'data' => []
                                ]);
                            }
                        } else {
                            return json_encode([
                                'status' => 'failed',
                                'message' => 'Gagal ACC!',
                                'data' => []
                            ]);
                        }
                    }
                } else if ($n_item > 1) {
                    // divide nominal temp transaksi by n_item
                    $nom_va = $nom_tmp_tr / $n_item;
                    // iterate item tagihan
                    for ($i = 0; $i < $n_item; $i++) {
                        // check nominal tagihan by item
                        $check_item_tagihan = $m_transaksi->findTransaksiByItemKode($nim, 'K', $item_tagihan[$i], 'id_transaksi', 'ASC');
                        $nom_tagihan = !is_string($check_item_tagihan) ? (int)$check_item_tagihan[0]['q_kredit'] : 0;
                        $semester = !is_string($check_item_tagihan) ? explode('SMT', $check_item_tagihan[0]['semester_id']) : 1;
                        // get metode pembayaran
                        $mp = $m_mp->like('nama_metode_pembayaran', $this->request->getPost('mp'))->first();
                        $metode_pembayaran = $mp != null ? $mp['id_metode'] : '07VA';
                        // check nominal va - nominal item tagihan
                        if (($nom_tagihan - $nom_va) >= 0) {
                            // get last kode transaksi pembayaran
                            $last_pembayaran = $m_transaksi->findTransaksi($nim, 'D', 'id_transaksi', 'DESC', '', '');
                            $kode_pembayaran = !is_string($last_pembayaran) ? explode('-', $last_pembayaran[0]['kode_transaksi']) : array('BY', $nim, 'D', 1, 0);
                            // dd($nom_tagihan, $semester, $kode_pembayaran);
                            // create pembayaran
                            $new_pembayaran = $m_transaksi->insert([
                                'kode_transaksi' => 'BY-' . $nim . '-D-' . (int)$semester[1] . '-' . ((int)$kode_pembayaran[4] + 1),
                                'kode_unit' => $nim,
                                'kategori_transaksi' => 'D',
                                'kode_metode_pembayaran' => $metode_pembayaran,
                                'tanggal_transaksi' => $this->request->getPost('tgl'),
                                'item_kode' => $item_tagihan[$i],
                                'q_debit' => $nom_va,
                            ]);
                            // check
                            if (!$new_pembayaran) {
                                return json_encode([
                                    'status' => 'failed',
                                    'message' => 'Gagal Acc!',
                                    'data' => []
                                ]);
                            }
                        } else {
                            
                        }
                    }
                    // delete selectad temp_transaksi
                    $delete_temp_tr = true; #$m_temptr->delete($id_temp_tr);
                    if ($delete_temp_tr) {
                        return json_encode([
                            'status' => 'success',
                            'message' => 'Berhasil ACC!',
                            'data' => []
                        ]);
                    } else {
                        return json_encode([
                            'status' => 'failed',
                            'message' => 'Gagal ACC!',
                            'data' => []
                        ]);
                    }
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal! Mohon pilih minimal 1 item tagihan.',
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

    public function get_data_temp_transaksi()
    {
        try {
            $m_ttr = new Transaksitmp();
            $tr = $m_ttr->findAllTransaksiTempWithItemTagihanStatus();
            if (count($tr) > 0 || !is_string($tr)) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data available',
                    'data' => $tr
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data unavailable!',
                    'data' => []
                ]);
            }
            return json_encode($tr);
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace()
            ]);
        }
    }
}
