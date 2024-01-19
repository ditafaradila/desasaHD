<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
use App\Models\Supply;

class SupplyController extends BaseController{
    public function index(){
        $supplyModel = new Supply();
        $barangKeluarModel = new BarangKeluar();

        $data = [
            'title' => 'Supply',
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluarModel->getbarangKeluar()
        ];
        
        return view('toko/supply', $data);
    }


    public function tambahS(){
        $data = [
            'title' => 'Tambah Data Supply',
        ];

        return view('toko/tambahSupply', $data);
    }

    public function storeSupply(){
        $supplyModel = new Supply();
        $data = [
            'id_supply' => $this->request->getPost('id_supply'),
            'nama_supply' => $this->request->getPost('nama_supply'),
            'jumlah_supply' => $this->request->getPost('jumlah_supply'),
            'harga_supply' => $this->request->getPost('harga_supply'),
            'tanggal_supply' => $this->request->getPost('tanggal_supply'),
        ];

        $supplyModel->save($data);
        return redirect()->to('/supply');
    }

    public function editSupply($id_supply){
        $supplyModel = new Supply();
        $supply = $supplyModel->find($id_supply);

        $data = [
            'title' => 'Edit Data supply',
            'supply' => $supply,
        ];

        return view('toko/editSupply', $data);
    }

    public function updateSupply($id_supply){
        $supplyModel = new Supply();
        $data = [
            // 'id_supply' => $this->request->getPost('id_supply'),
            'nama_supply' => $this->request->getPost('nama_supply'),
            'jumlah_supply' => $this->request->getPost('jumlah_supply'),
            'harga_supply' => $this->request->getPost('harga_supply'),
            'tanggal_supply' => $this->request->getPost('tanggal_supply'),
        ];

        $supplyModel->update($id_supply, $data);
        return redirect()->to('/supply');    
    }

    public function hapusSupply($id_supply){
        $supplyModel = new Supply();
        $supplyModel->delete($id_supply);

        return redirect()->to('/supply');
    }

    public function tambahBarangKeluar(){
        $barangKeluarModel = new BarangKeluar();
        $supplyModel = new Supply();
        $supply = $supplyModel->findAll();

        $data = [
            'title' => 'Tambah Data Barang Keluar',
            'supply' => $supply,
            'barangKeluar' => $barangKeluarModel,
        ];

        return view('toko/tambahBarangKeluar', $data);
    }

    public function storeBK(){
        $barangKeluarModel = new BarangKeluar();
        $data = [
            'id_barangKeluar' => $this->request->getPost('id_barangKeluar'),
            'id_supply' => $this->request->getPost('id_supply'),
            'jumlah_barangKeluar' => $this->request->getPost('jumlah_barangKeluar'),
            'tanggal_barangKeluar' => $this->request->getPost('tanggal_barangKeluar'),
        ];

        $barangKeluarModel->save($data);
        return redirect()->to('/supply');
    }

    public function hapusBK($id_barangKeluar){
        $barangKeluarModel = new BarangKeluar();
        $barangKeluarModel->delete($id_barangKeluar);

        return redirect()->to('/supply');
    }
}