<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TransaksiController extends BaseController{
    public function index(){
        return view('/transaksi');
    }
}