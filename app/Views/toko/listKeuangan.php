<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Keuangan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">List Keuangan</h6>
        </nav>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Total Pemasukan -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pemasukan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp <?php echo number_format((float)$totalDebit) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <a href="/detailing" type="button" class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" data-bs-toggle="modal" data-bs-target="#detailing">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Pengeluaran -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengeluaran</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp <?php echo number_format((float)$totalKredit) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-minus-circle text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Uang -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sisa Uang</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp <?php echo number_format((float)$totalUang) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-money text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Detail Keuangan -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Detail</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Keuangan
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <a href="/keuangan">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa fa-info-circle text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-6">
            <form action="<?= base_url('keuangan') ?>" method="GET">
                <div class="row align-items-end">
                    <div class="col-4">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $bulan_list[$bulan] ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" name="bulan" id="bulan">
                                <?php
                                $bulan_list = [
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                ];
                                $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
                                foreach ($bulan_list as $key => $value) {
                                    $selected = ($key == $bulan) ? 'selected' : '';
                                    echo '<li><a class="dropdown-item" href="?bulan=' . $key . '">' . $value . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="col-12 d-flex align-items-center">
                        <div class="col-7">
                            <h6 class="mb-0">Data Keuangan</h6>
                        </div>
                        <div class="col-5 text-end">
                            <a href="/laporanKeuangan" type="button" class="btn btn-outline-primary btn-sm mb-0"><i class="fa fa-download" style="font-size: 12px;"></i> Laporan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-4 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal</th>
                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Keterangan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Debit</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($keuangan as $keuangan) :
                                ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-center"><?= $keuangan['tanggal'] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-center"><?= $keuangan['keterangan'] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-center">Rp <?= number_format($keuangan['debit']) ?></p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-center"><?= $keuangan['kredit'] ?></p>
                                        </td>
                                    </tr>
                                <?php
                                endforeach
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="align-middle text-center">Total</td>
                                    <td colspan="2" class="align-middle text-center">Rp <?php echo number_format((float)$totalUang) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah Transaksi -->
    <div class="modal fade" id="detailing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pemasukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="timeline-content mb-3 col-6">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Shopee</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp <?php echo number_format((float)$totalShopee) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="timeline-content mb-3 col-6">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Toko</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Rp <?php echo number_format((float)$totalToko) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?= $this->endSection() ?>