<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Supply extends Seeder
{
    public function run()
    {
        $data_supply = [
            [
                'id_supply'    => '111',
                'nama_supply' => 'Pot',
                'jumlah_supply' => '4',
                'harga_supply' => '100000',
                'tanggal_supply' => '2023-11-30',
            ],
        ];

        foreach ($data_supply as $data){
            $this->db->table('tbl_supply')->insert($data);
        }
    }
}
