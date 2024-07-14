<?php

namespace App\Controllers;

use App\Models\user;

class Auth extends BaseController{
    public function login(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        if (is_array($username) || is_array($password)) {
            session()->setFlashdata('error', 'Invalid input!');
            return redirect()->back()->withInput();
        }
        $username = htmlspecialchars(strval($username));
        $password = htmlspecialchars(strval($password));
        
        $model = new user();
        $user = $model->login($username, $password);

        if ($user) {
            session()->set([
                'logged_in' => true,
                'username' => $username,
                'nama' => $user['nama'],
                'id_role' => $user['id_role']
            ]);
            $allowedPaths = ['listKeuangan', 'api', 'dashboard'];
            if ($user['id_role'] == 2 && in_array($this->request->uri->getPath(), $allowedPaths)) {
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
