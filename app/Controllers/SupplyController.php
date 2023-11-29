<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SupplyController extends BaseController{
    public function index(){
        return view('toko/supply');
    }

    public function tambahS(){
        $data = [
            'title' => 'Tambah Data Supply',
        ];

        return view('toko/tambahSupply', $data);
    }
}