<?php

namespace App\Models;

use CodeIgniter\Model;

class detailItemModel extends Model
{
    protected $table = 'tbl_detailitem'; // Sesuaikan dengan nama tabel di database Anda
    protected $primaryKey = 'id_detailItem'; // Sesuaikan dengan nama primary key di tabel Anda
    protected $allowedFields = ['id_detailItem', 'item_id', 'category_id', 'item_name', 'description', 'item_sku', 'create_time', 'update_time', 'currency']; // Sesuaikan dengan kolom yang ingin Anda simpan

    // Tambahkan metode untuk menyimpan item ke dalam basis data
    public function saveItem($data)
    {
        // Periksa apakah kunci 'price_info' ada dalam array $data
        if (isset($data['price_info'])) {
            // Ambil nilai currency dari price_info
            $currency = $data['price_info'][0]['currency'];
    
            // Tambahkan nilai currency ke dalam array item sebelum disimpan
            $data['currency'] = $currency;
        } else {
            // Jika tidak ada informasi harga, atur currency menjadi null atau nilai default lainnya
            $data['currency'] = null;
        }
    
        // Periksa apakah item dengan ID yang sama sudah ada di basis data
        $existingItem = $this->where('item_id', $data['item_id'])->first();
    
        if (!$existingItem) {
            // Jika item belum ada, simpan ke basis data
            $this->insert($data);
        } else {
            // Jika item sudah ada, lakukan pembaruan
            $this->update($existingItem['id_detailItem'], $data);
        }
    }
    
}
