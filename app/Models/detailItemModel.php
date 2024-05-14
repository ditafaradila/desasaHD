<?php

namespace App\Models;

use CodeIgniter\Model;

class detailItemModel extends Model
{
    protected $table = 'tbl_detailitem'; // Sesuaikan dengan nama tabel di database Anda
    protected $primaryKey = 'id_detailItem'; // Sesuaikan dengan nama primary key di tabel Anda
    protected $allowedFields = ['id_detailItem', 'item_id', 'category_id', 'item_name', 'description', 'item_sku', 'create_time', 'update_time', 'currency',
                                'original_price', 'current_price', 'stock_type', 'current_stock', 'normal_stock', 'image_url_list', 'weight', 'condition', 'size_chart', 'item_status', 'deboost']; // Sesuaikan dengan kolom yang ingin Anda simpan


    public function saveItem($data){
        if (isset($data['image'])) {
            $image_url_list = implode(',', $data['image']['image_url_list']);
            $data['image_url_list'] = $image_url_list;
        } else {
            $data['image_url_list'] = null;
        }

        if (isset($data['price_info'])) {
            // Ambil nilai currency dari price_info
            $currency = $data['price_info'][0]['currency'];
            $original_price = $data['price_info'][0]['original_price'];
            $current_price = $data['price_info'][0]['current_price'];
            // Tambahkan nilai currency ke dalam array item sebelum disimpan
            $data['currency'] = $currency;
            $data['original_price'] = $original_price;
            $data['current_price'] = $current_price;
        } else {
            // Jika tidak ada informasi harga, atur currency menjadi null atau nilai default lainnya
            $data['currency'] = null;
            $data['original_price'] = null;
            $data['current_price'] = null;
        }

        if (isset($data['stock_info'])) {
            $stock_type = $data['stock_info'][0]['stock_type'];
            $current_stock = $data['stock_info'][0]['current_stock'];
            $normal_stock = $data['stock_info'][0]['normal_stock'];

            $data['stock_type'] = $stock_type;
            $data['current_stock'] = $current_stock;
            $data['normal_stock'] = $normal_stock;
        } else {
            $data['stock_type'] = null;
            $data['current_stock'] = null;
            $data['normal_stock'] = null;
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
