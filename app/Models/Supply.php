<?php

namespace App\Models;

use CodeIgniter\Model;

class Supply extends Model
{
    protected $table            = 'tbl_supply';
    protected $primaryKey       = 'id_supply';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_supply', 'id_jenisBarang', 'jumlah_supply', 'harga_supply', 'tanggal_supply'];

    public function getSupply(){
        return $this->db->table('tbl_supply')
        ->join('tbl_jenisbarang', 'tbl_jenisbarang.id_jenisBarang=tbl_supply.id_jenisBarang')
        ->get()->getResultArray();
    }

    public function getTotalSupply(){
        return $this->db->table('tbl_supply')
        ->select('tbl_jenisbarang.jenis_barang, SUM(tbl_supply.jumlah_supply) as total_jumlah_supply, SUM(tbl_supply.harga_supply) as total_harga_supply, MAX(tbl_supply.tanggal_supply) as max_tanggal_supply')
        ->join('tbl_jenisbarang', 'tbl_jenisbarang.id_jenisBarang=tbl_supply.id_jenisBarang')
        ->groupBy('tbl_jenisbarang.jenis_barang')
        ->get()->getResultArray();
    }
}