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
    protected $allowedFields    = [];

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
    public function findTransaksi(String $kode_unit, String $kategori_transaksi)
    {
        try {
            $result = "Data tidak ditemukan!";
            $this->like('kode_unit', $kode_unit);
            $this->like('kategori_transaksi', $kategori_transaksi);
            $query = $this->get();
            if ($query->getResultArray()) {
                $result = $query->getResutArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
