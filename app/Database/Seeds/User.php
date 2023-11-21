<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data_user = [
            [
                'id_user'    => '1',
                'username' => 'ditafaa',
                'password' => 'ditafaa',
                'id_role' => '1',
                'nama' => 'Dita Faradila',
            ],
        ];

        foreach ($data_user as $data){
            $this->db->table('tbl_user')->insert($data);
        }
    }
}
