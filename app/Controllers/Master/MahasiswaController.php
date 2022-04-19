<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AppSettings;
use App\Models\Mahasiswa;

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
        $settings = $m_set->where('nama_setting', 'Batas Show Data MHS (angkatan)')->first();
        $data['data_mahasiswa'] = $settings != null ? $m_mahasiswa->where('status', '0')->where('angkatan >=', $settings['value'])->findAll() : $m_mahasiswa->where('status', '0')->findAll();
        // show view
        return view('pages/master/mahasiswa/index', $data);
    }
}
