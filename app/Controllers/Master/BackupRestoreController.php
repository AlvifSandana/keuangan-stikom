<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class BackupRestoreController extends BaseController
{
    public function index()
    {
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(1);
        // return view
        return view('pages/master/backuprestore/index', $data);
    }

    /**
     * Backup database
     */
    public function backup()
    {
        try {
            // check OS
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $filename = date('d-m-Y-H-i-s') . '-db_keuangan.sql';
                $command = 'C:/xampp/mysql/bin/mysqldump --user=' . env('database.default.username') . ' --password=' . env('database.default.password') . ' ' . env('database.default.database') . ' > ' . ROOTPATH . '/public/backupdb/' . $filename;
                system($command);
                return redirect()->to(base_url() . '/backup-restore')->with('success', 'Backup database berhasil! <a class="float-right" href="' . base_url() . '/public/backupdb/' . $filename . '"><i class="fas fa-download"></i> Download</a>');
            } else if (system('[ -f /.dockerenv ] && echo "DOCKER"') === 'DOCKER') {
                $filename = date('d-m-Y-H-i-s') . '-db_keuangan.sql';
                $command = 'mysqldump --column-statistics=0 --host='.env('database.default.hostname').' --user='.env('database.default.username'). ' --password=' . env('database.default.password') . ' ' . env('database.default.database') . ' > ' . ROOTPATH . '/public/backupdb/' . $filename;
                system($command);
                return redirect()->to(base_url() . '/backup-restore')->with('success', 'Backup database berhasil! <a class="float-right" href="' . base_url() . '/public/backupdb/' . $filename . '"><i class="fas fa-download"></i> Download</a>');
            } else {
                $filename = date('d-m-Y-H-i-s') . '-db_keuangan.sql';
                $command = 'mysqldump --user=' . env('database.default.username') . ' --password=' . env('database.default.password') . ' ' . env('database.default.database') . ' > ' . ROOTPATH . '/public/backupdb/' . $filename;
                system($command);
                return redirect()->to(base_url() . '/backup-restore')->with('success', 'Backup database berhasil! <a class="float-right" href="' . base_url() . '/public/backupdb/' . $filename . '"><i class="fas fa-download"></i> Download</a>');
            }
            $filename = date('d-m-Y-H-i-s') . '-db_keuangan.sql';
            $command = 'mysqldump --user=' . env('database.default.username') . ' --password=' . env('database.default.password') . ' ' . env('database.default.database') . ' > ' . ROOTPATH . '/public/backupdb/' . $filename;
            system($command);
            return redirect()->to(base_url() . '/backup-restore')->with('success', 'Backup database berhasil! <a class="float-right" href="' . base_url() . '/public/backupdb/' . $filename . '"><i class="fas fa-download"></i> Download</a>');
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/backup-restore')->with('error', $th->getMessage());
        }
    }

    /**
     * Restore database from .sql file given
     *
     */
    public function restore()
    {
        try {
            // get file from POST requst
            $file = $this->request->getFile('file_restore');
            // validate uploaded file
            if (!$file->isValid()) {
                // throw error 
                throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
                return redirect()->to(base_url() . '/master-mahasiswa')
                    ->with('error', $file->getErrorString() . '(' . $file->getError() . ')');
            } else {
                // random filename
                $fn = $file->getRandomName();
                // move file to uploaded folder
                $path = $file->store('restore/', $fn);
                // config for db connection 
                $config = [
                    'DSN'      => '',
                    'hostname' => env('database.default.hostname', 'localhost'),
                    'username' => env('database.default.username', 'root'),
                    'password' => env('database.default.password', ''),
                    'database' => env('database.default.database', 'db_keuangan_test'),
                    'DBDriver' => 'MySQLi',
                    'DBPrefix' => '',
                    'pConnect' => false,
                    'DBDebug'  => (ENVIRONMENT !== 'production'),
                    'charset'  => 'utf8',
                    'DBCollat' => 'utf8_general_ci',
                    'swapPre'  => '',
                    'encrypt'  => false,
                    'compress' => false,
                    'strictOn' => false,
                    'failover' => [],
                    'port'     => 3306,
                ];
                // connect to db
                $db = db_connect($config);
                // temporary line
                $tmp_line = '';
                $error = '';
                // get query lines from file
                $lines = file(WRITEPATH . 'uploads/' . $path);
                // loop each line
                foreach ($lines as $line) {
                    // Skip it if it's a comment
                    if (substr($line, 0, 2) == '--' || $line == '') {
                        continue;
                    }
                    // Add this line to the current segment
                    $tmp_line .= $line;
                    // If it has a semicolon at the end, it's the end of the query
                    if (substr(trim($line), -1, 1) == ';') {
                        // Perform the query
                        if (!$db->query($tmp_line)) {
                            $error .= 'Error performing query "<b>' . $tmp_line . '</b>": ' . $db->error() . '<br /><br />';
                        }
                        // Reset temp variable to empty
                        $tmp_line = '';
                    }
                }
                if (!empty($error)) {
                    return redirect()->to(base_url() . '/backup-restore')->with('error', $error);
                } else {
                    return redirect()->to(base_url() . '/backup-restore')->with('success', 'Restore database berhasil!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->to(base_url() . '/backup-restore')->with('error', $th->getMessage());
        }
    }
}
