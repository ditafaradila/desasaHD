<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengeluaran extends Model
{
    protected $table            = 'tbl_pengeluaran';
    protected $primaryKey       = 'id_pengeluaran';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengeluaran', 'id_keuangan', 'keperluan', 'tanggal', 'nominal'];

    public function getPengeluaran(){
        return $this->db->table('tbl_pengeluaran')
        ->get()->getResultArray();
    }

    public function getTotalOut(){
        $pengeluaran= $this->db->table('tbl_pengeluaran')
                        ->select('tanggal, SUM(nominal) as total_pengeluaran')
                        ->groupBy('tanggal')
                        ->get()
                        ->getResultArray();
        return $pengeluaran;
    }

    public function getDetailPengeluaranByDate($tanggal){
        return $this->db->table('tbl_pengeluaran')
                        ->where('tanggal', $tanggal)
                        ->get()
                        ->getResultArray();
    }
}