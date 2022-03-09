<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Formula;
use App\Models\Mahasiswa;
use App\Models\MasterFormula;
use App\Models\Semester;
use App\Models\Transaksitmp;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class PembayaranVAController extends BaseController
{
    public function index()
    {
        // create request instance & model
        $request = \Config\Services::request();
        $m_temptr = new Transaksitmp();
        $m_formula = new MasterFormula();
        $m_semester = new Semester();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        $data['temp_tr'] = $m_temptr->findAll();
        $data['formula'] = $m_formula->findAll();
        $data['semester'] = $m_semester->findAll();
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
                    // create obj reader & model
                    $reader = new Csv();
                    $m_temptr = new Transaksitmp();
                    $m_mhs = new Mahasiswa();
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
                    // iterate rows in active sheet
                    foreach ($active_sheet as $idx => $data) {
                        // skip first row
                        if ($idx == 1 || $data['A'] == null) {
                            continue;
                        }
                        // fix datetime format
                        $split_date = explode('/', $data['T']);
                        $fixed_date = $split_date[1].'/'.$split_date[0].'/'.$split_date[2];
                        // get nim by nama mhs
                        $mhs = $m_mhs->like('nama_mhs', $data['K'])->first();
                        if ($mhs) {
                            // insert data into tbl_temp_transaksi
                            $insert_data = $m_temptr->insert([
                                'kode_temp_transaksi' => 'BY-' . $mhs['nim'] . '-D-0-' . $idx,
                                'kode_unit' => $mhs['nim'],
                                'kategori_transaksi' => 'D',
                                'q_debit' => floatval(str_replace(',', '',$data['P'])),
                                'tanggal_transaksi' => date("Y-m-d h:i:s", strtotime($fixed_date)),
                            ]);
                        }
                    }
                    return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('success', 'Berhasil upload file VA!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/keuangan-mahasiswa/pembayaran-va')->with('error', $th->getMessage() . '\n' . $th->getTraceAsString());
        }
    }
}
