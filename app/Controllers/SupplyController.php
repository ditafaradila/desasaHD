<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SupplyController extends BaseController{
    public function index(){
        return view('/supply');
    }
}