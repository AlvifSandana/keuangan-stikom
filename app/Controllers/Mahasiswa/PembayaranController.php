<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\ItemPaket;
use App\Models\Semester;
use App\Models\Transaksi;

class PembayaranController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // show view
        return view('pages/keuangan_mahasiswa/pembayaran/index', $data);
    }

    /**
     * show detail keuangan page (by NIM)
     */
    public function detail_keuangan($nim)
    {
        try {
            // create request instance
            $request = \Config\Services::request();
            // create db & bulder instance
            $db = \Config\Database::connect('default');
            $db_old = \Config\Database::connect('default_old');
            $builder_mhs = $db_old->table('tbl_mahasiswa');
            $builder_dosen = $db_old->table('tbl_dosen');
            $builder_tagihan = $db->table('tbl_transaksi');
            $builder_pembayaran = $db->table('tbl_transaksi');
            $m_itempaket = new ItemPaket();
            $m_semester = new Semester();

            // query mahasiswa
            $query_mhs = $builder_mhs
                ->select('*, tbl_dosen_wali_mahasiswa.*, tbl_jurusan.*, tbl_paket.*')
                ->where('tbl_mahasiswa.nim', $nim)
                ->join('tbl_dosen_wali_mahasiswa', 'tbl_mahasiswa.nim = tbl_dosen_wali_mahasiswa.nim', 'inner')
                ->join('tbl_jurusan', 'tbl_mahasiswa.id_jur = tbl_jurusan.id_jur', 'inner')
                ->join('tbl_paket', 'tbl_mahasiswa.id_paket = tbl_paket.id_paket', 'inner')
                ->join('tbl_status', 'tbl_mahasiswa.status = tbl_status.id_sts', 'inner')
                ->get();
            // find data mahasiswa
            $mahasiswa = $query_mhs->getResult('array');

            // query dosen
            $query_dosen = $builder_dosen
                ->select('nama_dosen')
                ->where('kode_dosen', $mahasiswa[0]['kode_dosen'])
                ->get();
            // find data dosen
            $dosen = $query_dosen->getResult('array');

            // query data tagihan
            $query_tagihan = $builder_tagihan
                ->select('tbl_transaksi.*, tbl_item_paket.*, tbl_semester.nama_semester')
                ->where('kode_unit', $nim)
                ->where('kategori_transaksi', 'K')
                ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'inner')
                ->join('tbl_semester', 'tbl_item_paket.semester_id = tbl_semester.id_semester', 'inner')
                ->orderBy('kode_transaksi', 'ASC')
                ->get();
            // find data tagihan
            $tagihan = $query_tagihan->getResultArray();

            // query data pembayaran
            $query_pembayaran = $builder_pembayaran
                ->select('tbl_transaksi.*, tbl_item_paket.*, tbl_semester.nama_semester')
                ->where('kode_unit', $nim)
                ->where('kategori_transaksi', 'D')
                ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'inner')
                ->join('tbl_semester', 'tbl_item_paket.semester_id = tbl_semester.id_semester', 'inner')
                ->orderBy('kode_transaksi', 'ASC')
                ->get();
            // find data pembayaran
            $pembayaran = $query_pembayaran->getResultArray();

            // get item paket by id_paket
            $item_paket = $m_itempaket
                ->where('paket_id', $mahasiswa[0]['id_paket'])
                ->like('angkatan_id', $mahasiswa[0]['angkatan'])
                ->join('tbl_semester', 'semester_id = tbl_semester.id_semester', 'inner')
                ->join('tbl_angkatan', 'angkatan_id = tbl_angkatan.id_angkatan', 'inner')
                ->findAll();

            // get semester 
            $semester = $m_semester->findAll();

            // set data for view
            $data['mahasiswa'] = $mahasiswa;
            $data['dosen'] = $dosen;
            $data['tagihan'] = $tagihan;
            $data['pembayaran'] = $pembayaran;
            $data['item_paket'] = $item_paket;
            $data['semester'] = $semester;
            // get uri segment for dynamic sidebar active item
            $data['uri_segment'] = $request->uri->getSegment(2);
            // show view
            return view('pages/keuangan_mahasiswa/pembayaran/detail_keuangan/index', $data);
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran')->with('error', $th->getMessage());
        }
    }

    /**
     * search mahasiswa by NIM or Nama
     */
    public function search_mahasiswa()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'keyword' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // get search keyword
                $keyword = $this->request->getPost('keyword');
                // create db and builder instance
                $db = \Config\Database::connect('default_old');
                $builder = $db->table('tbl_mahasiswa');
                // get data mahasiswa
                $mahasiswa = $builder
                    ->select('*, tbl_paket.nama_paket as nama_paket, tbl_status.status as status_mhs')
                    ->like('nim', $keyword, 'both')
                    ->orLike('nama_mhs', $keyword, 'both')
                    ->join('tbl_paket', 'tbl_mahasiswa.id_paket = tbl_paket.id_paket')
                    ->join('tbl_status', 'tbl_mahasiswa.status = tbl_status.id_sts')
                    ->get();
                if ($mahasiswa->getResultArray()) {
                    return json_encode([
                        "status" => "success",
                        "message" => sizeof($mahasiswa->getResultArray()) . " data ditemukan.",
                        "data" => $mahasiswa->getResultArray(),
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Data tidak ditemukan!',
                        'data' => [],
                    ]);
                }
            } else {
                // catch validation error
                return json_encode([
                    'status' => 'failed',
                    'message' => $validator->getError('keyword'),
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
     * cari pembayaran mahasiswa by nim
     */
    public function search_pembayaran()
    {
        try {
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'nim' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // get nim from request
                $nim = $this->request->getPost('nim');
                // create db & builder instance
                $db = \Config\Database::connect('default');
                $m_transaksi = new Transaksi($db);
                // get data transaksi (kredit) by nim
                $pembayaran = $m_transaksi->findTransaksi($nim, 'D', 'kode_transaksi', 'ASC');
                if (!is_string($pembayaran)) {
                    return json_encode([
                        'status' => 'success',
                        'message' => sizeof($pembayaran) . ' data ditemukan.',
                        'data' => $pembayaran,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => $pembayaran,
                        'data' => [],
                    ]);
                }
            } else {
                // catch validation error
                return json_encode([
                    'status' => 'failed',
                    'message' => $validator->getError('nim'),
                    'data' => [],
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
     * create pembayaran baru
     */
    public function create_pembayaran()
    {
        try {
            // result
            $result = [];
            // create validator instance
            $validator = \Config\Services::validation();
            $validator->setRules([
                'kode_unit' => 'required',
                'tanggal_transaksi' => 'required',
                'nominal_transaksi' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // get data from request
                $req_data = [
                    'item_kode' => $this->request->getPost('item_kode'),
                    'nama_item' => $this->request->getPost('nama_item'),
                    'kode_unit' => $this->request->getPost('kode_unit'),
                    'kode_metode_pembayaran' => $this->request->getPost('kode_metode_pembayaran'),
                    'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
                    'q_debit' => $this->request->getPost('nominal_transaksi'),
                    'is_bukti_transaksi' => $this->request->getPost('is_bukti_transaksi'),
                ];
                $bukti_transaksi = $this->request->getFile('bukti_transaksi');
                // create model instance
                $m_transaksi = new Transaksi();
                $m_semester = new Semester();
                // get kode transaksi pembayaran mahasiswa
                // where kode_transaksi like '%nim%'
                $kode_transaksi_pembayaran = $m_transaksi->findTransaksi($req_data['kode_unit'], 'D', 'kode_transaksi', 'DESC');
                $split_kode_transaksi_pembayaran = explode('-', $kode_transaksi_pembayaran[0]['kode_transaksi']);
                /**
                 * validating pembayaran:
                 * 
                 * nominal pembayaran > nominal item tagihan ? pembayaran failed : pembayaran success 
                 * nominal pembayaran >= sisa tagihan ? pembayaran failed : pembayaran success
                 */
                // get item tagihan
                $item_tagihan = $m_transaksi
                    ->where('item_kode', $req_data['item_kode'])
                    ->where('kategori_transaksi', 'K')
                    ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'inner')
                    ->find();
                // get semua pembayaran berdasarkan item_kode, 
                $semua_pembayaran_item = $m_transaksi->findTransaksiByItemKode($req_data['kode_unit'], 'D', $req_data['item_kode'], 'kode_transaksi', 'ASC');
                // dd($semua_pembayaran_item);
                // cek item tagihan
                if ($item_tagihan) {
                    // get semester by semester_id
                    $semester = $m_semester->find($item_tagihan[0]['semester_id']);
                    $data_semester = explode(' ', $semester['nama_semester']);
                    // menghitung total tagihan item, 
                    $total_tagihan_item = (int) $item_tagihan[0]['q_kredit'];
                    $total_pembayaran_item = 0;
                    // menghitung total pembayaran item jika record tersedia
                    if ($semua_pembayaran_item != "Data tidak ditemukan!") {
                        foreach ($semua_pembayaran_item as $value) {
                            $total_pembayaran_item += $value['q_debit'];
                        }
                    }
                    // hitung sisa tagihan item
                    $sisa_tagihan_item = $total_tagihan_item - $total_pembayaran_item;
                    //dd($total_tagihan_item, $total_pembayaran_item, $req_data, $sisa_tagihan_item);
                    // proses validasi nominal pembayaran
                    if ($req_data['q_debit'] > $total_tagihan_item || $req_data['q_debit'] > $sisa_tagihan_item) {
                        $result = [
                            "status" => "failed",
                            "message" => "Validasi gagal. Mohon isi nominal pembayaran yang sesuai!",
                            "data" => []
                        ];
                        return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran/detail/' . $this->request->getPost('kode_unit') . '#datamhs')->with('error', 'Data tidak valid, mohon cek kembali nominal pembayaran!');
                    } else {
                        // cek bukti transaksi
                        if ($req_data['is_bukti_transaksi']) {
                            // validate dokumen pembayaran
                            if (!$bukti_transaksi->isValid()) {
                                // throw error 
                                throw new \RuntimeException($bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')');
                                $result = [
                                    'status' => 'error',
                                    'message' => $bukti_transaksi->getErrorString() . '(' . $bukti_transaksi->getError() . ')',
                                    'data' => []
                                ];
                                return redirect()->to(base_url() . '/keaungan-mahasiswa/pembayaran/detail/' . $req_data['kode_unit'] . '#datamhs')->with('error', $result['message']);
                            }
                            // random filename
                            $fn = $req_data['kode_unit'] . '_' . $bukti_transaksi->getRandomName();
                            // move file to public/uploaded/bukti_transaksi
                            $upload_path = $bukti_transaksi->move(ROOTPATH . 'public/uploaded/bukti_transaksi/', $fn);
                            // dd($upload_path, $split_kode_transaksi_pembayaran);
                            // insert transaksi pembayaran
                            $result = [
                                'status' => "success",
                                'message' => 'Berhasil menambahkan pembayaran dari ' . $req_data['kode_unit'],
                                'data' => $m_transaksi->insert([
                                    'kode_transaksi' => 'BY-' . $req_data['kode_unit'] . '-D-' . $data_semester[1] .  '-' . ($split_kode_transaksi_pembayaran[4] + 1),
                                    'kode_unit' => $req_data['kode_unit'],
                                    'kategori_transaksi' => 'D',
                                    'item_kode' => $req_data['item_kode'],
                                    'q_debit' => $req_data['q_debit'],
                                    'kode_metode_pembayaran' => $req_data['kode_metode_pembayaran'],
                                    'bukti_transaksi' => $fn,
                                    'tanggal_transaksi' => $req_data['tanggal_transaksi'],
                                ]),
                            ];
                        } else {
                            // insert transaksi pembayaran
                            $result = [
                                'status' => "success",
                                'message' => 'Berhasil menambahkan pembayaran ' . $req_data['nama_item'] . ' dari ' . $req_data['kode_unit'],
                                'data' => $m_transaksi->insert([
                                    'kode_transaksi' => 'BY-' . $req_data['kode_unit'] . '-D-' . $data_semester[1] . '-' . ($split_kode_transaksi_pembayaran[4] + 1),
                                    'kode_unit' => $req_data['kode_unit'],
                                    'kategori_transaksi' => 'D',
                                    'item_kode' => $req_data['item_kode'],
                                    'q_debit' => $req_data['q_debit'],
                                    'kode_metode_pembayaran' => $req_data['kode_metode_pembayaran'],
                                    'bukti_transaksi' => '',
                                    'tanggal_transaksi' => $req_data['tanggal_transaksi'],
                                ]),
                            ];
                        }
                        // return json_encode($result);
                        return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran/detail/' . $this->request->getPost('kode_unit') . '#datamhs')->with('success', $result['message']);
                    }
                } else {
                    return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran/detail/' . $this->request->getPost('kode_unit') . '#datamhs')->with('error', 'Item tagihan tidak ditemukan!');
                }
            } else {
                return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran/detail/' . $this->request->getPost('kode_unit') . '#datamhs')->with('error', 'Data tidak valid, mohon cek kembali field input data pembayaran!');
            }
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran/detail/' . $this->request->getPost('kode_unit') . '#datamhs')->with('error', $th->getMessage().' - '.$th->getTraceAsString());
        }
    }

    /**
     * Get detail pembayaran item by 
     * kode_unit & item_kode
     * 
     */
    public function get_detail_pembayaran_item(String $kode_unit = '', String $item_kode = '')
    {
        try {
            if ($kode_unit != '' && $item_kode != '') {
                // create model instance
                $m_transaksi = new Transaksi();
                // get data pembayaran
                $pembayaran = $m_transaksi
                    ->where('kode_unit', $kode_unit)
                    ->where('item_kode', $item_kode)
                    ->where('kategori_transaksi', 'D')
                    ->findAll();
                // check result
                if (sizeof($pembayaran) > 0) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data pembayaran tersedia!',
                        'data' => $pembayaran,
                    ]);
                } else {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Data pembayaran kosong!',
                        'data' => [],
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Kode Unit atau Kode Item tidak valid!',
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
}
