<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.slim.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
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
        <div class="flex-wrap d-flex gap-4">
            <?php
            foreach ($produk as $produk) :
            ?>
            <!-- <div class="col-4">
                    <div class="row row-cols-1 row-cols-md-2 g-4"> -->
            <div class="card-deck">
                <div class="card mb-4 mr-4" style="width: 18rem;">
                    <!-- <div class="" style="height:18rem"> -->
                        <img class="card-img-top object-fit-contain" style="height:18rem; width:100%"
                            src="<?= base_url() ?>berkas/<?= $produk['foto_produk']; ?>" alt="Card image cap">
                    <!-- </div> -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto me-auto">
                                <h5 class="shorten-text card-title" title="<?= $produk['nama_produk'] ?>">
                                    <?= $produk['nama_produk'] ?>
                                </h5>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-link text-dark px-1 mb-0"
                                        data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id_produk'] ?>">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <a href="<?= base_url('produk/delete/' . $produk['id_produk']) ?>"
                                        class="btn btn-link text-danger px-1 mb-0"
                                        onclick="return confirm('Apakah anda yakin?')"><i
                                            class="far fa-trash-alt me-2"></i></a>
                                </div>
                            </div>
                            <p class="card-text">Rp <?= number_format($produk['harga_produk']) ?></p>
                            <p class="form-text">Jumlah Stok: <?= ($produk['jumlah_produk']) ?></p>
                        </div>
                    </div>
                </div>
                <!-- </div>
                    </div> -->
            </div>

            <!-- Modal untuk Edit data -->
            <div class="modal fade" id="editModal-<?= $produk['id_produk'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Edit produk</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true" style="color: black;">&times;</span></button>
                        </div>
                        <form action="<?= base_url('produk/edit/' . $produk['id_produk']) ?>" method="post"
                            enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama_produk">Name</label>
                                    <input type="text" name="nama_produk" class="form-control" id="nama_produk"
                                        value="<?= $produk['nama_produk'] ?>" placeholder="produk nama_produk" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_produk">Jumlah Stok</label>
                                    <input type="text" name="jumlah_produk" class="form-control" id="jumlah_produk"
                                        value="<?= $produk['jumlah_produk'] ?>" placeholder="produk jumlah_produk"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_produk">Harga Produk</label>
                                    <input type="text" name="harga_produk" class="form-control" id="harga_produk"
                                        value="<?= $produk['harga_produk'] ?>" placeholder="produk harga_produk"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="foto_produk">Masukkan foto</label>
                                    <div>
                                        <input type="file" class="form-control-file" name="foto_produk" id="foto_produk"
                                            <?= $produk['foto_produk'] ? '' : 'required' ?> accept=".jpg, .png, .jpeg"
                                            value="<?= $produk['foto_produk'] ?>">
                                        <?php if ($produk['foto_produk']) : ?>
                                        <img src="<?= base_url('berkas/' . $produk['foto_produk']) ?>" alt="Foto Produk"
                                            style="max-width: 200px; margin-top: 10px;">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-6 text-end" align="center">
                                    <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            endforeach
            ?>
        </div>
    </div>

</body>

<?= $this->endSection() ?>