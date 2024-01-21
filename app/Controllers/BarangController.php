<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Seeds\jenisBarang as SeedsJenisBarang;
use App\Models\BarangKeluar;
use App\Models\JenisBarang;
use App\Models\Supply;

class BarangController extends BaseController{
    public function index(){
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();

        $data = [
            'title' => 'Bahan Baku',
            'jenisBarang' => $jenisBarang,
        ];
        
        return view('toko/bahanbaku', $data);
    }

    public function storeBahanBaku(){
        $jenisBarangModel = new JenisBarang();
        $data = [
            'id_jenisBarang' => $this->request->getPost('id_jenisBarang'),
            'jenis_barang' => $this->request->getPost('jenis_barang'),
        ];

        $jenisBarangModel->save($data);
        return redirect()->to('/bahanbaku');
    }

    public function updateBahanBaku($id_jenisBarang){
        $jenisBarangModel = new JenisBarang();
        $data = [
            'jenis_barang' => $this->request->getPost('jenis_barang'),
        ];

        $jenisBarangModel->update($id_jenisBarang, $data);
        return redirect()->to('/bahanbaku');    
    }

    public function hapusjenisBarang($id_jenisBarang){
        $jenisBarangModel = new JenisBarang();
        $jenisBarangModel->delete($id_jenisBarang);

        return redirect()->to('/bahanbaku');
    }
}