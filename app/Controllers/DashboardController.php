<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\detailItemModel;
use App\Models\detailOrderList;
use App\Models\ItemModel;
use App\Models\Transaksi;
use App\Models\OrderList;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class DashboardController extends BaseController{
    public function dashboard(){
        $nama = session()->get('nama');
        $transaksiModel = new Transaksi();
        $orderModel = new OrderList();
        $itemModel = new detailItemModel();
        $pemasukanModel = new Pemasukan();
        $pengeluaranModel = new Pengeluaran();
        $top3Products = $transaksiModel->getTop3PenjualanProduk();
        $top3Shopee = $itemModel->getTop3PenjualanShopee();

        $totalShopeeResult = $orderModel->select('count(order_sn) as totalShopee')->first();
        $totalShopee = !empty($totalShopeeResult) ? $totalShopeeResult['totalShopee'] : 0;
        $totalTokoResult = $transaksiModel->select('count(id_transaksi) as totalToko')->first();
        $totalToko = !empty($totalTokoResult) ? $totalTokoResult['totalToko'] : 0;
        $totalTransaksi = $totalShopee + $totalToko;

        $transaksiJanuariResult = $pemasukanModel->where('tanggal>="2024-01-01"')
                                            ->where('tanggal<="2024-01-31"')
                                            ->select('count(id_pemasukan) as transaksiJanuari')
                                            ->first();
        $transaksiJanuari = !empty($transaksiJanuariResult) ? $transaksiJanuariResult['transaksiJanuari'] : 0;
        $transaksiFebruariResult = $pemasukanModel->where('tanggal>="2024-02-01"')
                                            ->where('tanggal<="2024-02-31"')
                                            ->select('count(id_pemasukan) as transaksiFebruari')
                                            ->first();
        $transaksiFebruari = !empty($transaksiFebruariResult) ? $transaksiFebruariResult['transaksiFebruari'] : 0;
        $transaksiMaretResult = $pemasukanModel->where('tanggal>="2024-03-01"')
                                            ->where('tanggal<="2024-03-31"')
                                            ->select('count(id_pemasukan) as transaksiMaret')
                                            ->first();
        $transaksiMaret = !empty($transaksiMaretResult) ? $transaksiMaretResult['transaksiMaret'] : 0;
        $transaksiAprilResult = $pemasukanModel->where('tanggal>="2024-04-01"')
                                            ->where('tanggal<="2024-04-31"')
                                            ->select('count(id_pemasukan) as transaksiApril')
                                            ->first();
        $transaksiApril = !empty($transaksiAprilResult) ? $transaksiAprilResult['transaksiApril'] : 0;
        $transaksiMeiResult = $pemasukanModel->where('tanggal>="2024-05-01"')
                                            ->where('tanggal<="2024-05-30"')
                                            ->select('count(id_pemasukan) as transaksiMei')
                                            ->first();
        $transaksiMei = !empty($transaksiMeiResult) ? $transaksiMeiResult['transaksiMei'] : 0;
        $transaksiJuniResult = $pemasukanModel->where('tanggal>="2024-06-01"')
                                            ->where('tanggal<="2024-06-30"')
                                            ->select('count(id_pemasukan) as transaksiJuni')
                                            ->first();
        $transaksiJuni = !empty($transaksiJuniResult) ? $transaksiJuniResult['transaksiJuni'] : 0;
        $transaksiJuliResult = $pemasukanModel->where('tanggal>="2024-07-01"')
                                            ->where('tanggal<="2024-07-30"')
                                            ->select('count(id_pemasukan) as transaksiJuli')
                                            ->first();
        $transaksiJuli = !empty($transaksiJuliResult) ? $transaksiJuliResult['transaksiJuli'] : 0;
        $transaksiAgustusResult = $pemasukanModel->where('tanggal>="2024-08-01"')
                                            ->where('tanggal<="2024-08-30"')
                                            ->select('count(id_pemasukan) as transaksiAgustus')
                                            ->first();
        $transaksiAgustus = !empty($transaksiAgustusResult) ? $transaksiAgustusResult['transaksiAgustus'] : 0;
        $transaksiSeptemberResult = $pemasukanModel->where('tanggal>="2024-09-01"')
                                            ->where('tanggal<="2024-09-30"')
                                            ->select('count(id_pemasukan) as transaksiSeptember')
                                            ->first();
        $transaksiSeptember = !empty($transaksiSeptemberResult) ? $transaksiSeptemberResult['transaksiSeptember'] : 0;
        $transaksiOktoberResult = $pemasukanModel->where('tanggal>="2024-10-01"')
                                            ->where('tanggal<="2024-10-30"')
                                            ->select('count(id_pemasukan) as transaksiOktober')
                                            ->first();
        $transaksiOktober = !empty($transaksiOktoberResult) ? $transaksiOktoberResult['transaksiOktober'] : 0;
        $transaksiNovemberResult = $pemasukanModel->where('tanggal>="2024-11-01"')
                                            ->where('tanggal<="2024-11-30"')
                                            ->select('count(id_pemasukan) as transaksiNovember')
                                            ->first();
        $transaksiNovember = !empty($transaksiNovemberResult) ? $transaksiNovemberResult['transaksiNovember'] : 0;
        $transaksiDesemberResult = $pemasukanModel->where('tanggal>="2024-12-01"')
                                            ->where('tanggal<="2024-12-30"')
                                            ->select('count(id_pemasukan) as transaksiDesember')
                                            ->first();
        $transaksiDesember = !empty($transaksiDesemberResult) ? $transaksiDesemberResult['transaksiDesember'] : 0;

        $totalPemasukanResult = $pemasukanModel->select('sum(jumlah) as totalPemasukan')->first();
        $totalPemasukan = !empty($totalPemasukanResult) ? $totalPemasukanResult['totalPemasukan'] : 0;
        $totalJanuariResult = $pemasukanModel->where('tanggal>="2024-01-01"')
                                   ->where('tanggal<="2024-01-31"')
                                   ->select('SUM(jumlah) as totalJanuari')
                                   ->first();
        $totalJanuari = !empty($totalJanuariResult) ? $totalJanuariResult['totalJanuari'] : 0;
        $totalFebruariResult = $pemasukanModel->where('tanggal>="2024-02-01"')
                                   ->where('tanggal<="2024-02-31"')
                                   ->select('SUM(jumlah) as totalFebruari')
                                   ->first();
        $totalFebruari = !empty($totalFebruariResult) ? $totalFebruariResult['totalFebruari'] : 0;
        $totalMaretResult = $pemasukanModel->where('tanggal>="2024-03-01"')
                                   ->where('tanggal<="2024-03-31"')
                                   ->select('SUM(jumlah) as totalMaret')
                                   ->first();
        $totalMaret = !empty($totalMaretResult) ? $totalMaretResult['totalMaret'] : 0;
        $totalAprilResult = $pemasukanModel->where('tanggal>="2024-04-01"')
                                   ->where('tanggal<="2024-04-31"')
                                   ->select('SUM(jumlah) as totalApril')
                                   ->first();
        $totalApril = !empty($totalAprilResult) ? $totalAprilResult['totalApril'] : 0;
        $totalMeiResult = $pemasukanModel->where('tanggal>="2024-05-01"')
                                   ->where('tanggal<="2024-05-31"')
                                   ->select('SUM(jumlah) as totalMei')
                                   ->first();
        $totalMei = !empty($totalMeiResult) ? $totalMeiResult['totalMei'] : 0;
        $totalJuniResult = $pemasukanModel->where('tanggal>="2024-06-01"')
                                   ->where('tanggal<="2024-06-31"')
                                   ->select('SUM(jumlah) as totalJuni')
                                   ->first();
        $totalJuni = !empty($totalJuniResult) ? $totalJuniResult['totalJuni'] : 0;
        $totalJuliResult = $pemasukanModel->where('tanggal>="2024-07-01"')
                                   ->where('tanggal<="2024-07-31"')
                                   ->select('SUM(jumlah) as totalJuli')
                                   ->first();
        $totalJuli = !empty($totalJuliResult) ? $totalJuliResult['totalJuli'] : 0;
        $totalAgustusResult = $pemasukanModel->where('tanggal>="2024-08-01"')
                                   ->where('tanggal<="2024-08-31"')
                                   ->select('SUM(jumlah) as totalAgustus')
                                   ->first();
        $totalAgustus = !empty($totalAgustusResult) ? $totalAgustusResult['totalAgustus'] : 0;
        $totalSeptemberResult = $pemasukanModel->where('tanggal>="2024-09-01"')
                                   ->where('tanggal<="2024-09-31"')
                                   ->select('SUM(jumlah) as totalSeptember')
                                   ->first();
        $totalSeptember = !empty($totalSeptemberResult) ? $totalSeptemberResult['totalSeptember'] : 0;
        $totalOktoberResult = $pemasukanModel->where('tanggal>="2024-10-01"')
                                   ->where('tanggal<="2024-10-31"')
                                   ->select('SUM(jumlah) as totalOktober')
                                   ->first();
        $totalOktober = !empty($totalOktoberResult) ? $totalOktoberResult['totalOktober'] : 0;
        $totalNovemberResult = $pemasukanModel->where('tanggal>="2024-11-01"')
                                   ->where('tanggal<="2024-11-31"')
                                   ->select('SUM(jumlah) as totalNovember')
                                   ->first();
        $totalNovember = !empty($totalNovemberResult) ? $totalNovemberResult['totalNovember'] : 0;
        $totalDesemberResult = $pemasukanModel->where('tanggal>="2024-12-01"')
                                   ->where('tanggal<="2024-12-31"')
                                   ->select('SUM(jumlah) as totalDesember')
                                   ->first();
        $totalDesember = !empty($totalDesemberResult) ? $totalDesemberResult['totalDesember'] : 0;

        $totalOutJanuari = $pengeluaranModel->where('tanggal>="2024-01-01"')
                                                    ->where('tanggal<="2024-01-31"')
                                                    ->select('sum(nominal) as totalPengeluaranJanuari')
                                                    ->first();
        $totalPengeluaranJanuari = !empty($totalOutJanuari) ? $totalOutJanuari['totalPengeluaranJanuari'] : 0;
        $totalOutFebruari = $pengeluaranModel->where('tanggal>="2024-02-01"')
                                                    ->where('tanggal<="2024-02-31"')
                                                    ->select('sum(nominal) as totalPengeluaranFebruari')
                                                    ->first();
        $totalPengeluaranFebruari = !empty($totalOutFebruari) ? $totalOutFebruari['totalPengeluaranFebruari'] : 0;
        $totalOutMaret = $pengeluaranModel->where('tanggal>="2024-03-01"')
                                                    ->where('tanggal<="2024-03-31"')
                                                    ->select('sum(nominal) as totalPengeluaranMaret')
                                                    ->first();
        $totalPengeluaranMaret = !empty($totalOutMaret) ? $totalOutMaret['totalPengeluaranMaret'] : 0;
        $totalOutApril = $pengeluaranModel->where('tanggal>="2024-04-01"')
                                                    ->where('tanggal<="2024-04-31"')
                                                    ->select('sum(nominal) as totalPengeluaranApril')
                                                    ->first();
        $totalPengeluaranApril = !empty($totalOutApril) ? $totalOutApril['totalPengeluaranApril'] : 0;
        $totalOutMei = $pengeluaranModel->where('tanggal>="2024-05-01"')
                                                    ->where('tanggal<="2024-05-31"')
                                                    ->select('sum(nominal) as totalPengeluaranMei')
                                                    ->first();
        $totalPengeluaranMei = !empty($totalOutMei) ? $totalOutMei['totalPengeluaranMei'] : 0;
        $totalOutJuni = $pengeluaranModel->where('tanggal>="2024-06-01"')
                                                    ->where('tanggal<="2024-06-31"')
                                                    ->select('sum(nominal) as totalPengeluaranJuni')
                                                    ->first();
        $totalPengeluaranJuni = !empty($totalOutJuni) ? $totalOutJuni['totalPengeluaranJuni'] : 0;
        $totalOutJuli = $pengeluaranModel->where('tanggal>="2024-07-01"')
                                                    ->where('tanggal<="2024-07-31"')
                                                    ->select('sum(nominal) as totalPengeluaranJuli')
                                                    ->first();
        $totalPengeluaranJuli = !empty($totalOutJuli) ? $totalOutJuli['totalPengeluaranJuli'] : 0;
        $totalOutAgustus = $pengeluaranModel->where('tanggal>="2024-08-01"')
                                                    ->where('tanggal<="2024-08-31"')
                                                    ->select('sum(nominal) as totalPengeluaranAgustus')
                                                    ->first();
        $totalPengeluaranAgustus = !empty($totalOutAgustus) ? $totalOutAgustus['totalPengeluaranAgustus'] : 0;
        $totalOutSeptember = $pengeluaranModel->where('tanggal>="2024-09-01"')
                                                    ->where('tanggal<="2024-09-31"')
                                                    ->select('sum(nominal) as totalPengeluaranSeptember')
                                                    ->first();
        $totalPengeluaranSeptember = !empty($totalOutSeptember) ? $totalOutSeptember['totalPengeluaranSeptember'] : 0;
        $totalOutOktober = $pengeluaranModel->where('tanggal>="2024-10-01"')
                                                    ->where('tanggal<="2024-10-31"')
                                                    ->select('sum(nominal) as totalPengeluaranOktober')
                                                    ->first();
        $totalPengeluaranOktober = !empty($totalOutOktober) ? $totalOutOktober['totalPengeluaranOktober'] : 0;
        $totalOutNovember = $pengeluaranModel->where('tanggal>="2024-11-01"')
                                                    ->where('tanggal<="2024-11-31"')
                                                    ->select('sum(nominal) as totalPengeluaranNovember')
                                                    ->first();
        $totalPengeluaranNovember = !empty($totalOutNovember) ? $totalOutNovember['totalPengeluaranNovember'] : 0;
        $totalOutDesember = $pengeluaranModel->where('tanggal>="2024-12-01"')
                                                    ->where('tanggal<="2024-12-31"')
                                                    ->select('sum(nominal) as totalPengeluaranDesember')
                                                    ->first();
        $totalPengeluaranDesember = !empty($totalOutDesember) ? $totalOutDesember['totalPengeluaranDesember'] : 0;
        
        $data = [
            'title' => 'Dashboard',
            $nama => 'nama',
            'totalToko' => $totalToko,
            'totalShopee' => $totalShopee,
            'totalTransaksi' => $totalTransaksi,
            'totalPemasukan' => $totalPemasukan,
            'top3Products' => $top3Products,
            'top3Shopee' => $top3Shopee,
            'transaksiJanuari' => $transaksiJanuari,
            'transaksiFebruari' => $transaksiFebruari,
            'transaksiMaret' => $transaksiMaret,
            'transaksiApril' => $transaksiApril,
            'transaksiMei' => $transaksiMei,
            'transaksiJuni' => $transaksiJuni,
            'transaksiJuli' => $transaksiJuli,
            'transaksiAgustus' => $transaksiAgustus,
            'transaksiSeptember' => $transaksiSeptember,
            'transaksiOktober' => $transaksiOktober,
            'transaksiNovember' => $transaksiNovember,
            'transaksiDesember' => $transaksiDesember,
            'totalJanuari' => $totalJanuari,
            'totalFebruari' => $totalFebruari,
            'totalMaret' => $totalMaret,
            'totalApril' => $totalApril,
            'totalMei' => $totalMei,
            'totalJuni' => $totalJuni,
            'totalJuli' => $totalJuli,
            'totalAgustus' => $totalAgustus,
            'totalSeptember' => $totalSeptember,
            'totalOktober' => $totalOktober,
            'totalNovember' => $totalNovember,
            'totalDesember' => $totalDesember,
            'totalPengeluaranJanuari' => $totalPengeluaranJanuari,
            'totalPengeluaranFebruari' => $totalPengeluaranFebruari,
            'totalPengeluaranMaret' => $totalPengeluaranMaret,
            'totalPengeluaranApril' => $totalPengeluaranApril,
            'totalPengeluaranMei' => $totalPengeluaranMei,
            'totalPengeluaranJuni' => $totalPengeluaranJuni,
            'totalPengeluaranJuli' => $totalPengeluaranJuli,
            'totalPengeluaranAgustus' => $totalPengeluaranAgustus,
            'totalPengeluaranSeptember' => $totalPengeluaranSeptember,
            'totalPengeluaranOktober' => $totalPengeluaranOktober,
            'totalPengeluaranNovember' => $totalPengeluaranNovember,
            'totalPengeluaranDesember' => $totalPengeluaranDesember,
        ];

        return view('toko/dashboard', $data);
    }
}