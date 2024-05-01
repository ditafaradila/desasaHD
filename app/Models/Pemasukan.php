<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemasukan extends Model
{
    protected $table            = 'tbl_pemasukan';
    protected $primaryKey       = 'id_pemasukan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pemasukan','order_sn', 'id_transaksi', 'sumber', 'tanggal', 'jumlah'];

    public function getPemasukan(){
        return $this->db->table('tbl_pemasukan')
        ->get()->getResultArray();
    }

    public function getTotalIn($bulan){
        $pemasukan = $this->db->table('tbl_pemasukan')
                        ->select('DATE(tanggal) as tanggal, SUM(jumlah) as total_pemasukan')
                        ->where('MONTH(tanggal)', $bulan)
                        ->groupBy('DATE(tanggal)')
                        ->get()
                        ->getResultArray();
        return $pemasukan;
    }    

    public function getDetailPemasukanByDate($tanggal){
        return $this->db->table('tbl_pemasukan')
                        ->where('tanggal', $tanggal)
                        ->get()
                        ->getResultArray();
    }


}