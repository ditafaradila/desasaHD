<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="col-12 d-flex align-items-center">
                    <div class="col-9">
                        <h6 class="mb-0">Data Bahan Baku</h6>
                    </div>
                    <div class="col-3 text-end">
                        <a href="/tambahSupply" type="button" class="btn btn-outline-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#tambahBahanBaku">
                            Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-4 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    ID Barang</th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nama Barang</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jenisBarang as $jenisBarang) :
                            ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-center"><?= $jenisBarang['id_jenisBarang'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-center"><?= $jenisBarang['jenis_barang'] ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex text-center">
                                            <a href="<?= base_url('/hapusjenisBarang/' . $jenisBarang['id_jenisBarang']) ?>" class="btn btn-link text-center text-danger text-gradient px-1 mb-0" onclick="return confirm('Apakah anda yakin?')"><i class="far fa-trash-alt me-2"></i></a>
                                            <button type="button" class="btn btn-link text-dark px-1 mb-0 text-center" data-bs-toggle="modal" data-bs-target="#editBahanBaku-<?= $jenisBarang['id_jenisBarang'] ?>">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Edit Jenis Barang -->
                                <div class="modal fade" id="editBahanBaku-<?= $jenisBarang['id_jenisBarang'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Edit Bahan Baku</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: black;">&times;</span></button>
                                            </div>
                                            <form action="<?= base_url('/updateBahanBaku/' . $jenisBarang['id_jenisBarang']) ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="jenis_barang">Nama Bahan Baku</label>
                                                        <input type="text" class="form-control" name="jenis_barang" id="jenis_barang" value="<?= $jenisBarang['jenis_barang'] ?>">
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
</div>


<!-- Modal tambah bahan baku -->
<div class="modal fade" id="tambahBahanBaku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bahan Baku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/storeBahanBaku" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenis_barang">Nama Barang</label>
                            <input type="text" class="form-control" name="jenis_barang" id="jenis_barang">
                        </div>
                        <div align="center">
                            <button type="submit" class="btn bg-gradient-dark mb-0">SIMPAN PERUBAHAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>