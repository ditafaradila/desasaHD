<?php

namespace App\Models;

use CodeIgniter\Model;

class detailOrderList extends Model
{
    protected $table = 'tbl_detailorder'; // Sesuaikan dengan nama tabel di database Anda
    protected $primaryKey = 'id_orderList'; // Sesuaikan dengan nama primary key di tabel Anda
    protected $allowedFields = ['id_orderList', 'order_sn', 'region', 'currency', 'cod', 'total_amount', 
                                'pending_terms', 'order_status', 'shipping_carrier', 'payment_method',
                                'estimated_shipping_fee', 'message_to_seller', 'create_time', 'update_time',
                                'days_to_ship', 'ship_by_date', 'buyer_user_id', 'buyer_username']; // Sesuaikan dengan kolom yang ingin Anda simpan


    public function saveItem($data)
    {
        // Periksa apakah item dengan ID yang sama sudah ada di basis data
        $existingItem = $this->where('order_sn', $data['order_sn'])->first();
    
        if (!$existingItem) {
            // Jika item belum ada, simpan ke basis data
            $this->insert($data);
        } else {
            // Jika item sudah ada, lakukan pembaruan
            $this->update($existingItem['id_orderList'], $data);
        }
    }
    
}
