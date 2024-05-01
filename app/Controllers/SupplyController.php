<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
use App\Models\JenisBarang;
use App\Models\Supply;

class SupplyController extends BaseController{
    public function index(){
        $supplyModel = new Supply();
        $barangKeluarModel = new BarangKeluar();
        $totalBarangKeluar = $barangKeluarModel->getTotalOut();
        //var_dump($totalBarangKeluar);
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();

        $data = [
            'title' => 'Supply',
            'totalSupply' => $supplyModel->getTotalSupply(),
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluarModel->getbarangKeluar(),
            'totalBarangKeluar' => $totalBarangKeluar,
            'jenisBarang' => $jenisBarang,
        ];

        return view('toko/supply', $data);
    }

    public function detail()
    {
        $supplyModel = new Supply();
        $barangKeluarModel = new BarangKeluar();
        $barangKeluar = $barangKeluarModel->getbarangKeluar();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();

        $data = [
            'title' => 'Supply',
            'totalSupply' => $supplyModel->getTotalSupply(),
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluar,
            'jenisBarang' => $jenisBarang,
        ];

        return view('toko/detailBarangMasuk', $data);
    }

    public function tambahS()
    {
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();
        $data = [
            'title' => 'Tambah Data Supply',
            'jenisBarang' => $jenisBarang,
        ];

        return view('toko/tambahSupply', $data);
    }

    public function storeSupply()
    {
        $supplyModel = new Supply();
        $jumlahSupply = $this->request->getPost('jumlah_supply');
        $hargaSupply = $this->request->getPost('harga_supply');

        if (!is_numeric($jumlahSupply)) {
            return redirect()->to('/tambahSupply')->with('error', 'Jumlah Supply harus angka!');
        }
        if (!is_numeric($hargaSupply)) {
            return redirect()->to('/tambahSupply')->with('error', 'Harga Supply harus angka!');
        }
        if ($jumlahSupply <= 0) {
            return redirect()->to('/tambahSupply')->with('error', 'Jumlah Supply harus lebih dari 0!');
        }

        $data = [
            'id_supply' => $this->request->getPost('id_supply'),
            'id_jenisBarang' => $this->request->getPost('id_jenisBarang'),
            'jumlah_supply' => $this->request->getPost('jumlah_supply'),
            'harga_supply' => $this->request->getPost('harga_supply'),
            'tanggal_supply' => date('Y-m-d'),
        ];

        $supplyModel->save($data);
        return redirect()->to('/detailBarangMasuk');
    }


    public function updateSupply($id_supply)
    {
        $supplyModel = new Supply();
        $data = [
            // 'id_supply' => $this->request->getPost('id_supply'),
            'id_jenisBarang' => $this->request->getPost('id_jenisBarang'),
            'jumlah_supply' => $this->request->getPost('jumlah_supply'),
            'harga_supply' => $this->request->getPost('harga_supply'),
            'tanggal_supply' => date('Y-m-d'),
        ];

        $supplyModel->update($id_supply, $data);
        return redirect()->to('/detailBarangMasuk');
    }

    public function hapusSupply($id_supply)
    {
        $supplyModel = new Supply();
        $supplyModel->delete($id_supply);

        return redirect()->to('/detailBarangMasuk');
    }

    public function tambahBarangKeluar()
    {
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
        $id_supply = $this->request->getPost('id_supply');
        $jumlahBarangKeluar = $this->request->getPost('jumlah_barangKeluar');
        // Ambil stok produk
        $supply = $supplyModel->find($id_supply);
        $stok_sekarang = $supply['jumlah_supply'];
        $jumlahBarangKeluar = $this->request->getPost('jumlah_barangKeluar');

        if (!is_numeric($this->request->getPost('jumlah_barangKeluar'))) {
            return redirect()->to('/tambahBarangKeluar')->with('error', 'Jumlah Barang harus angka!');
        }
        if ($jumlahBarangKeluar <= 0) {
            return redirect()->to('/tambahBarangKeluar')->with('error', 'Jumlah Supply harus lebih dari 0!');
        }

        $data = [
            //'id_barangKeluar' => $this->request->getPost('id_barangKeluar'),
            'id_supply' => $this->request->getPost('id_supply'),
            'jumlah_barangKeluar' => $this->request->getPost('jumlah_barangKeluar'),
            'tanggal_barangKeluar' => date('Y-m-d'),
        ];

        if ($stok_sekarang > 0) {
            $data = [
                'id_supply' => $this->request->getPost('id_supply'),
                'jumlah_barangKeluar' => $this->request->getPost('jumlah_barangKeluar'),
                'tanggal_barangKeluar' => date('Y-m-d'),
            ];
            $barangKeluarModel->save($data);
            $id_barangKeluar = $barangKeluarModel->insertID();

            // Kurangi stok produk
            $stok_baru = $stok_sekarang - $jumlahBarangKeluar; // Misalnya, di sini asumsi setiap transaksi hanya mengurangi stok satu unit
            $supplyModel->update($id_supply, ['jumlah_supply' => $stok_baru]);

            // Cek apakah stok habis
            if ($stok_baru <= 0) {
                // Tampilkan notifikasi bahwa produk habis
                // Contoh menggunakan session flash data
                session()->setFlashdata('pesan', 'Produk telah habis.');
            }
        } else {
            // Jika stok habis, kembalikan ke halaman sebelumnya dan tampilkan pesan
            return redirect()->to('/supply')->with('error', 'Stok produk telah habis.');
        }
        return redirect()->to('/supply');
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

    public function updateBK($id_barangKeluar)
    {
        $barangKeluarModel = new BarangKeluar();
        $supplyModel = new Supply();

        // Ambil data barang keluar berdasarkan ID
        $barangKeluar = $barangKeluarModel->find($id_barangKeluar);

        // Simpan nilai jumlah_barangKeluar lama untuk menghitung selisih
        $oldJumlahKeluar = $barangKeluar['jumlah_barangKeluar'];

        // Ambil data dari form
        $data = [
            'jumlah_barangKeluar' => $this->request->getPost('jumlah_barangKeluar'),
            'tanggal_barangKeluar' => date('Y-m-d'),
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

    public function hapusBK($id_barangKeluar)
    {
        $barangKeluarModel = new BarangKeluar();
        $barangKeluarModel->delete($id_barangKeluar);

        return redirect()->to('/detailBarangKeluar');
    }
}
