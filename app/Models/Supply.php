<?php

namespace App\Models;

use CodeIgniter\Model;

class Supply extends Model
{
    protected $table            = 'tbl_supply';
    protected $primaryKey       = 'id_supply';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_supply', 'nama_supply', 'jumlah_supply', 'harga_supply', 'tanggal_supply'];

    public function getSupply(){
        return $this->db->table('tbl_supply')
        ->get()->getResultArray();
    }
}