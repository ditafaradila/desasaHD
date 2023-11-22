<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProdukController extends BaseController{
    public function viewProduk(){
        return view('toko/produk');
    }
}