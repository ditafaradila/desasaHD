<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\detailItemModel;
use App\Models\Produk;

class ProdukController extends BaseController{
    public function viewProduk(){
        $produkModel = new Produk();
        $detailModel = new detailItemModel();

        $data = [
            'title' => 'Produk Toko',
            'produk' => $produkModel->getProduk(),
            'items2' => $detailModel->findAll(),
        ];

        return view('toko/produk', $data);
    }

    public function tambahProduk(){
        $produkModel = new Produk();

        $data = [
            'title' => 'Tambah Produk',
            'produk' => $produkModel->getProduk(),
        ];

        return view('toko/tambahProduk', $data);
    }

    public function viewShopee(){
        $detailModel = new detailItemModel();

        $data = [
            'title' => 'Produk Shopee',
            'items2' => $detailModel->findAll(),
        ];

        return view('toko/produkShopee', $data);
    }

    public function storeProduk(){
        $produkModel = new Produk();
        $dataBerkas = $this->request->getFile('foto_produk');
        $fileName = $dataBerkas->getName();
        $jumlahProduk = $this->request->getPost('jumlah_produk');
        $hargaProduk = $this->request->getPost('harga_produk');

        if (!is_numeric($jumlahProduk)) {
            return redirect()->to('/produk')->with('error', 'Jumlah Produk harus angka!');
        }
        if ($jumlahProduk <= 0) {
            return redirect()->to('/produk')->with('error', 'Jumlah Produk harus lebih dari 0!');
        }
        if (!is_numeric($hargaProduk)) {
            return redirect()->to('/produk')->with('error', 'Harga Produk harus angka!');
        }

        // Validasi ekstensi file
        $allowedExtensions = ['png', 'jpeg', 'jpg'];
        $fileExt = $dataBerkas->getClientExtension();
        if (!in_array($fileExt, $allowedExtensions)) {
            return redirect()->to('/produk')->with('error', 'Ekstensi file harus PNG, JPEG, atau JPG!');
        }

        $produkModel->insert([
            'id_produk' => $this->request->getPost('id_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'jumlah_produk' => $this->request->getPost('jumlah_produk'),
            'harga_produk' => $this->request->getPost('harga_produk'),
            'foto_produk' => $fileName,
        ]);

        $dataBerkas->move('berkas', $fileName);
        session()->setFlashdata('success', 'Foto Berhasil diupload');
        return redirect()->to('produk');
    }

    public function kurangjumlahProduk($id_produk){
        $produkModel = new Produk();

        $data = [
            'jumlah_produk' => $this->request->getPost('jumlah_produk'),
        ];

        $produkModel->update($id_produk, $data);
        return redirect()->to(base_url('produk'));
    }

    public function tambahjumlahProduk($id_produk){
        $produkModel = new Produk();

        $data = [
            'jumlah_produk' => $this->request->getPost('jumlah_produk'),
        ];

        $produkModel->update($id_produk, $data);
        return redirect()->to(base_url('produk'));
    }

    public function edit($id_produk){
        $produkModel = new Produk();
        $dataBerkas = $this->request->getFile('foto_produk');
        $fileName = $dataBerkas->getName();
        $jumlahProduk = $this->request->getPost('jumlah_produk');
        $hargaProduk = $this->request->getPost('harga_produk');
        

        if (!is_numeric($jumlahProduk)) {
            return redirect()->to('/produk')->with('error', 'Jumlah Produk harus angka!');
        }
        if ($jumlahProduk <= 0) {
            return redirect()->to('/produk')->with('error', 'Jumlah Produk harus lebih dari 0!');
        }
        if (!is_numeric($hargaProduk)) {
            return redirect()->to('/produk')->with('error', 'Harga Produk harus angka!');
        }

        // Validasi ekstensi file
        $allowedExtensions = ['png', 'jpeg', 'jpg'];
        $fileExt = $dataBerkas->getClientExtension();
        if (!in_array($fileExt, $allowedExtensions)) {
            return redirect()->to('/produk')->with('error', 'Ekstensi file harus PNG, JPEG, atau JPG!');
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_produk' => $this->request->getPost('harga_produk'),
            'jumlah_produk' => $this->request->getPost('jumlah_produk'),
            'foto_produk' => $fileName,
        ];

        $dataBerkas->move('berkas', $fileName);
        $produkModel->update($id_produk, $data);
        return redirect()->to('produk');        
    }

    public function delete($id_produk){
        $produkModel = new Produk();
        $produkModel->delete($id_produk);

        return redirect()->to('/produk');
    }
}