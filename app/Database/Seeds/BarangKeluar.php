<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangKeluar extends Seeder
{
    public function run()
    {
        $data_barangKeluar = [
            [
                'id_barangKeluar'    => '101',
                'id_supply' => '113',
                'jumlah_barangKeluar' => '1',
                'tanggal_barangKeluar' => '2024-1-19',
            ],
        ];

        foreach ($data_barangKeluar as $data){
            $this->db->table('tbl_barangKeluar')->insert($data);
        }
    }
}
