<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class DiskonController extends BaseController
{
    public function index()
    {
        //
    }

    public function create_diskon()
    {
        try {
            // create validator 
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'nim' => 'required',
                'nominal_diskon' => 'required'
            ]);
        } catch (\Throwable $th) {
            
        }
    }
}
