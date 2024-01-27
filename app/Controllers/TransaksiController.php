<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Produk;
use App\Models\Transaksi;

class TransaksiController extends BaseController{
    public function index(){
        $transaksiModel = new Transaksi();
        $produkModel = new Produk();
        $produk = $produkModel->findAll();

        $totalTokoResult = $transaksiModel->select('count(id_transaksi) as totalToko')->first();
        $totalToko = !empty($totalTokoResult) ? $totalTokoResult['totalToko'] : 0;

        $data = [
            'title' => 'Transaksi',
            'transaksi' => $transaksiModel->getTransaksi(),
            'produkList' => $produk,
            'totalToko' =>$totalToko,
        ];
        return view('toko/transaksi', $data);
    }

    public function getHarga($id)
    {
        $transaksiModel = new Transaksi();
        $hargaProduk = $transaksiModel->getHargaProduk($id);

        // Mengembalikan data dalam format JSON
        return $this->response->setJSON(['harga_produk' => $hargaProduk]);
    }

    public function storeTransaksi(){
        $transaksiModel = new Transaksi();
        $keuanganModel = new Keuangan();
        $pemasukanModel = new Pemasukan();

        $id_produk = $this->request->getPost('id_produk');
        $harga_produk = $transaksiModel->getHargaProduk($id_produk);
        $diskon = (float) $this->request->getPost('diskon');        
        $nominal = $harga_produk - $diskon;
        
        $data = [
            'id_transaksi' => $this->request->getPost('id_transaksi'),
            'waktu' => $this->request->getPost('waktu'),
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'diskon' => $diskon,
            'nominal' => $nominal,
            'id_produk' => $this->request->getPost('id_produk'),
        ];
        $transaksiModel->save($data);


        $data = [
            'id_pemasukan' => $this->request->getPost('id_pemasukan'),
            'sumber' => 'Toko',
            'tanggal' => $this->request->getPost('waktu'),
            'jumlah' => $nominal,
        ];
        $pemasukanModel->save($data);

        $data = [
            'id_keuangan' => $this->request->getPost('id_keuangan'),
            'id_pemasukan' => $this->request->getPost('id_pemasukan'),
            'keterangan' => 'Toko',
            'tanggal' => $this->request->getPost('waktu'),
            'debit' => $nominal,
        ];
        $keuanganModel->save($data);

        return redirect()->to('/transaksi');
    }
}