<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluar extends Model
{
    protected $table            = 'tbl_barangKeluar';
    protected $primaryKey       = 'id_barangKeluar';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_barangKeluar', 'id_supply', 'jumlah_barangKeluar','tanggal_barangKeluar'];

    public function getbarangKeluar(){
        return $this->db->table('tbl_barangKeluar')
        ->join('tbl_supply', 'tbl_supply.id_supply=tbl_barangKeluar.id_supply')
        ->get()->getResultArray();
    }
}