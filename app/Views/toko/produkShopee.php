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
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="col-12 d-flex align-items-center">
                            <div class="col-7">
                                <h6 class="mb-0">Produk Shopee</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-4 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Item ID</th>
                                        <th>Nama Produk</th>
                                        <th>Aksi</th>
                                        <!-- <th>Deskripsi</th>
                                        <th>Item SKU</th>
                                        <th>Mata Rupiah</th>
                                        <th>Harga Original</th>
                                        <th>Harga Sekarang</th>
                                        <th>Type Stock</th>
                                        <th>Stock Sekarang</th>
                                        <th>Normal Stock</th>
                                        <th>Foto Produk</th>
                                        <th>Berat Produk</th>
                                        <th>Kondisi</th>
                                        <th>Ukuran</th>
                                        <th>Status</th>
                                        <th>Deboost</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                        foreach ($items2 as $item2) : 
                                    ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?= $item2['item_id'] ?></span>
                                            </td>
                                            <td class="align-middle shorten-text">
                                                <span class="text-secondary text-xs font-weight-bold"><?= $item2['item_name'] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div>
                                                    <button type="button" class="btn btn-link text-dark px-1 mb-0" data-bs-toggle="modal" data-bs-target="#detailProduk-<?= $item2['item_id'] ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>                                            
                                        </tr>
                                        <!-- Modal Detail Transaksi -->
                                        <div class="modal fade" id="detailProduk-<?= $item2['item_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="exampleModalLabel">Detail Data Produk</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: black;">&times;</span></button>
                                                    </div>
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Nama Produk</h6>
                                                                <p class="shorten-text text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['item_name'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">ID Kategori</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['category_id'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Deskripsi</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    Rp <?= ($item2['description']) ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Item SKU</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['item_sku'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Currency</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['currency'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Harga Original</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['original_price'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Harga Saat Ini</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['current_price'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Stok Saat Ini</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['current_stock'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Stok Normal</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['normal_stock'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Gambar Produk</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['image_url_list'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Berat Produk</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['weight'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Kondisi</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['condition'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Ukuran</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['size_chart'] ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Item Status</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['item_status'] ?></p>
                                                            </div>
                                                            <div class="timeline-content mb-3 col-6">
                                                                <h5 class="text-dark text-sm font-weight-bold mb-0">Deboost</h5>
                                                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    <?= $item2['deboost'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
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