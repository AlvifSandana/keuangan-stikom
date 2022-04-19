<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Angkatan;
use App\Models\AppSettings;

class AppSettingsController extends BaseController
{
    public function index()
    {
        $m_set = new AppSettings();
        $m_ang = new Angkatan();
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // get settings data
        $data['settings'] = $m_set->findAll();
        $data['angkatan'] = $m_ang->findAll();
        // view
        return view('pages/settings/app/index', $data);
    }

    public function apply_changes()
    {
        
        try {
            // create validator
            $validator = \Config\Services::validation();
            // set rules
            $validator->setRules([
                'id_setting' => 'required',
                'value' => 'required'
            ]);
            // begin validation
            $isDataValid = $validator->withRequest($this->request)->run();
            if($isDataValid){
                // create model
                $m_set = new AppSettings();
                // update data
                $update_setting = $m_set->update($this->request->getPost('id_setting'), [
                    'value' => $this->request->getPost('value')
                ]);
                if ($update_setting) {
                    return json_encode([
                        'status' => 'success',
                        'message' => 'Apply setting successfully!',
                        'data' => []
                    ]);
                } else {
                    return json_encode([
                        'status' => 'failed',
                        'message' => 'Failed to apply settng!',
                        'data' => []
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Failed to validate data setting!',
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
