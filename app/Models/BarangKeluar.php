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
        ->join('tbl_jenisbarang', 'tbl_jenisbarang.id_jenisBarang=tbl_supply.id_jenisBarang')
        ->get()->getResultArray();
    }

    public function getTotalOut(){
        return $this->db->table('tbl_barangKeluar')
        ->select('tbl_supply.id_supply, tbl_jenisbarang.jenis_barang, SUM(tbl_barangKeluar.jumlah_barangKeluar) as total_jumlah_barangKeluar, MAX(tbl_barangKeluar.tanggal_barangKeluar) as max_tanggal_barangKeluar')
        ->join('tbl_supply', 'tbl_supply.id_supply=tbl_barangKeluar.id_supply')
        ->join('tbl_jenisbarang', 'tbl_jenisbarang.id_jenisBarang=tbl_supply.id_jenisBarang')
        ->groupBy('tbl_supply.id_supply')
        ->get()
        ->getResultArray();
    }
}