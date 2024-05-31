<?php

namespace App\Models;

use CodeIgniter\Model;

class detailItemModel extends Model
{
    protected $table = 'tbl_detailitem'; // Sesuaikan dengan nama tabel di database Anda
    protected $primaryKey = 'id_detailItem'; // Sesuaikan dengan nama primary key di tabel Anda
    protected $allowedFields = [
        'id_detailItem', 'item_id', 'category_id', 'item_name', 'description', 'item_sku', 'create_time', 'update_time', 'currency',
        'original_price', 'current_price', 'stock_type', 'current_stock', 'normal_stock', 'image_url_list', 'weight', 'condition',
        'size_chart', 'item_status', 'deboost', 'total_reserved_stock', 'total_available_stock', 'sale', 'views', 'likes', 'rating_star', 'comment_count'
    ]; // Sesuaikan dengan kolom yang ingin Anda simpan

    public function getTop3PenjualanShopee($limit = 3){
        return $this->orderBy('sale', 'DESC')
                    ->findAll($limit);
    }

    public function saveItem($data)
    {
        if (isset($data['image'])) {
            $image_url_list = implode(',', $data['image']['image_url_list']);
            $data['image_url_list'] = $image_url_list;
        } else {
            $data['image_url_list'] = null;
        }

        //error_log('Price Info: ' . json_encode($data['price_info']));
        if (isset($data['price_info'])) {
            $currency = $data['price_info'][0]['currency'] ?? null;
            $original_price = $data['price_info'][0]['original_price'] ?? null;
            $current_price = $data['price_info'][0]['current_price'] ?? null;
            $data['currency'] = $currency;
            $data['original_price'] = $original_price;
            $data['current_price'] = $current_price;
        } else {
            $data['currency'] = null;
            $data['original_price'] = null;
            $data['current_price'] = null;
        }

        //error_log('Stock Info: ' . json_encode($data['stock_info']));
        if (isset($data['stock_info'])) {
            $stock_type = $data['stock_info'][0]['stock_type'] ?? null;
            $current_stock = $data['stock_info'][0]['current_stock'] ?? null;
            $normal_stock = $data['stock_info'][0]['normal_stock'];

            $data['stock_type'] = $stock_type;
            $data['current_stock'] = $current_stock;
            $data['normal_stock'] = $normal_stock;
        } else {
            $data['stock_type'] = null;
            $data['current_stock'] = null;
            $data['normal_stock'] = null;
        }

        if (isset($data['stock_info_v2'])) {
            $total_reserved_stock = $data['stock_info_v2']['summary_info']['total_reserved_stock'] ?? null;
            $total_available_stock = $data['stock_info_v2']['summary_info']['total_available_stock'] ?? null;

            error_log('Total Reserved Stock: ' . $total_reserved_stock);
            error_log('Total Available Stock: ' . $total_available_stock);
            $data['total_reserved_stock'] = $total_reserved_stock;
            $data['total_available_stock'] = $total_available_stock;
        } else {
            $data['total_reserved_stock'] = null;
            $data['total_available_stock'] = null;
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
