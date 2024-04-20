<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table      = 'itemModel'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'item_id'; // Ganti dengan nama primary key Anda jika berbeda

    protected $allowedFields = ['item_id', 'item_status', 'update_time']; // Kolom yang dapat diisi

    // Metode untuk menyimpan data item ke dalam basis data
    public function saveItem($data)
    {
        return $this->insert($data); // Menyimpan data ke dalam tabel
    }
}
