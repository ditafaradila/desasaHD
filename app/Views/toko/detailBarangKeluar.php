<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Supply</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Detail Barang Keluar</h6>
        </nav>
    </div>
</nav>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="col-12 d-flex align-items-center">
                    <div class="col-9">
                        <h6 class="mb-0">Barang Keluar</h6>
                    </div>
                    <div class="col-3 text-end">
                        <a href="/tambahBarangKeluar" type="button"
                            class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Jenis</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Jumlah</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanggal</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                                    foreach ($barangKeluar as $barangKeluar) :
                                    ?>
                            <tr>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0"><?= $barangKeluar['jenis_barang'] ?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $barangKeluar['jumlah_barangKeluar'] ?>
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?= $barangKeluar['tanggal_barangKeluar'] ?></span>
                                </td>
                                <td class="align-middle text-center">
                                    <div>
                                        <a href="<?= base_url('/hapusBK/' . $barangKeluar['id_barangKeluar']) ?>"
                                            class="btn btn-link text-danger text-gradient px-1 mb-0"
                                            onclick="return confirm('Apakah anda yakin?')"><i
                                                class="far fa-trash-alt me-2"></i></a>
                                        <button type="button" class="btn btn-link text-dark px-1 mb-0"
                                            data-bs-toggle="modal" data-bs-target="#editBK-155">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="editBK-<?= $barangKeluar['id_barangKeluar'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Edit Barang Keluar</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true"
                                                    style="color: black;">&times;</span></button>
                                        </div>
                                        <form action="<?= base_url('/updateBK/' . $barangKeluar['id_barangKeluar']) ?>"
                                            method="post">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="jumlah_barangKeluar">Jumlah</label>
                                                    <input type="text" class="form-control" name="jumlah_barangKeluar"
                                                        id="jumlah_barangKeluar"
                                                        value="<?= $barangKeluar['jumlah_barangKeluar'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_barangKeluar">Tanggal</label>
                                                    <input type="date" class="form-control" name="tanggal_barangKeluar"
                                                        id="tanggal_barangKeluar"
                                                        value="<?= $barangKeluar['tanggal_barangKeluar'] ?>">
                                                </div>
                                                <div align="center">
                                                    <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN
                                                        PERUBAHAN</button>
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
</div>
</div>
</div>
<?= $this->endSection() ?>