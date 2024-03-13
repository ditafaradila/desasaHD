<?php

namespace App\Models;

use CodeIgniter\Model;

class user extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'username', 'password', 'id_role', 'nama'];

    public function getData(){
        return $this->db->table('tbl_user')
        ->get()->getResultArray();
    }

    public function login($username, $password)
    {
        $user = $this->db->table('tbl_user')
            ->where('username', $username)
            ->where('password', $password)
            ->get()
            ->getRowArray();

        return $user;
    }
}