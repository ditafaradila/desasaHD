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

}