<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthMiddleware implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null){
        $session = Services::session();

        // Periksa apakah pengguna sudah login
        if (!$session->get('logged_in')) {
            if ($request->uri->getPath() !== 'login') {
                return redirect()->to(base_url('login'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
    }
}
