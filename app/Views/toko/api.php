<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">API</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">API</h6>
        </nav>
    </div>
</nav>

<div class="container-fluid py-4">
    <!-- notifikasi sukses dan eror -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <!-- data -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-4 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Partner Key</th>
                                    <th>Partner ID</th>
                                    <th>Shop ID</th>
                                    <th>Code</th>
                                    <th>Access Token</th>
                                    <th>Refresh Token</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center shorten-text">
                                        <span class="text-secondary text-xs font-weight-bold" title="<?= $api['partner_key'] ?>">
                                            <?= $api['partner_key'] ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $api['partner_id'] ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $api['shop_id'] ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $api['code'] ?></span>
                                    </td>
                                    <td class="align-middle text-center shorten-text">
                                        <span class="text-secondary text-xs font-weight-bold" title="<?= $api['access_token'] ?>">
                                            <?= $api['access_token'] ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center shorten-text">
                                        <span class="text-secondary text-xs font-weight-bold" title="<?= $api['refresh_token'] ?>">
                                            <?= $api['refresh_token'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="align-middle text-center text-sm">
                                            <button type="button" class="btn btn-link text-dark px-1 mb-0 text-center" data-bs-toggle="modal" data-bs-target="#editApi-1">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- halaman -->
    <div class="row gap-3 gap-md-0">
        <div class="col-lg-4 mb-lg-0 mb-0 mb-md-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-header">
                    <h6>1. Shop Authenticate</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Click the following link to authenticate your shop:</span>
                    </p>
                    <div align="center">
                        <form method="POST" action="/auth">
                            <button type="submit" class="btn bg-gradient-dark mb-0">Authenticate Shop</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>2. Dapatkan Token</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Click the following link to authenticate your shop:</span>
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('/process') ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive p-0">
                                    <form>
                                        <div class="form-group">
                                            <label for="shop_id">Shop ID</label>
                                            <input type="text" class="form-control" name="shop_id" id="shop_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Code</label>
                                            <input type="text" class="form-control" name="code" id="code">
                                        </div>
                                        <div align="center">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">Dapatkan Token</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>3. Perbarui Token</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Click the following link to get refresh Token your shop:</span>
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('/processRefreshToken') ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive p-0">
                                    <form>
                                        <div class="form-group">
                                            <label for="shop_id">Shop ID</label>
                                            <input type="text" class="form-control" name="shop_id" id="shop_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="refreshToken">Refresh Token</label>
                                            <input type="text" class="form-control" name="refreshToken" id="refreshToken">
                                        </div>
                                        <div align="center">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">Dapatkan Refresh Token</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row gap-3 gap-md-0">
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>4. Meminta Produk Data API</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Click the following link to authenticate your shop:</span>
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('/showItemList') ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive p-0">
                                    <form>
                                        <div class="form-group">
                                            <label for="shop_id">Shop ID</label>
                                            <input type="text" class="form-control" name="shop_id" id="shop_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="access_token">Access Token</label>
                                            <input type="text" class="form-control" name="access_token" id="access_token">
                                        </div>
                                        <div align="center">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">Tampilkan Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>5. Meminta Order Data API</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Click the following link to authenticate your shop:</span>
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('/showOrderList') ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive p-0">
                                    <form>
                                        <div class="form-group">
                                            <label for="shop_id">Shop ID</label>
                                            <input type="text" class="form-control" name="shop_id" id="shop_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="access_token">Access Token</label>
                                            <input type="text" class="form-control" name="access_token" id="access_token">
                                        </div>
                                        <div align="center">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">Tampilkan Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editApi-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Edit Data API Shopee</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: black;">&times;</span></button>
            </div>
            <form action="<?= base_url('/updateApi/' . $api['id_api']) ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="partner_id">Partner ID</label>
                        <input type="text" class="form-control" name="partner_id" id="partner_id" value="<?= $api['partner_id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="partner_key">Partner Key</label>
                        <input type="text" class="form-control" name="partner_key" id="partner_key" value="<?= $api['partner_key'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="shop_id">Shop ID</label>
                        <input type="text" class="form-control" name="shop_id" id="shop_id" value="<?= $api['shop_id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" name="code" id="code" value="<?= $api['code'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="access_token">Access Token</label>
                        <input type="text" class="form-control" name="access_token" id="access_token" value="<?= $api['access_token'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="refresh_token">Refresh Token</label>
                        <input type="text" class="form-control" name="refresh_token" id="refresh_token" value="<?= $api['refresh_token'] ?>">
                    </div>
                    <div align="center">
                        <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN PERUBAHAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>