<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Angkatan;
use App\Models\AppSettings;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Paket;

class MahasiswaController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // create model instance
        $m_mahasiswa = new Mahasiswa();
        $m_set = new AppSettings();
        $m_ang = new Angkatan();
        $m_jur = new Jurusan();
        $m_pkt = new Paket();
        $settings = $m_set->where('nama_setting', 'Batas Show Data MHS (angkatan)')->first();
        $data['data_mahasiswa'] = $settings != null ? $m_mahasiswa->where('status', '0')->where('angkatan >=', $settings['value'])->findAll() : $m_mahasiswa->where('status', '0')->findAll();
        $data['settings'] = $m_set->findAll();
        $data['angkatan'] = $m_ang->findAll();
        $data['jurusan'] = $m_jur->findAll();
        $data['paket'] = $m_pkt->findAll();
        // show view
        return view('pages/master/mahasiswa/index', $data);
    }

    /** 
     * create new data mahasiswa
     */
    public function create_mahasiswa()
    {
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set validation rules
            $validator->setRules([
                'nim' => 'required',
                'nama_mahasiswa' => 'required',
                'angkatan_id' => 'required',
                'jurusan_id' => 'required',
                'paket_tagihan' => 'required',
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if ($isDataValid) {
                // create model
                $m_mhs = new Mahasiswa();
                // insert data mahasiswa
                $insert_mhs = $m_mhs->insert([
                    'nim' => $this->request->getPost('nim'),
                    'nama_mhs' => $this->request->getPost('nama_mahasiswa'),
                    'angkatan' => $this->request->getPost('angkatan_id'),
                    'id_jur' => $this->request->getPost('jurusan_id'),
                    'id_paket' => $this->request->getPost('paket_tagihan'),
                    'status' => 0,
                    'nm_ayah' => '-',
                    'nama_ibu' => '-',
                    'no_ktp' => '-',
                    'ktp' => '-',
                    'id_maba' => 0,
                ]);
                // check
                if ($insert_mhs) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan data mahasiswa baru!',
                        'data' => []
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Gagal menambahkan data mahasiswa!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Validasi gagal! Mohon isi field dengan benar.',
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
