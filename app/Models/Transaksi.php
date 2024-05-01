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
        ->orderBy('waktu', 'DESC')
        ->get()->getResultArray();
    }

    public function getTop3PenjualanProduk(){
        return $this->db->table('tbl_transaksi')
            ->join('tbl_produk', 'tbl_produk.id_produk=tbl_transaksi.id_produk')
            ->select('tbl_produk.id_produk, tbl_produk.foto_produk, tbl_produk.nama_produk, COUNT(tbl_transaksi.id_transaksi) as jumlah_penjualan')
            ->groupBy('tbl_produk.id_produk')
            ->orderBy('jumlah_penjualan', 'DESC')
            ->limit(3)
            ->get()
            ->getResultArray();
    }

    public function getHargaProduk($id_produk){
        return $this->db->table('tbl_produk')
            ->where('id_produk', $id_produk)
            ->get()->getRow('harga_produk');
    }
}