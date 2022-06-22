<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemPaket extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_item_paket';
    protected $primaryKey       = 'id_item';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_item', 'nama_item', 'nominal_item', 'keterangan_item', 'paket_id', 'angkatan_id', 'semester_id'];

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

    public function getLastId()
    {
        try {
            $result = "Data tidak ditemukan!";
            $last_id = $this->builder()
                ->select('id_item')
                ->orderBy('id_item', 'DESC')
                ->get(1);
            // check
            if ($last_id->getResultArray()) {
                $result = $last_id->getResultArray();
                return $result[0]['id_item'];
            } else {
                return $result;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
