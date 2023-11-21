<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        $data_role = [
            [
                'id_role'    => '1',
                'role' => 'owner',
            ],
            [
                'id_role'    => '2',
                'role' => 'karyawan',
            ],
        ];

        foreach ($data_role as $data){
            $this->db->table('tbl_role')->insert($data);
        }
    }
}
