<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Produk extends Seeder
{
    public function run()
    {
        $data_produk = [
            [
                'id_produk'    => '101',
                'nama_produk' => 'Bunga Mayang',
                'jumlah_produk' => '',
                'harga_produk' => '100000',
                'foto_produk' => 'rose.jpeg',
            ],
        ];

        foreach ($data_produk as $data){
            $this->db->table('tbl_produk')->insert($data);
        }
    }
}
