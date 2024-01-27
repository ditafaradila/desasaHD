<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Transaksi extends Seeder
{
    public function run()
    {
        $data_transaksi = [
            [
                'id_transaksi'    => '001',
                'waktu' => '2024-01-27',
                'metode_bayar' => 'Tunai',
                'diskon' => '100000',
                'nominal' => '250000',
                'id_produk' => '101'
            ],
        ];

        foreach ($data_transaksi as $data){
            $this->db->table('tbl_transaksi')->insert($data);
        }
    }
}
