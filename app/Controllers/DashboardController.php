<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController{
    public function dashboard(){
        $nama = session()->get('nama');

        $data = [
            'title' => 'Dashboard',
            $nama => 'nama',
        ];

        return view('toko/dashboard', $data);
    }
}