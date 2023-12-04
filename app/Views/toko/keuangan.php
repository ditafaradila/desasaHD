<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Keuangan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Keuangan</h6>
        </nav>
    </div>
</nav>

<div class="container-fluid py-4">
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
                            <a href="/tambahPemasukan" type="button" class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
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
                                        Sumber</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nominal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                <form method="POST" action="/hapusPemasukan/<?= $pemasukan['id_pemasukan'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" name="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" class="btn btn-link text-danger text-gradient px-1 mb-0"><i class="far fa-trash-alt me-2"></i></button>
                                                </form>
                                                <a href="/editPemasukan/<?= $pemasukan['id_pemasukan'] ?>" type="button" class="btn btn-link text-dark px-1 mb-0"><i class="fa fa-pencil"></i></a>
                                            </div>
                                        </td>
                                    </tr>
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
                            <a href="/tambahPengeluaran" type="button" class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
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
                                            Keperluan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nominal</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                <span class="text-secondary text-xs font-weight-bold">Rp <?= number_format($pengeluaran['nominal']) ?></span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="POST" action="/hapusPengeluaran/<?= $pengeluaran['id_pengeluaran'] ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" name="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" class="btn btn-link text-danger text-gradient px-1 mb-0"><i class="far fa-trash-alt me-2"></i></button>
                                                    </form>
                                                    <a href="/editPengeluaran/<?= $pengeluaran['id_pengeluaran'] ?>" type="button" class="btn btn-link text-dark px-1 mb-0"><i class="fa fa-pencil"></i></a>
                                                </div>
                                            </td>
                                        </tr>
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