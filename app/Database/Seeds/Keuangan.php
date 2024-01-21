<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Keuangan extends Seeder
{
    public function run()
    {
        $data_keuangan = [
            [
                'id_keuangan'    => '001',
                'keterangan' => 'Shopee',
                'tanggal' => '23-10-2024',
                'debit' => '150000',
            ],
        ];

        foreach ($data_keuangan as $data){
            $this->db->table('tbl_keuangan')->insert($data);
        }
    }
}
