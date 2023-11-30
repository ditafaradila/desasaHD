<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Supply</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Edit Supply</h6>
        </nav>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Supply</h6>
                </div>
                <div class="card-body px-4 pt-4 pb-2">
                    <div class="table-responsive p-0">
                        <form method="POST" action="/updateSupply/<?= $supply['id_supply'] ?>">
                            <div class="form-group">
                                <label for="nama_supply">Jenis</label>
                                <input type="text" class="form-control" name="nama_supply" id="nama_supply" value="<?= $supply['nama_supply'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_supply">Jumlah</label>
                                <input type="text" class="form-control" name="jumlah_supply" id="jumlah_supply" value="<?= $supply['jumlah_supply'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="harga_supply">Nominal</label>
                                <input type="text" class="form-control" name="harga_supply" id="harga_supply" value="<?= $supply['harga_supply'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_supply">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_supply" id="tanggal_supply" value="<?= $supply['tanggal_supply'] ?>">
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN PERUBAHAN</button>
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