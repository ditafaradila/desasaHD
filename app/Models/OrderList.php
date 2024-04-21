<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderList extends Model
{
    protected $table      = 'tbl_orderList'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'order_sn'; // Ganti dengan nama primary key Anda jika berbeda

    protected $allowedFields = ['order_sn', 'order_status']; // Kolom yang dapat diisi

    // Metode untuk menyimpan data item ke dalam basis data
    public function saveItem($data)
    {
        return $this->insert($data); // Menyimpan data ke dalam tabel
    }
}
