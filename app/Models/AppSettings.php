<?php

namespace App\Models;

use CodeIgniter\Model;

class AppSettings extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_settings';
    protected $primaryKey       = 'id_setting';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_setting', 'nama_setting', 'deskripsi_settings', 'value'];

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
     * Get Setting by id_setting
     */
    public function getSettingById(String $id_setting = null)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
                ->where('id_setting', $id_setting)
                ->orderBy('id_setting', 'ASC')
                ->get();
            // check query
            if (count($query->getResultArray()) > 0) {
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get Setting by Name
     */
    public function getSettingByName(String $nama_setting = null)
    {
        try {
            // set result
            $result = "Data tidak ditemukan!";
            // set query
            $query = $this->builder()
                ->where('nama_setting', $nama_setting)
                ->orderBy('id_setting', 'ASC')
                ->get();
            // check query
            if (count($query->getResultArray()) > 0) {
                $result = $query->getResultArray();
            }
            return $result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
