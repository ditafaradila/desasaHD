<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        if(session('id_user')){
            return redirect()->to(site_url('dashboard'));
        }
        return view('welcome_message');
    }
}
