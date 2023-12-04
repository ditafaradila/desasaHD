<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk extends Model
{
    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_produk', 'nama_produk', 'jumlah_produk', 'harga_produk', 'foto_produk'];

    public function getProduk(){
        return $this->db->table('tbl_produk')
        ->get()->getResultArray();
    }
}