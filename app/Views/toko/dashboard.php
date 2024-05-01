<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="ms-md-auto navbar-nav justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Halo -->
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <h5 class="font-weight-bolder">Halo, <?= session()->get('nama') ?>!</h5>
                                <p class="mb-5">Selamat datang di Website Administrasi Desasa Homedecor!</p>
                            </div>
                        </div>
                        <div class="col col-lg-6 text-center d-flex justify-content-end">
                            <img class="" height="200px" src="../assets/img/halo desasa.png" alt="halo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Penjualan -->
        <div class="col-lg-5 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Total Penjualan</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                        <span class="font-weight-bold"><?php echo $totalTransaksi ?></span> Produk bulan ini
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-shop text-danger text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Penjualan Toko</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo $totalToko ?> Produk</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-cart text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Penjualan Shopee</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo $totalShopee ?> Produk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top products -->
    <div class="row mt-4">
        <div class="card-group">
            <?php foreach ($top3Products as $index => $product): ?>
                <div class="card">
                    <img class="card-img-top" src="<?= base_url() ?>berkas/<?= $product['foto_produk']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Top #<?= $index + 1 ?></h5>
                        <p class="card-text"><?= $product['nama_produk'] ?></p>
                        <p class="card-text"><small class="text-success"><?= $product['jumlah_penjualan'] ?> terjual</small></p>
                    </div>
                </div>
                <!-- <div class="card">
                    <img class="card-img-top" src="https://64.media.tumblr.com/fdfd3313f4d8ff670f7e8fe1aadcd047/4e5d88e8724e8406-4c/s400x600/192e76268eca524d2c823a1bd176922fcded7afc.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Top #2</h5>
                        <p class="card-text">Blossom</p>
                        <p class="card-text"><small class="text-success">30 terjual</small></p>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="https://64.media.tumblr.com/e6bb07eee550e3628bba5ba103fd77b1/4e5d88e8724e8406-2f/s400x600/3bbb155e3418b87b8244c4407adea0fe724d60d4.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Top #3</h5>
                        <p class="card-text">Bubble</p>
                        <p class="card-text"><small class="text-success">20 terjual</small></p>
                    </div>
                </div> -->
            <?php endforeach;?>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Grafik Barang Terjual -->
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                    <h6 class="ms-2 mt-4 mb-0"> Total Transaksi </h6>
                    <p class="text-sm ms-2"><span class="font-weight-bolder"><?php echo $totalTransaksi ?></span> Transaksi</p>
                </div>
            </div>
        </div>
        <!-- Grafik Keuangan -->
        <div class="col-lg-7">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Keuangan</h6>
                    <p class="text-sm">
                        <!-- <i class="fa fa-arrow-up text-success"></i> -->
                        <span class="font-weight-bold">4% more</span> in 2021
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/plugins/chartjs.min.js"></script>
<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: "Penjualan",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [<?php echo max($transaksiJanuari, 1) ?>, <?php echo max($transaksiFebruari, 1) ?>,
                      <?php echo max($transaksiMaret, 1) ?>, <?php echo max($transaksiApril, 1) ?>, 
                      <?php echo max($transaksiMei, 1) ?>, <?php echo max($transaksiJuni, 1) ?>, 
                      <?php echo max($transaksiJuli, 1) ?>, <?php echo max($transaksiAgustus, 1) ?>,
                      <?php echo max($transaksiSeptember, 1) ?>, <?php echo max($transaksiOktober, 1) ?>,
                      <?php echo max($transaksiNovember, 1) ?>, <?php echo max($transaksiDesember, 1) ?>],
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });
</script>

<script>
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                    label: "Pemasukan",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [<?php echo max($totalJanuari, 1) ?>, <?php echo max($totalFebruari, 1) ?>,
                            <?php echo max($totalMaret, 1) ?>, <?php echo max($totalApril, 1) ?>, 
                            <?php echo max($totalMei, 1) ?>, <?php echo max($totalJuni, 1) ?>, 
                            <?php echo max($totalJuli, 1) ?>, <?php echo max($totalAgustus, 1) ?>,
                            <?php echo max($totalSeptember, 1) ?>, <?php echo max($totalOktober, 1) ?>,
                            <?php echo max($totalNovember, 1) ?>, <?php echo max($totalDesember, 1) ?>],
                    maxBarThickness: 6
                },
                {
                    label: "Pengeluaran",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [<?php echo max($totalPengeluaranJanuari, 1) ?>, <?php echo max($totalPengeluaranFebruari, 1) ?>,
                            <?php echo max($totalPengeluaranMaret, 1) ?>, <?php echo max($totalPengeluaranApril, 1) ?>, 
                            <?php echo max($totalPengeluaranMei, 1) ?>, <?php echo max($totalPengeluaranJuni, 1) ?>, 
                            <?php echo max($totalPengeluaranJuli, 1) ?>, <?php echo max($totalPengeluaranAgustus, 1) ?>,
                            <?php echo max($totalPengeluaranSeptember, 1) ?>, <?php echo max($totalPengeluaranOktober, 1) ?>,
                            <?php echo max($totalPengeluaranNovember, 1) ?>, <?php echo max($totalPengeluaranDesember, 1) ?>],
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>

<?= $this->endSection() ?>