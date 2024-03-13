<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<head>
    <!-- Menggunakan Bootstrap Icons melalui CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

</head>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Keuangan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Keuangan</h6>
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
    <a href="/listKeuangan" class="floating-button"><i class="fa fa-money"></i></a>
    <div class="row">
        <!-- Pemasukan -->
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Pemasukan</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/tambahPemasukan" type="button"
                                class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
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
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Sumber</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nominal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pemasukan as $pemasukan) :
                                ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $pemasukan['sumber'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $pemasukan['tanggal'] ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Rp
                                            <?= number_format($pemasukan['jumlah']) ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="<?= base_url('/hapusPemasukan/' . $pemasukan['id_pemasukan']) ?>"
                                                class="btn btn-link text-danger text-gradient px-1 mb-0"
                                                onclick="return confirm('Apakah anda yakin?')"><i
                                                    class="far fa-trash-alt me-2"></i></a>
                                            <button type="button" class="btn btn-link text-dark px-1 mb-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPemasukan-<?= $pemasukan['id_pemasukan'] ?>">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Edit Pemasukan -->
                                <div class="modal fade" id="editPemasukan-<?= $pemasukan['id_pemasukan'] ?>"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Edit Pemasukan</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true"
                                                        style="color: black;">&times;</span></button>
                                            </div>
                                            <form
                                                action="<?= base_url('/updatePemasukan/' . $pemasukan['id_pemasukan']) ?>"
                                                method="post">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="sumber">Sumber</label>
                                                        <select name="sumber" id="sumber" class="form-control">
                                                            <option value="Toko">Toko</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" class="form-control" name="tanggal"
                                                            id="tanggal" value="<?= $pemasukan['tanggal'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah">Nominal</label>
                                                        <input type="text" class="form-control" name="jumlah"
                                                            id="jumlah" value="<?= $pemasukan['jumlah'] ?>">
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
        <!-- Pengeluaran -->
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Pengeluaran</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/tambahPengeluaran" type="button"
                                class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
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
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Keperluan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nominal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pengeluaran as $pengeluaran) :
                                ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $pengeluaran['keperluan'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $pengeluaran['tanggal'] ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Rp
                                            <?= number_format((float)$pengeluaran['nominal']) ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="<?= base_url('/hapusPengeluaran/' . $pengeluaran['id_pengeluaran']) ?>"
                                                class="btn btn-link text-danger text-gradient px-1 mb-0"
                                                onclick="return confirm('Apakah anda yakin?')"><i
                                                    class="far fa-trash-alt me-2"></i></a>
                                            <button type="button" class="btn btn-link text-dark px-1 mb-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPengeluaran-<?= $pengeluaran['id_pengeluaran'] ?>">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Edit Pengeluaran -->
                                <div class="modal fade" id="editPengeluaran-<?= $pengeluaran['id_pengeluaran'] ?>"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Edit Pengeluaran</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true"
                                                        style="color: black;">&times;</span></button>
                                            </div>
                                            <form
                                                action="<?= base_url('/updatePengeluaran/' . $pengeluaran['id_pengeluaran']) ?>"
                                                method="post">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="keperluan">Keperluan</label>
                                                        <input type="text" class="form-control" name="keperluan"
                                                            id="keperluan" value="<?= $pengeluaran['keperluan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" class="form-control" name="tanggal"
                                                            id="tanggal" value="<?= $pengeluaran['tanggal'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah">Nominal</label>
                                                        <input type="text" class="form-control" name="nominal"
                                                            id="nominal" value="<?= $pengeluaran['nominal'] ?>">
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


<?= $this->endSection() ?>