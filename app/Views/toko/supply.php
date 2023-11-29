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
            <h6 class="font-weight-bolder mb-0">Supply</h6>
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
                            <a href="/tambahSupply" type="button"
                                class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
                            <!-- <button class="btn btn-outline-primary btn-sm mb-0">Tambah</button> -->
                        </div>
                    </div>

                    <!-- <h6>Pengeluaran</h6>
                    <button class="btn info align-left text-center">
                        <span class="text-secondary text-xs font-weight-bold">Tambah</span>
                    </button> -->

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
                                        Jenis</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah</th>
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
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">1</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Bunga</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">10</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">1.000.000</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-link text-danger text-gradient px-1 mb-0"
                                            href="javascript:;"><i class="far fa-trash-alt me-2"></i></a>
                                        <a class="btn btn-link text-dark px-1 mb-0" href="javascript:;"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
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
                            <!-- <a href="/tambahKeuangan" type="button" class="btn btn-outline-primary btn-sm mb-0">Tambah</a> -->
                            <button class="btn btn-outline-primary btn-sm mb-0">Tambah</button>
                        </div>
                    </div>

                    <!-- <h6>Pengeluaran</h6>
                    <button class="btn info align-left text-center">
                        <span class="text-secondary text-xs font-weight-bold">Tambah</span>
                    </button> -->

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
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">1</span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Bunga</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">10</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">1.000.000</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-link text-danger text-gradient px-1 mb-0"
                                            href="javascript:;"><i class="far fa-trash-alt me-2"></i></a>
                                        <a class="btn btn-link text-dark px-1 mb-0" href="javascript:;"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i></a>
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