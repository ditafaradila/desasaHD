<?php

namespace App\Controllers;

use App\Models\user;

class Auth extends BaseController{
    public function login(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $model = new user();
        $user = $model->login($username, $password);

        if ($user) {
            session()->set([
                'logged_in' => true,
                'username' => $username,
                'nama' => $user['nama'],
                'id_role' => $user['id_role']
            ]);
            if ($user['id_role'] == 2 && ($this->request->uri->getPath() === 'listKeuangan'
                || $this->request->uri->getPath() === 'api')) {
                return redirect()->to(base_url('/dashboard'));
            }
            return redirect()->to(base_url('/dashboard'));
        } else {
            session()->setFlashdata('error', 'Username atau Password Salah!');
            return redirect()->back()->withInput();
        }
    }

    public function logout(){
        session()->destroy();
        $data = [
            'title' => 'Logout',
        ];
        return redirect()->to(base_url('/login'));
    }
}
