<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterFormula extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_master_formula';
    protected $primaryKey       = 'kode_mformula';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_mformula', 'kode_mformula', 'persentase_tw', 'persentase_tb'];

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

    // Methods
    
    /**
     * get master formula by id
     */
    public function getById(String $id_mformula)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
                ->where('id_mformula', $id_mformula)
                ->get();
            // check the query
            if($query->getResultArray()){
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * get master formula by kode 
     */
    public function getByKodeMFormula(String $kode)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
                ->where('kode_mformula', $kode)
                ->get();
            // check the query
            if($query->getResultArray()){
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
