<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Libraries\MY_TCPDF AS TCPDF;

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
            'sumber' => $this->request->getPost('sumber'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];
        $pemasukanModel->save($data);

        $id_pemasukan = $pemasukanModel->getInsertID();

        $data = [
            'id_keuangan' => $this->request->getPost('id_keuangan'),
            'id_pemasukan' => $id_pemasukan,
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
        $keuanganModel = new Keuangan();

        // Ambil id_keuangan dari tabel keuangan menggunakan id_pemasukan
        $keuanganData = $keuanganModel->where('id_pemasukan', $id_pemasukan)->first();

        // Hapus data di tabel keuangan
        if ($keuanganData) {
            $id_keuangan = $keuanganData['id_keuangan'];
            $keuanganModel->delete($id_keuangan);
        }

        // Hapus data di tabel pemasukan
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
            'keperluan' => $this->request->getPost('keperluan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ];
        $pengeluaranModel->save($data);

        $id_pengeluaran = $pengeluaranModel->getInsertID();

        $data = [
            'id_keuangan' => $this->request->getPost('id_keuangan'),
            'id_pengeluaran' => $id_pengeluaran,
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
        $keuanganModel = new Keuangan();

        // Ambil id_keuangan dari tabel keuangan menggunakan id_pemasukan
        $keuanganData = $keuanganModel->where('id_pengeluaran', $id_pengeluaran)->first();

        // Hapus data di tabel keuangan
        if ($keuanganData) {
            $id_keuangan = $keuanganData['id_keuangan'];
            $keuanganModel->delete($id_keuangan);
        }

        // Hapus data di tabel pengeluaran
        $pengeluaranModel = new Pengeluaran();
        $pengeluaranModel->delete($id_pengeluaran);

        return redirect()->to('/keuangan');
    }

    public function cetak(){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // header data
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add Page
        $pdf->AddPage();

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

        $html = view('toko/laporanKeuangan', $data);

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('laporan-keuangan.pdf', 'I');
    }

}