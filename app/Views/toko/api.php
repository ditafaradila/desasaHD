<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Autenfikasi</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Autenfikasi</h6>
        </nav>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row">
        <!-- <div class="col-6 text-end">
        <a href="/api" type="button" class="btn btn-outline-primary btn-sm mb-0">Tambah</a>
    </div> -->
        <div class="col-lg-4 mb-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>1. Autentifikasi Toko</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Klik tautan berikut untuk mengautentikasi toko Anda:</span>
                    </p>
                    <div align="center">
                        <a href="<?= $auth_url ?>" type="button" class="btn bg-gradient-dark mb-0">Authenticate Shop</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>2. Dapatkan Token</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('/process') ?>" id="getToken">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive p-0">
                                    <form>
                                        <div class="form-group">
                                            <label for="shop_id">Shop ID</label>
                                            <input type="text" class="form-control" name="shop_id" id="shop_id" placeholder="masukkan Shop ID">
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Code</label>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="masukkan Code">
                                        </div>
                                        <div align="center">
                                            <button type="submit" class="btn bg-gradient-dark mb-0">Dapatkan Token</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>2. Meminta Data API</h6>
                    <p class="text-sm">
                        <span class="font-weight-bold">Klik tombol untuk mengauntentifikasi toko</span>
                    </p>
                    <div align="center">
                        <a href="<?= $auth_url ?>" type="button" class="btn bg-gradient-dark mb-0">Authenticate Shop</a>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan hasil token -->
<div class="modal fade" id="tokenModal" tabindex="-1" aria-labelledby="tokenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tokenModalLabel">Hasil Token</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="accessToken"></p>
                <p id="refreshToken"></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Tampilkan modal ketika halaman dimuat
    $(document).ready(function() {
        // Tangkap submit form
        $('#getTokenForm').submit(function(e) {
            e.preventDefault();

            // Kirim request POST ke server
            $.ajax({
                type: 'POST',
                url: '<?= base_url('auth-token/process') ?>',
                data: $(this).serialize(),
                success: function(response) {
                    // Tampilkan hasil token dalam modal
                    $('#accessToken').text('Access Token: ' + response.access_token);
                    $('#refreshToken').text('Refresh Token: ' + response.refresh_token);
                    $('#tokenModal').modal('show');
                },error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>