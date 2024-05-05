<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
use App\Models\JenisBarang;
use App\Models\Pengeluaran;
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

    public function detail($id_jenisBarang){
        $supplyModel = new Supply();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();
    
        $data = [
            'title' => 'Supply',
            'supply' => $supplyModel->getDetailbyID($id_jenisBarang),
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
        $pengeluaranModel = new Pengeluaran();
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

        $dataPengeluaran = [
            'keperluan' => "Pembelian Bahan Baku",
            'tanggal' => date('Y-m-d'),
            'nominal' => $this->request->getPost('harga_supply'),
        ];
        $pengeluaranModel->save($dataPengeluaran);
        return redirect()->to('/supply');
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
        return redirect()->to('/supply');
    }

    public function hapusSupply($id_supply)
    {
        $supplyModel = new Supply();
        $supplyModel->delete($id_supply);

        return redirect()->to('/supply');
    }

    public function tambahBarangKeluar(){
        $barangKeluarModel = new BarangKeluar();
        $barangKeluar = $barangKeluarModel->findAll();
        $supplyModel = new Supply();
        $supply = $supplyModel->getSupply();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();

        $data = [
            'title' => 'Tambah Data Barang Keluar',
            'supply' => $supply,
            'barangKeluar' => $barangKeluar,
            'jenisBarang' => $jenisBarang
        ];

        return view('toko/tambahBarangKeluar', $data);
    }

    public function storeBK(){
        $barangKeluarModel = new BarangKeluar();
        $supplyModel = new Supply();
        
        // Memproses setiap pasokan
        foreach ($this->request->getPost() as $key => $value) {
            // Periksa apakah input merupakan input untuk stok pasokan
            if (strpos($key, 'stok_') === 0) {
                $id_supply = str_replace('stok_', '', $key); // Mendapatkan id_supply dari nama input
                $jumlahBarangKeluar = $value;
    
                // Validasi jumlah barang keluar
                if (!is_numeric($jumlahBarangKeluar) || $jumlahBarangKeluar <= 0) {
                    return redirect()->to('/tambahBarangKeluar')->with('error', 'Jumlah Barang harus angka dan lebih dari 0!');
                }
    
                // Ambil stok pasokan
                $supply = $supplyModel->find($id_supply);
                $stok_sekarang = $supply['jumlah_supply'];
    
                // Periksa apakah stok mencukupi
                if ($stok_sekarang >= $jumlahBarangKeluar) {
                    // Kurangi stok pasokan
                    $stok_baru = $stok_sekarang - $jumlahBarangKeluar;
                    $supplyModel->update($id_supply, ['jumlah_supply' => $stok_baru]);
    
                    $data = [
                        'id_supply' => $id_supply,
                        'jumlah_barangKeluar' => $jumlahBarangKeluar,
                        'tanggal_barangKeluar' => date('Y-m-d'),
                    ];
                    $barangKeluarModel->save($data);
    
                    // Cek apakah stok habis
                    if ($stok_baru <= 0) {
                        // Tampilkan notifikasi bahwa pasokan habis
                        session()->setFlashdata('pesan', 'Pasokan telah habis.');
                    }
                } else {
                    // Jika stok tidak mencukupi, kembalikan pesan kesalahan
                    return redirect()->to('/supply')->with('error', 'Stok pasokan tidak mencukupi.');
                }
            }
        }
    
        return redirect()->to('/supply');
    }
    

    public function detailBarangKeluar($id_jenisBarang){
        $supplyModel = new Supply();
        $barangKeluarModel = new BarangKeluar();
        $jenisModel = new JenisBarang();
        $jenisBarang = $jenisModel->findAll();

        $data = [
            'title' => 'Supply',
            'supply' => $supplyModel->getSupply(),
            'barangKeluar' => $barangKeluarModel->getDetailBKID($id_jenisBarang),
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
        return redirect()->to('/supply');
    }

    public function hapusBK($id_barangKeluar)
    {
        $barangKeluarModel = new BarangKeluar();
        $barangKeluarModel->delete($id_barangKeluar);

        return redirect()->to('/supply');
    }
}
