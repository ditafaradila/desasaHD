<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Supply</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Tambah Barang Keluar</h6>
        </nav>
    </div>
</nav>

<form method="POST" action="/storeBK">
    <div class="container-fluid py-4">
        <div class="row">
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger text-white">
                    <?php echo session('error'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tambah Barang Keluar</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        <div class="table-responsive p-0">
                            <form>
                                <div class="row">
                                    <?php foreach ($supply as $item) : ?>
                                        <div class="col-md-3">
                                            <label for="stok_<?= $item['id_supply'] ?>">
                                                <?= $item['jenis_barang'] ?> (Stok: <?= $item['jumlah_supply'] ?>) / <?= $item['tanggal_supply'] ?>
                                            </label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="stok_<?= $item['id_supply'] ?>" id="stok_<?= $item['id_supply'] ?>" placeholder="Masukkan stok...">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<?= $this->endSection() ?>