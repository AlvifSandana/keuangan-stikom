<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Angkatan;
use App\Models\Jalur;
use App\Models\Jurusan;
use App\Models\Paket;
use App\Models\Semester;
use App\Models\SesiKuliah;

class PendukungController extends BaseController
{
    public function index()
    {
        // create model instance
        $m_angkatan = new Angkatan();
        $m_semester = new Semester();
        $m_jurusan = new Jurusan();
        $m_jalur = new Jalur();
        $m_sesikuliah = new SesiKuliah();
        $m_paket = new Paket();
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // get data
        $data['angkatan'] = $m_angkatan->orderBy('id_angkatan', 'ASC')->findAll();
        $data['semester'] = $m_semester->orderBy('id_semester', 'ASC')->findAll();
        $data['jurusan'] = $m_jurusan->orderBy('id_jurusan', 'ASC')->findAll();
        $data['jalur'] = $m_jalur->orderBy('id_jalur', 'ASC')->findAll();
        $data['paket'] = $m_paket->orderBy('id_paket', 'ASC')->findAll();
        $data['sesi_kuliah'] = $m_sesikuliah->orderBy('id_sesi', 'ASC')->findAll();
        // return view
        return view('pages/master/datapendukung/index', $data);
    }
}
