<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class PembayaranVAController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
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
                if (!$file->hasMoved()) {
                    // random filename
                    $fn = $file->getRandomName();
                    // move file to uploaded folder
                    $path = $file->store('va/', $fn);
                    // create reader
                    if ($file->getClientExtension() == 'xls') {
                        $reader = new Xls();
                    } else {
                        $reader = new Xlsx();
                    }
                    // read file
                    $spreadsheet = $reader->load(WRITEPATH . 'uploads/' . $path);
                    
                } else {
                    return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('error', 'File has been moved!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('error', $th->getMessage());
        }
    }
}
