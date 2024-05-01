<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\detailOrderList;
use App\Models\Transaksi;
use App\Models\OrderList;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class DashboardController extends BaseController{
    public function dashboard(){
        $nama = session()->get('nama');
        $transaksiModel = new Transaksi();
        $transaksi = $transaksiModel->getTransaksi();
        $orderModel = new OrderList();
        $pemasukanModel = new Pemasukan();
        $pengeluaranModel = new Pengeluaran();

        $totalShopeeResult = $orderModel->select('count(order_sn) as totalShopee')->first();
        $totalShopee = !empty($totalShopeeResult) ? $totalShopeeResult['totalShopee'] : 0;
        $totalTokoResult = $transaksiModel->select('count(id_transaksi) as totalToko')->first();
        $totalToko = !empty($totalTokoResult) ? $totalTokoResult['totalToko'] : 0;
        $totalTransaksi = $totalShopee + $totalToko;
                
        $totalPemasukanResult = $pemasukanModel->select('sum(jumlah) as totalPemasukan')->first();
        $totalPemasukan = !empty($totalPemasukanResult) ? $totalPemasukanResult['totalPemasukan'] : 0;
        $totalJanuariResult = $pemasukanModel->where('tanggal>="2024-01-01"')
                                   ->where('tanggal<="2024-01-30"')
                                   ->select('SUM(jumlah) as totalJanuari')
                                   ->first();
        $totalJanuari = !empty($totalJanuariResult) ? $totalJanuariResult['totalJanuari'] : 0;
        $totalFebruariResult = $pemasukanModel->where('tanggal>="2024-02-01"')
                                   ->where('tanggal<="2024-02-30"')
                                   ->select('SUM(jumlah) as totalFebruari')
                                   ->first();
        $totalFebruari = !empty($totalFebruariResult) ? $totalFebruariResult['totalFebruari'] : 0;
        $totalMaretResult = $pemasukanModel->where('tanggal>="2024-03-01"')
                                   ->where('tanggal<="2024-03-30"')
                                   ->select('SUM(jumlah) as totalMaret')
                                   ->first();
        $totalMaret = !empty($totalMaretResult) ? $totalMaretResult['totalMaret'] : 0;
        $totalAprilResult = $pemasukanModel->where('tanggal>="2024-04-01"')
                                   ->where('tanggal<="2024-04-30"')
                                   ->select('SUM(jumlah) as totalApril')
                                   ->first();
        $totalApril = !empty($totalAprilResult) ? $totalAprilResult['totalApril'] : 0;
        $totalMeiResult = $pemasukanModel->where('tanggal>="2024-05-01"')
                                   ->where('tanggal<="2024-05-30"')
                                   ->select('SUM(jumlah) as totalMei')
                                   ->first();
        $totalMei = !empty($totalMeiResult) ? $totalMeiResult['totalMei'] : 0;
        $totalJuniResult = $pemasukanModel->where('tanggal>="2024-06-01"')
                                   ->where('tanggal<="2024-06-30"')
                                   ->select('SUM(jumlah) as totalJuni')
                                   ->first();
        $totalJuni = !empty($totalJuniResult) ? $totalJuniResult['totalJuni'] : 0;
        $totalJuliResult = $pemasukanModel->where('tanggal>="2024-07-01"')
                                   ->where('tanggal<="2024-07-30"')
                                   ->select('SUM(jumlah) as totalJuli')
                                   ->first();
        $totalJuli = !empty($totalJuliResult) ? $totalJuliResult['totalJuli'] : 0;
        $totalAgustusResult = $pemasukanModel->where('tanggal>="2024-08-01"')
                                   ->where('tanggal<="2024-08-30"')
                                   ->select('SUM(jumlah) as totalAgustus')
                                   ->first();
        $totalAgustus = !empty($totalAgustusResult) ? $totalAgustusResult['totalAgustus'] : 0;
        $totalSeptemberResult = $pemasukanModel->where('tanggal>="2024-09-01"')
                                   ->where('tanggal<="2024-09-30"')
                                   ->select('SUM(jumlah) as totalSeptember')
                                   ->first();
        $totalSeptember = !empty($totalSeptemberResult) ? $totalSeptemberResult['totalSeptember'] : 0;
        $totalOktoberResult = $pemasukanModel->where('tanggal>="2024-10-01"')
                                   ->where('tanggal<="2024-10-30"')
                                   ->select('SUM(jumlah) as totalOktober')
                                   ->first();
        $totalOktober = !empty($totalOktoberResult) ? $totalOktoberResult['totalOktober'] : 0;
        $totalNovemberResult = $pemasukanModel->where('tanggal>="2024-11-01"')
                                   ->where('tanggal<="2024-11-30"')
                                   ->select('SUM(jumlah) as totalNovember')
                                   ->first();
        $totalNovember = !empty($totalNovemberResult) ? $totalNovemberResult['totalNovember'] : 0;
        $totalDesemberResult = $pemasukanModel->where('tanggal>="2024-12-01"')
                                   ->where('tanggal<="2024-12-30"')
                                   ->select('SUM(jumlah) as totalDesember')
                                   ->first();
        $totalDesember = !empty($totalDesemberResult) ? $totalDesemberResult['totalDesember'] : 0;

        $totalOutJanuari = $pengeluaranModel->where('tanggal>="2024-01-01"')
                                                    ->where('tanggal<="2024-01-30"')
                                                    ->select('sum(nominal) as totalPengeluaranJanuari')
                                                    ->first();
        $totalPengeluaranJanuari = !empty($totalOutJanuari) ? $totalOutJanuari['totalPengeluaranJanuari'] : 0;
        $totalOutFebruari = $pengeluaranModel->where('tanggal>="2024-02-01"')
                                                    ->where('tanggal<="2024-02-30"')
                                                    ->select('sum(nominal) as totalPengeluaranFebruari')
                                                    ->first();
        $totalPengeluaranFebruari = !empty($totalOutFebruari) ? $totalOutFebruari['totalPengeluaranFebruari'] : 0;
        $totalOutMaret = $pengeluaranModel->where('tanggal>="2024-03-01"')
                                                    ->where('tanggal<="2024-03-30"')
                                                    ->select('sum(nominal) as totalPengeluaranMaret')
                                                    ->first();
        $totalPengeluaranMaret = !empty($totalOutMaret) ? $totalOutMaret['totalPengeluaranMaret'] : 0;
        $totalOutApril = $pengeluaranModel->where('tanggal>="2024-04-01"')
                                                    ->where('tanggal<="2024-04-30"')
                                                    ->select('sum(nominal) as totalPengeluaranApril')
                                                    ->first();
        $totalPengeluaranApril = !empty($totalOutApril) ? $totalOutApril['totalPengeluaranApril'] : 0;
        $totalOutMei = $pengeluaranModel->where('tanggal>="2024-05-01"')
                                                    ->where('tanggal<="2024-05-30"')
                                                    ->select('sum(nominal) as totalPengeluaranMei')
                                                    ->first();
        $totalPengeluaranMei = !empty($totalOutMei) ? $totalOutMei['totalPengeluaranMei'] : 0;
        $totalOutJuni = $pengeluaranModel->where('tanggal>="2024-06-01"')
                                                    ->where('tanggal<="2024-06-30"')
                                                    ->select('sum(nominal) as totalPengeluaranJuni')
                                                    ->first();
        $totalPengeluaranJuni = !empty($totalOutJuni) ? $totalOutJuni['totalPengeluaranJuni'] : 0;
        $totalOutJuli = $pengeluaranModel->where('tanggal>="2024-07-01"')
                                                    ->where('tanggal<="2024-07-30"')
                                                    ->select('sum(nominal) as totalPengeluaranJuli')
                                                    ->first();
        $totalPengeluaranJuli = !empty($totalOutJuli) ? $totalOutJuli['totalPengeluaranJuli'] : 0;
        $totalOutAgustus = $pengeluaranModel->where('tanggal>="2024-08-01"')
                                                    ->where('tanggal<="2024-08-30"')
                                                    ->select('sum(nominal) as totalPengeluaranAgustus')
                                                    ->first();
        $totalPengeluaranAgustus = !empty($totalOutAgustus) ? $totalOutAgustus['totalPengeluaranAgustus'] : 0;
        $totalOutSeptember = $pengeluaranModel->where('tanggal>="2024-09-01"')
                                                    ->where('tanggal<="2024-09-30"')
                                                    ->select('sum(nominal) as totalPengeluaranSeptember')
                                                    ->first();
        $totalPengeluaranSeptember = !empty($totalOutSeptember) ? $totalOutSeptember['totalPengeluaranSeptember'] : 0;
        $totalOutOktober = $pengeluaranModel->where('tanggal>="2024-10-01"')
                                                    ->where('tanggal<="2024-10-30"')
                                                    ->select('sum(nominal) as totalPengeluaranOktober')
                                                    ->first();
        $totalPengeluaranOktober = !empty($totalOutOktober) ? $totalOutOktober['totalPengeluaranOktober'] : 0;
        $totalOutNovember = $pengeluaranModel->where('tanggal>="2024-11-01"')
                                                    ->where('tanggal<="2024-11-30"')
                                                    ->select('sum(nominal) as totalPengeluaranNovember')
                                                    ->first();
        $totalPengeluaranNovember = !empty($totalOutNovember) ? $totalOutNovember['totalPengeluaranNovember'] : 0;
        $totalOutDesember = $pengeluaranModel->where('tanggal>="2024-12-01"')
                                                    ->where('tanggal<="2024-12-30"')
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
            'totalPengeluaranJuli' => $totalPengeluaranDesember,
            'totalPengeluaranAgustus' => $totalPengeluaranAgustus,
            'totalPengeluaranSeptember' => $totalPengeluaranSeptember,
            'totalPengeluaranOktober' => $totalPengeluaranOktober,
            'totalPengeluaranNovember' => $totalPengeluaranNovember,
            'totalPengeluaranDesember' => $totalPengeluaranDesember,
        ];

        return view('toko/dashboard', $data);
    }
}