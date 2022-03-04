<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

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
                // random filename
                $fn = $file->getRandomName();
                // move file to uploaded folder
                $path = $file->move(WRITEPATH . 'uploads/va/', $fn);
                // dd($file, $fn, $path);
                // create reader
                if ($file->getClientExtension() == 'xls') {
                    // create obj reader
                    $reader = new Xls();
                    // load file xlsx
                    $spreadsheet = $reader->load(WRITEPATH . 'uploads/va/' . $fn);
                    // get active sheet
                    $active_sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                } else {
                    // create obj reader
                    $reader = new Csv();
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
                }
                dd($active_sheet);
            }
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('error', $th->getMessage() . '\n' . $th->getTraceAsString());
        }
    }
}
