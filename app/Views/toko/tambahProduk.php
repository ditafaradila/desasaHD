<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.slim.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Produk</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Produk</h6>
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
            <form method="POST" action="/storeProduk" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="col-12 d-flex align-items-center">
                                    <div class="col-9">
                                        <h6 class="mb-0">Tambah Produk</h6>
                                    </div>
                                    <div class="col-3 text-end">
                                        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body px-4 pt-4 pb-2">
                                <div class="table-responsive p-0">
                                    <form>
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_produk">Harga</label>
                                            <input type="text" class="form-control" name="harga_produk" id="harga_produk">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_produk">Jumlah</label>
                                            <input type="text" class="form-control" name="jumlah_produk" id="jumlah_produk">
                                        </div>
                                        <div class="form-group">
                                            <label for="foto_produk">Masukkan foto</label>
                                            <div>
                                                <input type="file" class="form-control-file" name="foto_produk" id="foto_produk" required accept=".jpg, .png, .jpeg">
                                            </div>
                                        </div>
                                        <div align="center">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<?= $this->endSection() ?>