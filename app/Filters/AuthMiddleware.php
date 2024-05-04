<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();

        // Periksa apakah pengguna sudah login
        if (!$session->get('logged_in')) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->to(base_url('login'));
        }

        // Periksa id_role
        if (isset($arguments['id_role'])) {
            $id_role = $arguments['id_role'];

            if ($session->get('id_role') != $id_role) {
                if ($id_role == 1) {
                    return redirect()->to(base_url('toko/dashboard'));
                } elseif ($id_role == 2) {
                    if ($request->uri->getPath() === 'toko/listKeuangan' || $request->uri->getPath() === 'toko/api') {
                        return redirect()->to(base_url('toko/dashboard'));
                    }
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
