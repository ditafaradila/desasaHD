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
                                'days_to_ship', 'ship_by_date', 'buyer_user_id', 'buyer_username', 'item_id',
                                'item_name']; // Sesuaikan dengan kolom yang ingin Anda simpan

    public function getOrderedDetailOrders(){
        return $this->orderBy('create_time', 'DESC')->findAll();
    }

    public function getDetailOrder(){
        return $this->db->table('tbl_orderList')
            ->select('tbl_supply.id_supply, tbl_supply.id_jenisBarang, tbl_jenisbarang.jenis_barang, tbl_supply.jumlah_supply, tbl_supply.harga_supply, tbl_supply.tanggal_supply')
            ->join('tbl_jenisbarang', 'tbl_jenisbarang.id_jenisBarang = tbl_supply.id_jenisBarang')
            ->where('tbl_supply.jumlah_supply >', 0)
            ->get()
            ->getResultArray();
    }

    public function saveItem($data){
        if (isset($data['item_list'])) {
            $itemIds = [];
            $itemNames = [];
            foreach ($data['item_list'] as $item) {
                $itemIds[] = $item['item_id'];
                $itemNames[] = $item['item_name'];
            }
            $data['item_id'] = implode(',', $itemIds);
            $data['item_name'] = implode(',', $itemNames);
        } else {
            $data['item_id'] = null;
            $data['item_name'] = null;
        }
    
        error_log('Saving item: ' . print_r($data, true));
    
        $existingItem = $this->where('order_sn', $data['order_sn'])->first();
    
        if (!$existingItem) {
            if (!$this->insert($data)) {
                error_log('Error inserting item: ' . json_encode($this->errors()));
            }
        } else {
            if (!$this->update($existingItem['id_orderList'], $data)) {
                error_log('Error updating item: ' . json_encode($this->errors()));
            }
        }
    }  
}
