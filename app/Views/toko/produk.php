<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<head>
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
        </div>
    </nav>

    <div class="container-fluid py-4">
        <!-- <form method="POST" action="/storeProduk" enctype="multipart/form-data">
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
                                            <input type="file" class="form-control-file" name="foto_produk" id="foto_produk" required accept=".jpg, .png, .jpeg">
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form> -->



        <div class="row">
            <?php
            foreach ($produk as $produk) :
            ?>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?= base_url() ?>berkas/<?= $produk['foto_produk']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto me-auto">
                                    <h5 class="card-title"><?= $produk['nama_produk'] ?></h5>
                                </div>
                                <div class="col-3">
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-link text-dark px-1 mb-0" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id_produk'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <a href="<?= base_url('produk/delete/' . $produk['id_produk']) ?>" class="btn btn-link text-danger px-1 mb-0" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt me-2"></i></a>
                                    </div>
                                </div>
                                <p class="card-text">Rp <?= number_format($produk['harga_produk']) ?></p>
                            </div>
                        </div>
                        <div align="center">
                            <div class="row">
                                <div class="col">
                                    <form method="POST" action="/kurangjumlahProduk/<?= $produk['id_produk'] ?>">
                                        <input type="hidden" name="jumlah_produk" value="<?php echo ($produk['jumlah_produk']) - 1 ?>">
                                        <button type="submit" name="submit" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-outline-dark">-</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <p class="form-text"><?= ($produk['jumlah_produk']) ?></p>
                                </div>
                                <div class="col">
                                    <form method="POST" action="/tambahjumlahProduk/<?= $produk['id_produk'] ?>">
                                        <input type="hidden" name="jumlah_produk" value="<?php echo ($produk['jumlah_produk']) + 1 ?>">
                                        <button type="submit" name="submit" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-outline-dark">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk Edit data -->
                <div class="modal fade" id="editModal-<?= $produk['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel">Edit produk</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: black;">&times;</span></button>
                            </div>
                            <form action="<?= base_url('produk/edit/' . $produk['id_produk']) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_produk">Name</label>
                                        <input type="text" name="nama_produk" class="form-control" id="nama_produk" value="<?= $produk['nama_produk'] ?>" placeholder="produk nama_produk" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_produk">Harga Produk</label>
                                        <input type="text" name="harga_produk" class="form-control" id="harga_produk" value="<?= $produk['harga_produk'] ?>" placeholder="produk harga_produk" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_produk">Masukkan foto</label>
                                        <div>
                                            <input type="file" class="form-control-file" name="foto_produk" id="foto_produk" required accept=".jpg, .png, .jpeg">
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

    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                </div>
                <div class="form-check form-switch ps-0">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard-pro">Free Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Plus Minus Button with Input -->

</body>

<?= $this->endSection() ?>