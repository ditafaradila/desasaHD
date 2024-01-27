<?php

namespace App\Models;

use CodeIgniter\Model;

class Keuangan extends Model
{
    protected $table            = 'tbl_keuangan';
    protected $primaryKey       = 'id_keuangan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_keuangan', 'id_pemasukan', 'id_pengeluaran','keterangan', 'tanggal', 'debit', 'kredit'];

    public function getkeuangan(){
        return $this->db->table('tbl_keuangan')
        ->orderBy('tanggal', 'ASC')
        ->get()->getResultArray();
    }

    public function getTotalDebit(){
        return $this->db->table('tbl_keuangan')
        ->selectSum('debit')
        ->get()->getResultArray();
    }
}