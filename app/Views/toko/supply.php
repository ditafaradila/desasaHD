<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Supply</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Supply</h6>
        </nav>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Barang Masuk -->
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Barang Masuk</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/tambahSupply" type="button" class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jenis</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nominal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($supply as $supply) :
                                ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $supply['nama_supply'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $supply['jumlah_supply'] ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">Rp
                                                <?= number_format($supply['harga_supply']) ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $supply['tanggal_supply'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex" align="center">
                                                <a href="<?= base_url('/hapusSupply/' . $supply['id_supply']) ?>" class="btn btn-link text-danger text-gradient px-1 mb-0" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt me-2"></i></a>
                                                <button type="button" class="btn btn-link text-dark px-1 mb-0" data-bs-toggle="modal" data-bs-target="#editSupply-<?= $supply['id_supply'] ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Supply -->
                                    <div class="modal fade" id="editSupply-<?= $supply['id_supply'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLabel">Edit Supply</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: black;">&times;</span></button>
                                                </div>
                                                <form action="<?= base_url('/updateSupply/' . $supply['id_supply']) ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-body">
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
                                                        <div align="center">
                                                            <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN PERUBAHAN</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endforeach
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Barang Keluar -->
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Barang Keluar</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/tambahSupply" type="button" class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jenis</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nominal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"></span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Rp</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"></span>
                                    </td>
                                    <td>
                                        <div class="d-flex" align="center">
                                            <form method="POST" action="/hapusSupply/">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" name="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" class="btn btn-link text-danger text-gradient px-1 mb-0"><i class="far fa-trash-alt me-2"></i></button>
                                            </form>
                                            <a href="/editSupply/" type="button" class="btn btn-link text-dark px-1 mb-0"><i class="fa fa-pencil"></i></a>
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
</div>

<?= $this->endSection() ?>