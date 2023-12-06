<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<head>
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
        </div>
    </nav>

    <form method="POST" action="/storeProduk" enctype="multipart/form-data">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Produk</h6>
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
                                            <input type="file" class="form-control-file" name="foto_produk"
                                                id="foto_produk" required accept=".jpg, .png, .jpeg">
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN</button>
                                        <!-- <a class="btn bg-gradient-dark mb-0" href="javascript:;"></i>SIMPAN</a> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                foreach ($produk as $produk) :
                ?>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?= base_url() ?>berkas/<?= $produk['foto_produk']; ?>"
                            alt="Card image cap">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto me-auto">
                                    <h5 class="card-title"><?= $produk['nama_produk'] ?></h5>
                                </div>
                                <div class="col-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
                                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-expanded="false"></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <div align="center">
                                                <li>
                                                    <button type="button" class="btn btn-sm btn-outline-dark"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal-<?= $produk['id_produk'] ?>">
                                                        Edit
                                                    </button>
                                                </li>
                                                <li><a href="<?= base_url('produk/delete/'.$produk['id_produk']) ?>"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text">Rp <?= number_format($produk['harga_produk']) ?></p>
                            </div>
                        </div>
                        <div align="center">
                            <div class="row">
                                <div class="col">
                                    <form method="POST" action="/kurangjumlahProduk/<?= $produk['id_produk'] ?>">
                                        <input type="hidden" name="jumlah_produk"
                                            value="<?php echo ($produk['jumlah_produk']) - 1 ?>">
                                        <button type="submit" name="submit" data-bs-toggle="tooltip"
                                            data-bs-placement="top" class="btn btn-outline-dark">-</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <p class="form-text"><?= ($produk['jumlah_produk']) ?></p>
                                </div>
                                <div class="col">
                                    <form method="POST" action="/tambahjumlahProduk/<?= $produk['id_produk'] ?>">
                                        <input type="hidden" name="jumlah_produk"
                                            value="<?php echo ($produk['jumlah_produk']) + 1 ?>">
                                        <button type="submit" name="submit" data-bs-toggle="tooltip"
                                            data-bs-placement="top" class="btn btn-outline-dark">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            value="<?= $produk['nama_produk'] ?>" placeholder="produk nama_produk"
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
                                            <input type="file" class="form-control-file" name="foto_produk"
                                                id="foto_produk" required accept=".jpg, .png, .jpeg">
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
    </form>

    <!-- JS Plus Minus Button with Input -->

</body>

<?= $this->endSection() ?>