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
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="id_jenisBarang">Pilih Jenis Barang:</label>
                                    <select class="form-control" id="id_jenisBarang" name="id_jenisBarang">
                                        <?php foreach ($supply as $item) : ?>
                                            <option value="<?= $item['id_jenisBarang'] ?>">
                                                <?= $item['jenis_barang'] ?> (Stok: <?= $item['total_jumlah_supply'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="jumlah_barangKeluar" id="jumlah_barangKeluar" placeholder="Masukkan stok...">
                                </div>
                            </div>

                            <br>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<?= $this->endSection() ?>