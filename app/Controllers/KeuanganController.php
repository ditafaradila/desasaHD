<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class KeuanganController extends BaseController{
    public function index(){
        $pemasukanModel = new Pemasukan();
        $pengeluaranModel = new Pengeluaran();

        $data = [
            'title' => 'Keuangan',
            'pemasukan' => $pemasukanModel->getPemasukan(),
            'pengeluaran' => $pengeluaranModel->getPengeluaran(),
        ];
        
        return view('toko/keuangan', $data);
    }

    public function indexx(){
        $keuanganModel = new Keuangan();
        $totalDebitResult = $keuanganModel->select('SUM(debit) as totalDebit')->first();
        $totalKreditResult = $keuanganModel->select('SUM(kredit) as totalKredit')->first();
        
        $totalDebit = $totalDebitResult['totalDebit'];
        $totalKredit = $totalKreditResult['totalKredit'];

        $totalUang = $totalDebit - $totalKredit;

        $data = [
            'title' => 'Keuangan',
            'keuangan' => $keuanganModel->getkeuangan(),
            'totalDebit' =>$totalDebit,
            'totalKredit' =>$totalKredit,
            'totalUang' =>$totalUang
        ];
        
        return view('toko/listKeuangan', $data);
    }

    public function tambahK(){
        $data = [
            'title' => 'Tambah Data Keuangan',
        ];

        return view('toko/tambahPemasukan', $data);
    }

    public function storeK(){
        $pemasukanModel = new Pemasukan();
        $keuanganModel = new Keuangan();

        $data = [
            'id_pemasukan' => $this->request->getPost('id_pemasukan'),
            'sumber' => $this->request->getPost('sumber'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];
        $pemasukanModel->save($data);

        $data = [
            'id_keuangan' => $this->request->getPost('id_keuangan'),
            'keterangan' => $this->request->getPost('sumber'),
            'tanggal' => $this->request->getPost('tanggal'),
            'debit' => $this->request->getPost('jumlah'),
        ];
        $keuanganModel->save($data);
        return redirect()->to('/keuangan');
    }

    public function editPemasukan($id_pemasukan){
        $pemasukanModel = new Pemasukan();
        $pemasukan = $pemasukanModel->find($id_pemasukan);

        $data = [
            'title' => 'Edit Data Pemasukan',
            'pemasukan' => $pemasukan,
        ];

        return view('toko/editPemasukan', $data);
    }

    public function updatePemasukan($id_pemasukan){
        $pemasukanModel = new Pemasukan();
        $data = [
            // 'id_pemasukan' => $this->request->getPost('id_pemasukan'),
            'sumber' => $this->request->getPost('sumber'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        $pemasukanModel->update($id_pemasukan, $data);
        return redirect()->to('/keuangan');    
    }

    public function hapusPemasukan($id_pemasukan){
        $pemasukanModel = new Pemasukan();
        $pemasukanModel->delete($id_pemasukan);

        return redirect()->to('/keuangan');
    }

    public function tambahPengeluaran(){
        $data = [
            'title' => 'Tambah Data Pengeluaran',
        ];

        return view('toko/tambahPengeluaran', $data);
    }

    public function storePengeluaran(){
        $pengeluaranModel = new Pengeluaran();
        $keuanganModel = new Keuangan();
        $data = [
            'id_pengeluaran' => $this->request->getPost('id_pengeluaran'),
            'keperluan' => $this->request->getPost('keperluan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ];
        $pengeluaranModel->save($data);

        $data = [
            'id_keuangan' => $this->request->getPost('id_keuangan'),
            'keterangan' => $this->request->getPost('keperluan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kredit' => $this->request->getPost('nominal'),
        ];
        $keuanganModel->save($data);
        return redirect()->to('/keuangan');
    }

    public function editPengeluaran($id_pengeluaran){
        $pengeluaranModel = new Pengeluaran();
        $pengeluaran = $pengeluaranModel->find($id_pengeluaran);

        $data = [
            'title' => 'Edit Data Pengeluaran',
            'pengeluaran' => $pengeluaran,
        ];

        return view('toko/editPengeluaran', $data);
    }

    public function updatePengeluaran($id_pengeluaran){
        $pengeluaranModel = new Pengeluaran();
        $data = [
            'keperluan' => $this->request->getPost('keperluan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ];

        $pengeluaranModel->update($id_pengeluaran, $data);
        return redirect()->to('/keuangan');    
    }

    public function hapusPengeluaran($id_pengeluaran){
        $pengeluaranModel = new Pengeluaran();
        $pengeluaranModel->delete($id_pengeluaran);

        return redirect()->to('/keuangan');
    }

}