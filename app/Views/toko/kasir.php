<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.slim.min.js"></script>
    <style>
        #id_produk {
            max-width: 200px;
        }

        #id_produk option {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .total-harga-label {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .bayar-kembalian {
            font-size: 1rem;
            font-weight: bold;
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
                <h6 class="font-weight-bolder mb-0">Kasir</h6>
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
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger text-white">
                    <?php echo session('error'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <form action="/storeTransaksi" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="col-12 d-flex align-items-center">
                                    <div class="col-9">
                                        <h6 class="mb-0">Kasir Toko Desasa Homedecor</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-4 pt-4 pb-2">
                                <div class="table-responsive p-0">
                                    <form>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="metode_bayar">Metode Bayar</label>
                                                    <select class="form-select" name="metode_bayar" id="metode_bayar">
                                                        <option value="Cash">Cash</option>
                                                        <option value="Transfer">Transfer</option>
                                                        <option value="Qris">Qris</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nominal" class="form-label total-harga-label">Total Harga</label>
                                                    <div class="input-group">
                                                        <span id="nominal" style="font-size: 1.25rem; font-weight: bold;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="produk" class="form-label">Nama Barang</label><br>
                                                    <select name="id_produk" id="id_produk">
                                                        <option value="" disabled selected>Pilih produk</option>
                                                        <?php foreach ($produkList as $produkItem) : ?>
                                                            <option value="<?= $produkItem->id_produk ?>" data-harga="<?= $produkItem->harga_produk ?>">
                                                                <span class="shorten-text"><?= $produkItem->nama_produk ?></span>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah Barang</label>
                                                    <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah Barang. Contoh: 2.">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="harga_produk" class="form-label">Harga Barang</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="harga_produk" readonly>
                                                        <span class="input-group-text">,-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="diskon">Diskon</label>
                                                    <input type="text" class="form-control" name="diskon" id="diskon" placeholder="Masukkan % diskon yang berlaku. Contoh: 10.">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="nominal_bayar">Nominal Bayar</label>
                                                    <input type="text" class="form-control" name="nominal_bayar" id="nominal_bayar">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="kembalian" class="form-label bayar-kembalian">Kembalian</label>
                                                    <div class="input-group">
                                                        <span id="kembalian" style="font-size: 1rem; font-weight: bold;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div align="center">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN PERUBAHAN</button>
                                        </div>
                                    </form>
                                </div>
                                <?= csrf_field(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

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
                    var formattedHarga = "Rp " + parseInt(data.harga_produk).toLocaleString('id-ID');
                    hargaProdukInput.value = formattedHarga;
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
    document.addEventListener("DOMContentLoaded", function() {
        // Fungsi untuk mengupdate total harga saat memilih jumlah barang
        function updateTotalHarga() {
            var hargaProduk = parseInt(document.getElementById('harga_produk').value.replace(/\D/g, ''));
            var jumlahBarang = parseInt(document.getElementById('jumlah').value);
            var diskonPercentage = parseFloat(document.getElementById('diskon').value.replace(/[^\d.]/g, '')); // Extract percentage value
            var diskon = hargaProduk * jumlahBarang * (diskonPercentage / 100); // Calculate discount amount
            var totalHarga = (hargaProduk * jumlahBarang) - diskon;

            // Memformat total harga menggunakan toLocaleString() dan menambahkan "Rp" di depannya
            var formattedTotalHarga = "Rp " + totalHarga.toLocaleString('id-ID') + ",-";

            // Menetapkan nilai total harga yang sudah diformat pada input total harga
            document.getElementById('nominal').textContent = formattedTotalHarga;
            hitungKembalian();
        }

        function hitungKembalian() {
            var totalHarga = parseInt(document.getElementById('nominal').textContent.replace(/\D/g, ''));
            var nominalBayar = parseInt(document.getElementById('nominal_bayar').value.replace(/\D/g, ''));
            var kembalian = nominalBayar - totalHarga;

            // Memformat kembalian menggunakan toLocaleString() dan menambahkan "Rp" di depannya
            var formattedKembalian = "Rp " + kembalian.toLocaleString('id-ID') + ",-";

            // Menetapkan nilai kembalian yang sudah diformat pada span kembalian
            document.getElementById('kembalian').textContent = formattedKembalian;
        }

        // Memanggil fungsi updateTotalHarga saat memilih jumlah barang atau memasukkan diskon
        document.getElementById('jumlah').addEventListener('input', updateTotalHarga);
        document.getElementById('diskon').addEventListener('input', updateTotalHarga);

        document.getElementById('nominal_bayar').addEventListener('input', hitungKembalian);

        // Memanggil fungsi updateHarga saat memilih produk
        document.getElementById('id_produk').addEventListener('change', updateHarga);
    });
</script>

<?= $this->endSection() ?>