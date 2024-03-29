<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_transaksi', 'waktu', 'metode_bayar', 'diskon', 'nominal', 'id_produk'];

    public function gettransaksi(){
        return $this->db->table('tbl_transaksi')
        ->join('tbl_produk', 'tbl_produk.id_produk=tbl_transaksi.id_produk')
        ->orderBy('waktu', 'ASC')
        ->get()->getResultArray();
    }

    public function getHargaProduk($id_produk){
        return $this->db->table('tbl_produk')
            ->where('id_produk', $id_produk)
            ->get()->getRow('harga_produk');
    }
}