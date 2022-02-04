<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Formula;

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
}
