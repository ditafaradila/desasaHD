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
    <div class="row">
        <div class="col-lg-4 mb-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
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
                    <h6>3. Meminta Produk Data API</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Click the following link to authenticate your shop:</span>
                    </p>
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
                    <h6>4. Meminta Order Data API</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Click the following link to authenticate your shop:</span>
                    </p>
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


<?= $this->endSection() ?>
