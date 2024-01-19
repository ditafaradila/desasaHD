<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController{
    public function dashboard(){
        $data = [
            'title' => 'Dashboard',
        ];
        return view('toko/dashboard', $data);
    }
}