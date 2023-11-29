<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pengeluaran extends Seeder
{
    public function run()
    {
        $data_pengeluaran = [
            [
                'id_pengeluaran'    => '11',
                'keperluan' => 'Alat Bersih',
                'tanggal' => '2023-10-21',
                'nominal' => '35000',
            ],
        ];

        foreach ($data_pengeluaran as $data){
            $this->db->table('tbl_pengeluaran')->insert($data);
        }
    }
}
