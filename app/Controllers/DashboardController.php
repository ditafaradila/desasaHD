<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController{
    public function dashboard(){
        return view('/dashboard');
    }
}