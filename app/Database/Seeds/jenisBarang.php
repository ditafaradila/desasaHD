<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class jenisBarang extends Seeder
{
    public function run()
    {
        $data_jenisBarang = [
            [
                'id_jenisBarang'    => '201',
                'jenis_Barang' => 'Bunga',
            ],
            [
                'id_jenisBarang'    => '202',
                'jenis_Barang' => 'Pot',
            ],
            [
                'id_jenisBarang'    => '203',
                'jenis_Barang' => 'Kawat',
            ],
            [
                'id_jenisBarang'    => '204',
                'jenis_Barang' => 'Floral Foam',
            ],
            [
                'id_jenisBarang'    => '205',
                'jenis_Barang' => 'Gunting',
            ],
            [
                'id_jenisBarang'    => '206',
                'jenis_Barang' => 'Pita',
            ],
            [
                'id_jenisBarang'    => '207',
                'jenis_Barang' => 'Tang',
            ],
        ];

        foreach ($data_jenisBarang as $data){
            $this->db->table('tbl_jenisBarang')->insert($data);
        }
    }
}
