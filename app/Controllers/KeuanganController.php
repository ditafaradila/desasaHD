<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KeuanganController extends BaseController{
    public function index(){
        return view('/keuangan');
    }
}