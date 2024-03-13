<?php

namespace App\Controllers;

use App\Models\user;

class Auth extends BaseController
{
    public function login()
    {
        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Panggil model untuk login
        $model = new user();
        $user = $model->login($username, $password);

        // Jika data pengguna ditemukan
        if ($user) {
            session()->set([
                'logged_in' => true,
                //'role' => $user['role'], // Simpan peran pengguna (owner atau karyawan)
                'username' => $username, // Simpan nama pengguna
                'nama' => $user['nama'],
            ]);

            // Tentukan alur berdasarkan peran pengguna
            if ($user['id_role'] == 1) {
                return redirect()->to(base_url('/dashboard'));
            } elseif ($user['id_role'] == 2) {
                return redirect()->to(base_url('/dashboard'));
            } else {
                return redirect()->to(base_url());
            }
            } else {
            // Jika data pengguna tidak ditemukan, kembalikan pesan error
            return "Username atau password salah!";
        }

    }

    public function logout(){
        session()->destroy();

        return redirect()->to(base_url('/login'));
    }
}
