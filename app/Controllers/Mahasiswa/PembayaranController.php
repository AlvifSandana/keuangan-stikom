<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
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
                ->where('kode_unit' , $nim)
                ->where('kategori_transaksi' , 'K')
                ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'inner')
                ->get();
            // find data tagihan
            $tagihan = $query_tagihan->getResultArray();

            // query data pembayaran
            $query_pembayaran = $builder_pembayaran
            ->where('kode_unit' , $nim)
            ->where('kategori_transaksi' , 'D')
            ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'inner')
            ->get();
            // find data pembayaran
            $pembayaran = $query_pembayaran->getResultArray();
            
            // set data for view
            $data['mahasiswa'] = $mahasiswa;
            $data['dosen'] = $dosen;
            $data['tagihan'] = $tagihan;
            $data['pembayaran'] = $pembayaran;
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
                $pembayaran = $m_transaksi->findTransaksi($nim, 'debit');
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
}
