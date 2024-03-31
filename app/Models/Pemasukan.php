<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemasukan extends Model
{
    protected $table            = 'tbl_pemasukan';
    protected $primaryKey       = 'id_pemasukan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pemasukan', 'id_transaksi', 'sumber', 'tanggal', 'jumlah'];

    public function getPemasukan(){
        return $this->db->table('tbl_pemasukan')
        ->get()->getResultArray();
    }

    public function getTotalIn($bulan, $tahun){
        $pemasukan = $this->db->table('tbl_pemasukan')
                        ->select('tanggal, SUM(jumlah) as total_pemasukan')
                        ->where('MONTH(tanggal)', $bulan)
                        ->where('YEAR(tanggal)', $tahun)
                        ->groupBy('tanggal')
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