<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Keuangan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Tambah Pengeluaran</h6>
        </nav>
    </div>
</nav>

<form method="POST" action="/storePengeluaran">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tambah Pengeluaran</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        <div class="table-responsive p-0">
                            <form>
                                <div class="form-group">
                                    <label for="sumber">Keperluan</label>
                                    <input type="text" class="form-control" name="keperluan" id="keperluan" placeholder="Masukkan huruf. Contoh: Membeli akrilik.">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal">
                                </div> -->
                                <div class="form-group">
                                    <label for="jumlah">Nominal</label>
                                    <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Masukkan nominal tanpa titik. Contoh: 20000">
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
    </div>
</form>


<?= $this->endSection() ?>