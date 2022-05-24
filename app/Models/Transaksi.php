<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = ['kode_transaksi', 'kode_unit', 'kategori_transaksi', 'item_kode', 'q_debit', 'q_kredit', 'kode_metode_pembayaran', 'bukti_transaksi', 'tanggal_transaksi', 'keterangan_transaksi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get data transaksi by kode_unit & kategori transaksi.
     */
    public function findTransaksi(String $kode_unit, String $kategori_transaksi, String $orderBy, String $direction, String $from, String $to)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // check kode_unit
            if ($kode_unit == 'MHS') {
                // set query
                $query = $this->builder()
                    ->join('tbl_item_paket', 'tbl_transaksi.item_kode = tbl_item_paket.kode_item', 'left')
                    ->like('kategori_transaksi', $kategori_transaksi, 'both', true)
                    ->where("tbl_transaksi.created_at BETWEEN '$from' AND '$to'", null)
                    ->orderBy($orderBy, $direction)
                    ->get();
            } else if ($kode_unit == 'LAIN') {
                // set query
                $query = $this->builder()
                    ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'left')
                    ->like('kategori_transaksi', $kategori_transaksi, 'both', true)
                    ->where("tbl_transaksi.created_at BETWEEN '$from' AND '$to'", null)
                    ->notLike('kode_transaksi', 'BY-')
                    ->orderBy($orderBy, $direction)
                    ->get();
            } else if ($kode_unit == 'PENGELUARAN') {
                $query = $this->builder()
                    ->like('kategori_transaksi', $kategori_transaksi, 'both', true)
                    ->where("tbl_transaksi.created_at BETWEEN '$from' AND '$to'", null)
                    ->notLike('kode_transaksi', 'BY-')
                    ->orderBy($orderBy, $direction)
                    ->get();
            } else if ($kode_unit == 'PENGELUARAN_ALL') {
                $query = $this->builder()
                    ->like('kategori_transaksi', $kategori_transaksi, 'both', true)
                    ->where("tbl_transaksi.created_at BETWEEN '$from' AND '$to'", null)
                    ->orderBy($orderBy, $direction)
                    ->get();
            } else if ($kode_unit == 'PEMASUKAN_ALL') {
                $query = $this->builder()
                    ->like('kategori_transaksi', $kategori_transaksi, 'both', true)
                    ->where("tbl_transaksi.created_at BETWEEN '$from' AND '$to'", null)
                    ->orderBy($orderBy, $direction)
                    ->get();
            }else {
                // set query
                $query = $this->builder()
                    ->like('kode_unit', $kode_unit, 'both')
                    ->like('kategori_transaksi', $kategori_transaksi)
                    ->join('tbl_item_paket', "tbl_transaksi.item_kode = tbl_item_paket.kode_item", 'left')
                    ->join('tbl_formula', "tbl_transaksi.item_kode = tbl_formula.item_kode", 'left')
                    ->orderBy($orderBy, $direction)
                    ->get();
            }
            // check query, when query success with data, 
            // set to result
            // dd($query->getResultArray());
            if (count($query->getResultArray()) > 0) {
                $result = $query->getResultArray();
            }
            // $result = $query->getResultArray();
            return $result;
            // return $query->getResultArray();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get data transaksi by kode_unit, kategori transaksi, dan item_kode.
     */
    public function findTransaksiByItemKode(String $kode_unit, String $kategori_transaksi, String $item_kode, String $orderBy, String $direction)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
                ->where('tbl_transaksi.item_kode', $item_kode)
                ->join('tbl_item_paket', "tbl_transaksi.item_kode = tbl_item_paket.kode_item", 'left')
                ->join('tbl_formula', "tbl_transaksi.item_kode = tbl_formula.item_kode", 'left')
                ->like('kode_unit', $kode_unit, 'both')
                ->like('kategori_transaksi', $kategori_transaksi)
                ->orderBy($orderBy, $direction)
                ->get();
            // check query, when query success with data, 
            // set to result
            if (count($query->getResultArray()) > 0) {
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * get total transaksi mahasiswa 
     */
    public function getTotalTransaksiMhs(String $nim, String $ks)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
                ->selectSum($ks == 'D' ? 'q_debit' : 'q_kredit')
                ->where('kode_unit', $nim)
                ->where('kategori_transaksi', $ks)
                ->get();
            // check query, when query success with data then set to result
            if (count($query->getResultArray()) > 0) {
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * get total tagihan, pembayaran, sisa tagihan
     */
    public function getInfoKeuanganMhs(String $nim)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
                ->selectSum('q_debit', 'total_pembayaran')
                ->selectSum('q_kredit', 'total_tagihan')
                ->select('(SUM(q_kredit) - SUM(q_debit)) as sisa_tagihan')
                ->where('kode_unit', $nim)
                ->get();
            // check query, when success with data then set to result
            if (count($query->getResultArray()) > 0) {
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function getStatusItemTransaksi(String $kode_unit)
    {
        try {
            // set result
            $result = [];
            // set query
            $query_k = $this->builder()
                ->like('kode_unit', $kode_unit, 'both')
                ->like('kategori_transaksi', 'K')
                ->join('tbl_item_paket', "tbl_transaksi.item_kode = tbl_item_paket.kode_item", 'left')
                ->join('tbl_formula', "tbl_transaksi.item_kode = tbl_formula.item_kode", 'left')
                ->get();
            // check query
            // dd($query_k->getResultArray());
            if (count($query_k->getResultArray()) > 0) {
                // tagihan
                $tagihan = $query_k->getResultArray();
                // loop tagihan
                foreach ($tagihan as $key => $value) {
                    // get semester
                    $semester = explode('SMT', $tagihan[$key]['semester_id']);
                    // set query pembayaran by item
                    $query_d = $this->builder()
                        ->select('(SUM(q_kredit) - SUM(q_debit)) as sisa_tagihan')
                        ->where('item_kode', $value['kode_item'])
                        ->like('kode_unit', $kode_unit, 'both')
                        ->get();
                    // check
                    if (count($query_d->getResultArray()) > 0) {
                        $pembayaran = $query_d->getResultArray();
                        // dd($pembayaran);
                        // check sisa tagihan, when 0 then "lunas"
                        if ((int)$pembayaran[0]['sisa_tagihan'] > 0) {
                            array_push($result, [$tagihan[$key]['kode_item'], $tagihan[$key]['semester_id'] . ' - ' . $tagihan[$key]['nama_item'], 'belum_lunas', $semester[1]]);
                        } else if ($pembayaran[0]['sisa_tagihan'] == null) {
                            array_push($result, [$tagihan[$key]['kode_item'], $tagihan[$key]['semester_id'] . ' - ' . $tagihan[$key]['nama_item'], 'belum_lunas', $semester[1]]);
                        } else if ((int)$pembayaran[0]['sisa_tagihan'] == 0) {
                            array_push($result, [$tagihan[$key]['kode_item'], $tagihan[$key]['semester_id'] . ' - ' . $tagihan[$key]['nama_item'], 'lunas', $semester[1]]);
                        }
                    }
                }
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * 
     */
    public function getChartDataByYear(String $year, String $type)
    {
        try {
            // set result
            $result = [];
            // set query
            if ($type == 'q_debit') {
                $query_data = $this->builder()
                    ->select("YEAR('$year-01-01') AS tahun, MONTH(created_at) AS bulan, SUM($type) AS total")
                    ->where('YEAR(created_at)', $year)
                    ->where('kategori_transaksi', 'D')
                    ->like('kode_transaksi', 'BY')
                    ->groupBy("YEAR('$year-01-01'), MONTH(created_at)")
                    ->orderBy('MONTH(tanggal_transaksi)', 'ASC')
                    ->get();
            }
            if ($type == 'q_kredit') {
                $query_data = $this->builder()
                    ->select("YEAR('$year-01-01') AS tahun, MONTH(created_at) AS bulan, SUM($type) AS total")
                    ->where('YEAR(created_at)', $year)
                    ->where('kategori_transaksi', 'K')
                    ->Like('kode_transaksi', 'BY')
                    ->groupBy("YEAR('$year-01-01'), MONTH(created_at)")
                    ->orderBy('MONTH(tanggal_transaksi)', 'ASC')
                    ->get();
            }

            // check query
            if (count($query_data->getResultArray()) > 0) {
                $data = $query_data->getResultArray();
                $data_short = [];
                for ($i=1; $i <= 12; $i++) { 
                    // dd(array_search((string)$i,array_column(json_decode(json_encode($data),true), 'bulan'),true));
                    $idx_found = array_search((string)$i,array_column(json_decode(json_encode($data),true), 'bulan'),true);
                    if(is_numeric($idx_found)){
                        array_push($data_short, (int)$data[$idx_found]['total']);
                        continue;
                    } else {
                        array_push($data_short, 0);
                        array_push($data, ['tahun' => $data[0]['tahun'], 'bulan' => $i, 'total' => 0]);
                    }
                }
                $result = $data_short;
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
