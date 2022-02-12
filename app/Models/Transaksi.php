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
    public function findTransaksi(String $kode_unit, String $kategori_transaksi, String $orderBy, String $direction)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
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
}
