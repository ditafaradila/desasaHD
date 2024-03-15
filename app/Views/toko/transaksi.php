<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<head>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
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
                                <h5 class="text-white font-weight-bolder mb-0 text-end"><?php echo $totalToko ?> Produk
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
                                <h5 class="text-white font-weight-bolder mb-0 text-end"> 5 Produk </h5>
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
                                <h5 class="text-white font-weight-bolder mb-0 text-end"><?php echo $totalToko ?> Produk
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
                                <a href="/tambahTransaksi" type="button"
                                    class="icon icon-shape icon-custom bg-gradient-primary-alt shadow text-center border-radius-md"
                                    data-bs-toggle="modal" data-bs-target="#tambahTransaksi">
                                    <i class="fa fa-plus text-lg" aria-hidden="true"></i>
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
            <!-- Transakso Shopee -->
            <div class="col-6">
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Produk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">1</span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Kucing</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">1</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">10/10/2024</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">Rp 150.000</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Toko -->
            <div class="col-6">
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Produk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Harga</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                <button type="button" class="btn btn-link text-dark px-1 mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editTransaksi-<?= $transaksi['id_transaksi'] ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <a href="<?= base_url('/hapusTransaksi/' . $transaksi['id_transaksi']) ?>"
                                                    class="btn btn-link text-center text-danger text-gradient px-1 mb-0"
                                                    onclick="return confirm('Apakah anda yakin?')"><i
                                                        class="far fa-trash-alt me-2"></i></a>
                                                <button type="button" class="btn btn-link text-dark px-1 mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailToko-<?= $transaksi['id_transaksi'] ?>">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Detail Transaksi -->
                                    <div class="modal fade" id="detailToko-<?= $transaksi['id_transaksi'] ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLabel">Detail Data</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true"
                                                            style="color: black;">&times;</span></button>
                                                </div>
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Nama
                                                                Produk</h6>
                                                            <p
                                                                class="shorten-text text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                <?= $transaksi['nama_produk'] ?></p>
                                                        </div>
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Metode
                                                                Pembayaran</h5>
                                                            <p
                                                                class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                <?= $transaksi['metode_bayar'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Diskon
                                                            </h5>
                                                            <p
                                                                class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                Rp <?= number_format($transaksi['diskon']) ?></p>
                                                        </div>
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Tanggal
                                                                Transaksi</h5>
                                                            <p
                                                                class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                <?= $transaksi['waktu'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Harga
                                                                Awal</h5>
                                                            <p
                                                                class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                Rp <?= number_format($transaksi['harga_produk']) ?></p>
                                                        </div>
                                                        <div class="timeline-content mb-3 col-6">
                                                            <h5 class="text-dark text-sm font-weight-bold mb-0">Harga
                                                                Akhir</h5>
                                                            <p
                                                                class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                Rp <?= number_format($transaksi['nominal']) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit Supply -->
                                    <div class="modal fade" id="editTransaksi-<?= $transaksi['id_transaksi'] ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLabel">Edit Transaksi Toko
                                                    </h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true"
                                                            style="color: black;">&times;</span></button>
                                                </div>
                                                <form
                                                    action="<?= base_url('/updateTransaksi/' . $transaksi['id_transaksi']) ?>"
                                                    method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="produk" class="form-label">Nama
                                                                Barang</label><br>
                                                            <select name="id_produk" id="id_produk">
                                                                <option value="" disabled selected>Pilih produk</option>
                                                                <?php foreach ($produkList as $produkItem) : ?>
                                                                <option value="<?= $produkItem->id_produk ?>"
                                                                    data-harga="<?= $produkItem->harga_produk ?>">
                                                                    <span
                                                                        class="shorten-text"><?= $produkItem->nama_produk ?></span>
                                                                    / <?= $produkItem->harga_produk ?>
                                                                </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="metode_bayar">Metode Bayar</label>
                                                            <input type="text" class="form-control" name="metode_bayar"
                                                                id="metode_barang"
                                                                value="<?= $transaksi['metode_bayar'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="diskon">Diskon</label>
                                                            <input type="text" class="form-control" name="diskon"
                                                                id="diskon" value="<?= $transaksi['diskon'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="waktu">Tanggal Pembelian</label>
                                                            <input type="date" class="form-control" name="waktu"
                                                                id="waktu" value="<?= $transaksi['waktu'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="harga_produk" class="form-label">Harga
                                                                Barang</label>
                                                            <input type="text" class="form-control" name="harga_produk"
                                                                id="harga_produk" readonly>
                                                        </div>
                                                        <div align="center">
                                                            <button type="submit"
                                                                class="btn bg-gradient-dark mb-0">SIMPAN
                                                                PERUBAHAN</button>
                                                        </div>
                                                    </div>
                                                </form>
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

    <!-- Modal tambah Transaksi -->
    <div class="modal fade" id="tambahTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/storeTransaksi" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="metode_bayar">Metode Bayar</label>
                                <input type="text" class="form-control" name="metode_bayar" id="metode_barang">
                            </div>
                            <div class="form-group">
                                <label for="diskon">Diskon</label>
                                <input type="text" class="form-control" name="diskon" id="diskon" placeholder="Masukkan diskon yang sedang berlaku. Contoh: 10%.">
                            </div>
                            <div class="form-group">
                                <label for="waktu">Tanggal Pembelian</label>
                                <input type="date" class="form-control" name="waktu" id="waktu">
                            </div>
                            <div class="form-group">
                                <label for="produk" class="form-label">Nama Barang</label><br>
                                <select name="id_produk" id="id_produk">
                                    <option value="" disabled selected>Pilih produk</option>
                                    <?php foreach ($produkList as $produkItem) : ?>
                                    <option value="<?= $produkItem->id_produk ?>"
                                        data-harga="<?= $produkItem->harga_produk ?>">
                                        <span class="shorten-text"><?= $produkItem->nama_produk ?></span> /
                                        <?= $produkItem->harga_produk ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_produk" class="form-label">Harga Barang</label>
                                <input type="text" class="form-control" name="harga_produk" id="harga_produk" readonly>
                            </div>
                            <div align="center">
                                <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN PERUBAHAN</button>
                            </div>
                        </div>
                    </form>
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

<?= $this->endSection() ?>