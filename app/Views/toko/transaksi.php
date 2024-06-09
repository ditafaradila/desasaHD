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
    <style>
        #id_produk {
            max-width: 200px;
            /* Sesuaikan dengan lebar maksimal yang diinginkan */
        }

        #id_produk option {
            overflow: hidden;
            text-overflow: ellipsis;
            /* Menambahkan titik elipsis untuk teks yang terpotong */
            white-space: nowrap;
            /* Mencegah wrap teks */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transaksi</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Transaksi</h6>
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

    <div class="container-fluid">
        <div class="row">
            <!-- Total Pemasukan -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-dark">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="numbers">
                                <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi</p>
                                <h5 class="text-white font-weight-bolder mb-0 text-end"><?php echo $totalTransaksi ?> Transaksi
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jumlah Transaksi Shopee-->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-dark">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="numbers">
                                <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Transaksi Shopee</p>
                                <h5 class="text-white font-weight-bolder mb-0 text-end"><?php echo $totalShopee ?> Transaksi </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jumlah Transaksi Toko-->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-dark">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="numbers">
                                <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Transaksi Toko</p>
                                <h5 class="text-white font-weight-bolder mb-0 text-end"><?php echo $totalToko ?> Transaksi
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tambah Transaksi Toko -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-dark">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Ada Pembeli di
                                        Toko?</p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <a href="/kasir">
                                    <div class="icon icon-shape icon-custom bg-gradient-primary-alt shadow text-center border-radius-md">
                                        <i class="fa fa-plus text-lg" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-end mt-4">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>
                    <input type="text" class="form-control border border-primary" placeholder="Cari..." onkeyup="search(this.value)">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Transaksi Shopee -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Transaksi Shopee</h6>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Pembeli</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Harga</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyTable">
                                    <?php $no = 1;
                                    foreach ($orders as $order) :
                                    ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                            </td>
                                            <td>
                                                <p class="shorten-text text-xs font-weight-bold mb-0">
                                                    <?= $order['buyer_username'] ?></p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= CodeIgniter\I18n\Time::createFromTimestamp($order['create_time'], 'Asia/Jakarta')->format('d F Y, H:i:s'); ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="shorten-text text-xs font-weight-bold mb-0">
                                                    Rp <?= number_format($order['total_amount']) ?></p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div>
                                                    <button type="button" class="btn btn-link text-dark px-1 mb-0" data-bs-toggle="modal" data-bs-target="#detailShopee-<?= $order['id_orderList'] ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail Transaksi -->
                                        <div class="modal fade" id="detailShopee-<?= $order['id_orderList'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="exampleModalLabel">Detail Data Transaksi Shopee</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: black;">&times;</span></button>
                                                    </div>
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">ID Order</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['order_sn'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Negara</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['region'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Currency</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['currency'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">COD</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['cod'] == 1 ? 'Iya' : 'Tidak' ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Total Transaksi</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    Rp <?= number_format($order['total_amount']) ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Pending Terms</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['pending_terms'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Order Status</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['order_status'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Shipping Carrier</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['shipping_carrier'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Payment Method</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['payment_method'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Estimated Shipping Fee</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    Rp <?= number_format($order['estimated_shipping_fee']) ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Message to Seller</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['message_to_seller'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Update Time</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= CodeIgniter\I18n\Time::createFromTimestamp($order['update_time'], 'Asia/Jakarta')->format('d F Y, H:i:s'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Create Time</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= CodeIgniter\I18n\Time::createFromTimestamp($order['create_time'], 'Asia/Jakarta')->format('d F Y, H:i:s'); ?>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Days to Ship</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['days_to_ship'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Ship By Date</h6>
                                                                <p class=" text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= CodeIgniter\I18n\Time::createFromTimestamp($order['ship_by_date'], 'Asia/Jakarta')->format('d F Y, H:i:s'); ?>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Nama Pembeli</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $order['buyer_username'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-12" style="margin-left: 45px; margin-right: 45px;">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Nama Produk</h5>
                                                                <?php
                                                                $item_names = explode(',', $order['item_name']);
                                                                foreach ($item_names as $item_name) :
                                                                ?>
                                                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0" style="margin-right: 45px;">
                                                                        <?= $item_name ?>
                                                                    </p>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    <?php
                                    endforeach
                    ?>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Toko -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Transaksi Toko</h6>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Produk</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Harga</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($transaksi as $transaksi) :
                                ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                        </td>
                                        <td>
                                            <p class="shorten-text text-xs font-weight-bold mb-0">
                                                <?= $transaksi['nama_produk'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $transaksi['waktu'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $transaksi['nominal'] ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div>
                                                <button type="button" class="btn btn-link text-dark px-1 mb-0" data-bs-toggle="modal" data-bs-target="#detailToko-<?= $transaksi['id_transaksi'] ?>">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Detail Transaksi -->
                                    <div class="modal fade" id="detailToko-<?= $transaksi['id_transaksi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLabel">Detail Data</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: black;">&times;</span></button>
                                                </div>
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Nama Produk</h6>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                <?= ($transaksi['nama_produk']) ?></p>
                                                        </div>
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Metode
                                                                Pembayaran</h5>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                <?= $transaksi['metode_bayar'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Diskon
                                                            </h5>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                <?= ($transaksi['diskon']) ?>%</p>
                                                        </div>
                                                        <!-- <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Harga Produk</h5>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                Rp <?= number_format($transaksi['harga_produk']) ?></p>
                                                        </div> -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Jumlah Produk</h5>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                <?= ($transaksi['jumlah']) ?></p>
                                                        </div>
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Total Harga</h5>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                Rp <?= number_format($transaksi['nominal']) ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Nominal Bayar</h5>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                Rp <?= number_format(floatval($transaksi['nominal_bayar'])) ?></p>
                                                        </div>
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Kembalian</h5>
                                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                Rp <?= number_format(floatval($transaksi['kembalian'])) ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="align-middle text-center">
                                                        <a href="/cetakStruk/<?= ($transaksi['id_transaksi']) ?>" type="button" class="btn btn-outline-primary btn-sm mb-0"><i class="fa fa-print" style="font-size: 12px;"></i>struk</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<!-- Javascript pengambilan data harga_produk -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fungsi untuk mengupdate harga saat memilih produk
        function updateHarga() {
            var selectedOption = document.getElementById('id_produk');
            var hargaProdukInput = document.getElementById('harga_produk');

            // Mengambil URL untuk mendapatkan data harga berdasarkan id_produk
            var url = '<?= site_url('/get_harga') ?>/' + selectedOption.value;

            // Menggunakan Fetch API untuk mengambil data harga
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Menetapkan nilai harga pada input
                    hargaProdukInput.value = data.harga_produk;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Memanggil fungsi updateHarga saat memilih produk
        document.getElementById('id_produk').addEventListener('change', updateHarga);
    });
</script>
<script>
    function search(get) {
        $('table tbody tr').each(function() {
            var content = $(this).find('td').text();
            if (content.toLowerCase().includes(get.trim().toLowerCase())) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
</script>
<?= $this->endSection() ?>