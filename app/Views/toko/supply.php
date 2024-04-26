<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<!-- Tambahkan kode notifikasi di sini -->
<?php if (session()->has('pesan')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session('pesan') ?>
    </div>
<?php endif; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.slim.min.js"></script>
</head>

<body>
    <!-- judul halaman-->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Supply</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Supply</h6>
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

    <?php if (session()->has('error')) : ?>
    <div class="alert alert-danger text-white">
        <?php echo session('error'); ?>
    </div>
    <?php endif; ?>

    <!-- data barang masuk dan keluar -->
    <div class="container-fluid py-4">
        <!-- Tombol data bahan baku -->
        <a href="/bahanbaku" class="floating-button"><i class="fa fa-archive"></i></a>
        <div class="row">
            <!-- Barang Masuk -->
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Barang Masuk</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a href="/tambahSupply" type="button"
                                    class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jenis</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nominal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($totalSupply as $totalSupply) :
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $totalSupply['jenis_barang'] ?>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">
                                                <?= $totalSupply['total_jumlah_supply'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">
                                                <?= $totalSupply['total_harga_supply'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">
                                                <?= $totalSupply['max_tanggal_supply'] ?></p>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <a href="/detailBarangMasuk" class="btn btn-link text-dark px-1 mb-0">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Barang Keluar -->
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Barang Keluar</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a href="/tambahBarangKeluar" type="button"
                                    class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jenis</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($totalBarangKeluar as $totalBarangKeluar) :
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                <?= $totalBarangKeluar['jenis_barang'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">
                                                <?= $totalBarangKeluar['total_jumlah_barangKeluar'] ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold"><?= $totalBarangKeluar['max_tanggal_barangKeluar'] ?></span>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <a href="/detailBarangKeluar" class="btn btn-link text-dark px-1 mb-0">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?= $this->endSection() ?>