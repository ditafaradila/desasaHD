<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Seeds\jenisBarang as SeedsJenisBarang;
use App\Models\BarangKeluar;
use App\Models\JenisBarang;
use App\Models\Supply;

class SupplyController extends BaseController{
    public function index(){
        $supplyModel = new Supply();
        $barangKeluarModel = new BarangKeluar();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();
        
        $data = [
            'title' => 'Supply',
            'totalSupply' => $supplyModel->getTotalSupply(),
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluarModel->getbarangKeluar(),
            'totalBarangKeluar' => $barangKeluarModel->getTotalOut(),
            'jenisBarang' => $jenisBarang,
        ];
        
        return view('toko/supply', $data);
    }

    public function detail(){
        $supplyModel = new Supply();
        $barangKeluarModel = new BarangKeluar();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();
        
        $data = [
            'title' => 'Supply',
            'totalSupply' => $supplyModel->getTotalSupply(),
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluarModel->getbarangKeluar(),
            'jenisBarang' => $jenisBarang,
        ];
        
        return view('toko/detailBarangMasuk', $data);
    }

    public function tambahS(){
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();
        $data = [
            'title' => 'Tambah Data Supply',
            'jenisBarang' => $jenisBarang,
        ];

        return view('toko/tambahSupply', $data);
    }

    public function storeSupply(){
        $supplyModel = new Supply();
        $data = [
            'id_supply' => $this->request->getPost('id_supply'),
            'id_jenisBarang' => $this->request->getPost('id_jenisBarang'),
            'jumlah_supply' => $this->request->getPost('jumlah_supply'),
            'harga_supply' => $this->request->getPost('harga_supply'),
            'tanggal_supply' => $this->request->getPost('tanggal_supply'),
        ];

        $supplyModel->save($data);
        return redirect()->to('/detailBarangMasuk');
    }


    public function updateSupply($id_supply){
        $supplyModel = new Supply();
        $data = [
            // 'id_supply' => $this->request->getPost('id_supply'),
            'id_jenisBarang' => $this->request->getPost('id_jenisBarang'),
            'jumlah_supply' => $this->request->getPost('jumlah_supply'),
            'harga_supply' => $this->request->getPost('harga_supply'),
            'tanggal_supply' => $this->request->getPost('tanggal_supply'),
        ];

        $supplyModel->update($id_supply, $data);
        return redirect()->to('/detailBarangMasuk');    
    }

    public function hapusSupply($id_supply){
        $supplyModel = new Supply();
        $supplyModel->delete($id_supply);

        return redirect()->to('/detailBarangMasuk');
    }

    public function detailBarangKeluar(){
        $supplyModel = new Supply();
        $barangKeluarModel = new BarangKeluar();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();
        
        $data = [
            'title' => 'Supply',
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluarModel->getbarangKeluar(),
            'jenisBarang' => $jenisBarang,
        ];
        
        return view('toko/detailBarangKeluar', $data);
    }

    public function tambahBarangKeluar(){
        $barangKeluarModel = new BarangKeluar();
        $barangKeluar = $barangKeluarModel->findAll();
        $supplyModel = new Supply();
        $supply = $supplyModel->findAll();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();

        $data = [
            'title' => 'Tambah Data Barang Keluar',
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluar,
            'jenisBarang' => $jenisBarang
        ];

        return view('toko/tambahBarangKeluar', $data);
    }

    public function storeBK(){
        $barangKeluarModel = new BarangKeluar();
        $supplyModel = new Supply();

        $data = [
            'id_barangKeluar' => $this->request->getPost('id_barangKeluar'),
            'id_supply' => $this->request->getPost('id_supply'),
            'jumlah_barangKeluar' => $this->request->getPost('jumlah_barangKeluar'),
            'tanggal_barangKeluar' => $this->request->getPost('tanggal_barangKeluar'),
        ];

        $existingSupplyData = $supplyModel->find($data['id_supply']);

        if ($existingSupplyData) {
            $newJumlahSupply = $existingSupplyData['jumlah_supply'] - $data['jumlah_barangKeluar'];
            if ($newJumlahSupply < 0) {
                // Jika jumlah_supply kurang dari 0, beri pesan kesalahan
                return redirect()->to('/supply')->with('error', 'Stok enggak cukup nih');
            } elseif ($newJumlahSupply == 0) {
                // Jika jumlah_supply habis, hapus data di tabel Supply
                $supplyModel->delete(['id_supply' => $data['id_supply']]);
            } else {
                // Jika masih ada stok, update jumlah_supply
                $supplyModel->update(['id_supply' => $data['id_supply']], ['jumlah_supply' => $newJumlahSupply]);
            }
        } else {
            echo "Error: Supply data not found";
        }
        
        $barangKeluarModel->save($data);
        return redirect()->to('/detailBarangKeluar');
    }

    public function updateBK($id_barangKeluar){
        $barangKeluarModel = new BarangKeluar();
        $supplyModel = new Supply();

        // Ambil data barang keluar berdasarkan ID
        $barangKeluar = $barangKeluarModel->find($id_barangKeluar);

        // Simpan nilai jumlah_barangKeluar lama untuk menghitung selisih
        $oldJumlahKeluar = $barangKeluar['jumlah_barangKeluar'];

        // Ambil data dari form
        $data = [
            'jumlah_barangKeluar' => $this->request->getPost('jumlah_barangKeluar'),
            'tanggal_barangKeluar' => $this->request->getPost('tanggal_barangKeluar'),
        ];

        // Update data barang keluar
        $barangKeluarModel->update($id_barangKeluar, $data);

        // Hitung selisih jumlah_barangKeluar baru dengan jumlah_barangKeluar lama
        $selisih = $data['jumlah_barangKeluar'] - $oldJumlahKeluar;

        // Ambil data supply berdasarkan ID supply yang terkait
        $supply = $supplyModel->find($barangKeluar['id_supply']);

        // Update jumlah_supply di tabel supply
        $newJumlahSupply = $supply['jumlah_supply'] - $selisih;
        $supplyModel->update($supply['id_supply'], ['jumlah_supply' => $newJumlahSupply]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/detailBarangKeluar');
    }

    public function hapusBK($id_barangKeluar){
        $barangKeluarModel = new BarangKeluar();
        $barangKeluarModel->delete($id_barangKeluar);

        return redirect()->to('/detailBarangKeluar');
    }
}