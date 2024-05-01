<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\myhelper_helper;
use App\Models\Keuangan;
use App\Models\Pemasukan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Libraries\MY_TCPDF as TCPDF;
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
        //$order = $orderModel->findAll();
        $detailOrder = new detailOrderList();
        //$orders = $detailOrder->findAll();

        // Ambil data dengan sistem penomoran halaman
        $orders = $detailOrder->paginate(5, 'orders');
        $pager = $detailOrder->pager;

        $totalShopeeResult = $orderModel->select('count(order_sn) as totalShopee')->first();
        $totalShopee = !empty($totalShopeeResult) ? $totalShopeeResult['totalShopee'] : 0;
        $totalTokoResult = $transaksiModel->select('count(id_transaksi) as totalToko')->first();
        $totalToko = !empty($totalTokoResult) ? $totalTokoResult['totalToko'] : 0;
        $totalTransaksi = $totalShopee + $totalToko;

        // Hitung nomor urut untuk setiap entri pada halaman saat ini
        $currentPage = $pager->getCurrentPage();
        $dataPerPage = 5;
        $startingNumber = ($currentPage - 1) * $dataPerPage + 1;

        $data = [
            'title' => 'Transaksi',
            'transaksi' => $transaksi,
            'produkList' => $produk,
            'totalToko' => $totalToko,
            'orders' => $orders,
            'pager' => $pager,
            'totalShopee' => $totalShopee,
            'totalTransaksi' => $totalTransaksi,
            'startingNumber' => $startingNumber
        ];
        return view('toko/transaksi', $data);
    }

    public function getHarga($id_produk)
    {
        $transaksiModel = new Transaksi();
        $hargaProduk = $transaksiModel->getHargaProduk($id_produk);

        // Mengembalikan data dalam format JSON
        return $this->response->setJSON(['harga_produk' => $hargaProduk]);
    }

    public function storeTransaksi()
    {
        $transaksiModel = new Transaksi();
        $keuanganModel = new Keuangan();
        $pemasukanModel = new Pemasukan();
        $produkModel = new Produk();


        $id_produk = $this->request->getPost('id_produk');
        $harga_produk = $transaksiModel->getHargaProduk($id_produk);
        $diskon = (float) $this->request->getPost('diskon');
        $nominal = $harga_produk - $diskon;

        // Ambil stok produk
        $produk = $produkModel->find($id_produk);
        $stok_sekarang = $produk->jumlah_produk;

        // Pastikan stok masih tersedia sebelum menyimpan transaksi
        if ($stok_sekarang > 0) {
            // Data transaksi
            $data = [
                'id_transaksi' => $this->request->getPost('id_transaksi'),
                'waktu' => date('Y-m-d'),
                'metode_bayar' => $this->request->getPost('metode_bayar'),
                'diskon' => $diskon,
                'nominal' => $nominal,
                'id_produk' => $this->request->getPost('id_produk'),
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
            $stok_baru = $stok_sekarang - 1;
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

    public function getOrders()
    {
        $client = \Config\Services::curlrequest();

        // Ganti URL sesuai dengan API yang ingin Anda akses
        $url = 'https://fake-store-api.mock.beeceptor.com/api/orders';

        // Lakukan permintaan GET ke API
        $response = $client->get($url);

        // Periksa apakah permintaan berhasil
        if ($response->getStatusCode() == 200) {
            // Proses data JSON yang diterima
            $data['orders'] = json_decode($response->getBody(), true);

            // Tampilkan data ke view atau lakukan operasi lainnya
            return view('api_result', $data);
        } else {
            // Tampilkan pesan kesalahan jika permintaan tidak berhasil
            return 'Error: ' . $response->getStatusCode();
        }
    }
}
