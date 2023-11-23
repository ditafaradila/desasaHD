<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pemasukan;

class KeuanganController extends BaseController{
    public function index(){
        $pemasukanModel = new Pemasukan();

        $data = [
            'pemasukan' => $pemasukanModel->getPemasukan(),
        ];
        
        return view('toko/keuangan', $data);
    }

    public function tambahK(){
        $data = [
            'title' => 'Tambah Data Keuangan',
        ];

        return view('toko/tambahPemasukan', $data);
    }

    public function storeK(){
        if(!$this->validate([
            'id_pemasukan' => 'required',
            'sumber' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ])){
            return redirect()->to('/tambahPemasukan');
        }

        $pemasukanModel = new Pemasukan();
        $data = [
            'id_pemasukan' => $this->request->getPost('id_pemasukan'),
            'sumber' => $this->request->getPost('sumber'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        $pemasukanModel->save($data);
        return redirect()->to('/Keuangan');
    }

    public function editPemasukan($id_pemasukan){
        $pemasukanModel = new Pemasukan();
        $karyawan = $pemasukanModel->find($id_pemasukan);

        $data = [
            'title' => 'Edit Data Pemasukan',
            'pemasukan' => $pemasukanModel,
        ];

        return view('toko/editPemasukan', $data);
    }

}