<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TransaksiController extends BaseController{
    public function index(){
        $data = [
            'title' => 'Transaksi',
        ];
        return view('toko/transaksi', $data);
    }
}