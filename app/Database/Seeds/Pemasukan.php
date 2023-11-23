<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pemasukan extends Seeder
{
    public function run()
    {
        $data_pemasukan = [
            [
                'id_pemasukan'    => '1',
                'sumber' => 'Shopee',
                'tanggal' => '23 November 2023',
                'jumlah' => '150000',
            ],
        ];

        foreach ($data_pemasukan as $data){
            $this->db->table('tbl_pemasukan')->insert($data);
        }
    }
}
