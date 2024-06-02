<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\myhelper_helper;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Libraries\MY_TCPDF as TCPDF;
use App\Libraries\struk_tcpdf;
use App\Models\detailOrderList;
use App\Models\OrderList;

class TransaksiController extends BaseController
{
    public function index(){
        $transaksiModel = new Transaksi();
        $transaksi = $transaksiModel->getTransaksi();
        $produkModel = new Produk();
        $produk = $produkModel->findAll();
        $orderModel = new OrderList();
        $detailOrder = new detailOrderList();
        $orders = $detailOrder->getOrderedDetailOrders();

        $totalShopeeResult = $orderModel->select('count(order_sn) as totalShopee')->first();
        $totalShopee = !empty($totalShopeeResult) ? $totalShopeeResult['totalShopee'] : 0;
        $totalTokoResult = $transaksiModel->select('count(id_transaksi) as totalToko')->first();
        $totalToko = !empty($totalTokoResult) ? $totalTokoResult['totalToko'] : 0;
        $totalTransaksi = $totalShopee + $totalToko;

        $data = [
            'title' => 'Transaksi',
            'transaksi' => $transaksi,
            'produkList' => $produk,
            'totalToko' => $totalToko,
            'orders' => $orders,
            'totalShopee' => $totalShopee,
            'totalTransaksi' => $totalTransaksi,
        ];
        return view('toko/transaksi', $data);
    }

    public function kasir(){
        $transaksiModel = new Transaksi();
        $transaksi = $transaksiModel->getTransaksi();
        $produkModel = new Produk();
        $produk = $produkModel->findAll();

        $data = [
            'title' => 'Kasir',
            'transaksi' => $transaksi,
            'produkList' => $produk,
        ];
        return view('toko/kasir', $data);
    }

    public function getHarga($id_produk)
    {
        $transaksiModel = new Transaksi();
        $hargaProduk = $transaksiModel->getHargaProduk($id_produk);

        // Mengembalikan data dalam format JSON
        return $this->response->setJSON(['harga_produk' => $hargaProduk]);
    }

    public function storeTransaksi(){
        $transaksiModel = new Transaksi();
        $keuanganModel = new Keuangan();
        $pemasukanModel = new Pemasukan();
        $produkModel = new Produk();


        $id_produk = $this->request->getPost('id_produk');
        $jumlah = $this->request->getPost('jumlah');
        $diskon = (float) $this->request->getPost('diskon');
        $harga_produk = $transaksiModel->getHargaProduk($id_produk);
        $nominal_sebelum_diskon = $harga_produk * $jumlah;
        $nominal_diskon = $nominal_sebelum_diskon * ($diskon / 100);
        $nominal = $nominal_sebelum_diskon - $nominal_diskon;
        $nominal_bayar = $this->request->getPost('nominal_bayar');
        $kembalian = $nominal_bayar - $nominal;

        // Ambil stok produk
        $produk = $produkModel->find($id_produk);
        $stok_sekarang = $produk->jumlah_produk;

        // Pastikan stok masih tersedia sebelum menyimpan transaksi
        if ($stok_sekarang > 0) {
            // Data transaksi
            $data = [
                'id_transaksi' => $this->request->getPost('id_transaksi'),
                'waktu' => date('Y-m-d H:i:s'),
                'metode_bayar' => $this->request->getPost('metode_bayar'),
                'diskon' => $diskon,
                'nominal' => $nominal,
                'id_produk' => $this->request->getPost('id_produk'),
                'jumlah' => $this->request->getPost('jumlah'),
                'nominal_bayar' => $nominal_bayar,
                'kembalian' => $kembalian,
            ];

            // Simpan transaksi
            $transaksiModel->save($data);
            $id_transaksi = $transaksiModel->insertID();

            // Simpan data pemasukan
            $data = [
                'id_pemasukan' => $this->request->getPost('id_pemasukan'),
                'id_transaksi' => $id_transaksi,
                'sumber' => 'Toko',
                'tanggal' => date('Y-m-d'),
                'jumlah' => $nominal,
            ];
            $pemasukanModel->save($data);

            // Simpan data keuangan
            $data = [
                'id_keuangan' => $this->request->getPost('id_keuangan'),
                'id_pemasukan' => $this->request->getPost('id_pemasukan'),
                'id_transaksi' => $id_transaksi,
                'keterangan' => 'Toko',
                'tanggal' => date('Y-m-d'),
                'debit' => $nominal,
            ];
            $keuanganModel->save($data);

            // Kurangi stok produk
            $stok_baru = $stok_sekarang - $jumlah;
            $produkModel->update($id_produk, ['jumlah_produk' => $stok_baru]);

            // Cek apakah stok habis
            if ($stok_baru <= 0) {
                // Tampilkan notifikasi bahwa produk habis
                session()->setFlashdata('pesan', 'Produk telah habis.');
            }
        } else {
            // Jika stok habis, kembalikan ke halaman sebelumnya dan tampilkan pesan
            return redirect()->back()->with('error', 'Stok produk telah habis.');
        }

        return redirect()->to('/transaksi');
    }

    public function updateTransaksi($id_transaksi)
    {
        $transaksiModel = new Transaksi();
        $keuanganModel = new Keuangan();
        $pemasukanModel = new Pemasukan();
        $pemasukanData = $pemasukanModel->where('id_transaksi', $id_transaksi)->first();
        $keuanganData = $keuanganModel->where('id_transaksi', $id_transaksi)->first();

        $id_produk = $this->request->getPost('id_produk');
        $harga_produk = $transaksiModel->getHargaProduk($id_produk);
        $diskon = (float) $this->request->getPost('diskon');
        $nominal = $harga_produk - $diskon;

        $data = [
            'waktu' => date('Y-m-d'),
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'diskon' => $diskon,
            'nominal' => $nominal,
            'id_produk' => $this->request->getPost('id_produk'),
        ];
        $transaksiModel->update($id_transaksi, $data);

        if ($pemasukanData) {
            $id_pemasukan = $pemasukanData['id_pemasukan'];
            $dataPemasukan = [
                'id_pemasukan' => $this->request->getPost('id_pemasukan'),
                'sumber' => 'Toko',
                'tanggal' => date('Y-m-d'),
                'jumlah' => $nominal,
            ];
            $pemasukanModel->update($id_pemasukan, $dataPemasukan);
        }

        if ($keuanganData) {
            $id_keuangan = $keuanganData['id_keuangan'];
            $datakeuangan = [
                'id_keuangan' => $this->request->getPost('id_keuangan'),
                'id_pemasukan' => $this->request->getPost('id_pemasukan'),
                'keterangan' => 'Toko',
                'tanggal' => date('Y-m-d'),
                'debit' => $nominal,
            ];
            $keuanganModel->update($id_keuangan, $datakeuangan);
        }
        return redirect()->to('/transaksi');
    }

    public function hapusTransaksi($id_transaksi)
    {
        $keuanganModel = new Keuangan();
        $pemasukanModel = new Pemasukan();
        $pemasukanData = $pemasukanModel->where('id_transaksi', $id_transaksi)->first();
        $keuanganData = $keuanganModel->where('id_transaksi', $id_transaksi)->first();

        if ($keuanganData) {
            $id_keuangan = $keuanganData['id_keuangan'];
            $keuanganModel->where('id_keuangan', $id_keuangan)->delete();
        }
        if ($pemasukanData) {
            $id_pemasukan = $pemasukanData['id_pemasukan'];
            $pemasukanModel->where('id_pemasukan', $id_pemasukan)->delete();
        }
        $transaksiModel = new Transaksi();
        $transaksiModel->where('id_transaksi', $id_transaksi)->delete();

        return redirect()->to('/transaksi');
    }

    public function cetakStruk($id_transaksi){
        $pdf = new struk_tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 8, '', true);
        $pdf->AddPage();

        $transaksiModel = new Transaksi();
        $transaksi = $transaksiModel->find($id_transaksi);
        $produkModel = new Produk();
        $produk = $produkModel->where('id_produk', $transaksi['id_produk'])->findAll();

        $data = [
            'title' => 'Transaksi',
            'transaksi' => $transaksi,
            'produkList' => $produk,
        ];
        $html = view('toko/cetakStruk', $data);


        $pdf->setHeaderData('', 0, 'Struk Pembelian', 'Tanggal: ' . date('Y-m-d H:i:s'));
        $pdf->setFooterData(['0', '', ''], [0, '', '']);
        $pdf->setY(43);
        $pdf->setX(1);
        $pdf->setMargins(1, 0, 1);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $this->response->setContentType('application/pdf');
        $pdf->Output('struk_pembelian.pdf', 'I');
    }

    public function cetakToko()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 14, '', true);
        $pdf->AddPage();

        $transaksiModel = new Transaksi();
        $produkModel = new Produk();
        $produk = $produkModel->findAll();

        $data = [
            'title' => 'Transaksi',
            'transaksi' => $transaksiModel->getTransaksi(),
            'produkList' => $produk,
        ];
        $html = view('toko/laporanToko', $data);

        $pdf->setHeaderData('', 0, 'Laporan Toko', 'Tanggal: ' . date('Y-m-d'));
        $pdf->setFooterData(['0', '', ''], [0, '', '']);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan-Toko.pdf', 'I');
    }

}
