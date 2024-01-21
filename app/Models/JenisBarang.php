<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisBarang extends Model
{
    protected $table            = 'tbl_jenisbarang';
    protected $primaryKey       = 'id_jenisBarang';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_jenisBarang', 'jenis_barang'];

    public function getjenisBarang(){
        return $this->db->table('tbl_jenisbarang')
        ->get()->getResultArray();
    }
}