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
    protected $protectFields    = true;
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
                    //->select("SELECT * FROM `tbl_transaksi` LEFT JOIN tbl_item_paket ON item_kode = tbl_item_paket.kode_item WHERE (tbl_transaksi.created_at BETWEEN '$from' AND '$to') AND (kategori_transaksi LIKE '%$kategori_transaksi%') ORDER BY id_transaksi ASC")
                    // ->join('tbl_item_paket', "tbl_transaksi.item_kode = tbl_item_paket.kode_item", 'left')
                    // ->where("(created_at BETWEEN $from AND $to) AND (kategori transaksi LIKE '%$kategori_transaksi%')")
                    ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'left')
                    ->where("tbl_transaksi.created_at >=", $from)
                    ->where("tbl_transaksi.created_at <=", $to)
                    ->like('kategori_transaksi', $kategori_transaksi)
                    ->orderBy($orderBy, $direction)
                    ->get();
            } else if ($kode_unit == 'LAIN') {
                // set query
                $query = $this->builder()
                    //->select("SELECT * FROM `tbl_transaksi` LEFT JOIN tbl_item_paket ON item_kode = tbl_item_paket.kode_item WHERE (tbl_transaksi.created_at BETWEEN '$from' AND '$to') AND (kategori_transaksi LIKE '%$kategori_transaksi%') AND kode_transaksi NOT LIKE 'BY-%' ORDER BY id_transaksi ASC")
                    // ->where("(created_at BETWEEN $from AND $to) AND (kategori transaksi LIKE '%$kategori_transaksi%')")
                    // ->notLike('kode_transaksi', 'BY-', 'both')
                    // ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'left')
                    // ->where("(tbl_transaksi.created_at >= '$from' AND tbl_transaksi.created_at <= '$to') AND (kategori_transaksi LIKE '%$kategori_transaksi%') AND (kode_transaksi NOT LIKE 'BY-%')")
                    ->join('tbl_item_paket', 'item_kode = tbl_item_paket.kode_item', 'left')
                    ->where("tbl_transaksi.created_at >=", $from)
                    ->where("tbl_transaksi.created_at <=", $to)
                    ->like('kategori_transaksi', $kategori_transaksi)
                    ->notLike('kode_transaksi', 'BY-')
                    ->orderBy($orderBy, $direction)
                    ->get();
            } else if($kode_unit == 'PENGELUARAN') {
                $query = $this->builder()
                    ->get();
            } else {
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
            if ($query->getResultArray()) {
                $result = $query->getResultArray();
            }
            return $result;
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
                ->where('item_kode', $item_kode)
                ->join('tbl_item_paket', "$item_kode = tbl_item_paket.kode_item", 'left')
                ->join('tbl_formula', "$item_kode = tbl_formula.item_kode", 'left')
                ->like('kode_unit', $kode_unit, 'both')
                ->like('kategori_transaksi', $kategori_transaksi)
                ->orderBy($orderBy, $direction)
                ->get();
            // check query, when query success with data, 
            // set to result
            if ($query->getResultArray()) {
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
            if ($query->getResultArray()) {
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
            if ($query->getResultArray()) {
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getItemTagihan(String $status)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
