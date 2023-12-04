<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Produk</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Produk</h6>
        </nav>
    </div>
</nav>

<form method="POST" action="/storePengeluaran">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Produk</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        <div class="table-responsive p-0">
                            <form>
                                <div class="form-group">
                                    <label for="sumber">Nama Produk</label>
                                    <input type="text" class="form-control" name="keperluan" id="keperluan">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Harga</label>
                                    <input type="text" class="form-control" name="tanggal" id="tanggal">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Nominal</label>
                                    <input type="text" class="form-control" name="nominal" id="nominal">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Masukkan foto</label>
                                    <div>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
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

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://i.pinimg.com/736x/63/61/e9/6361e9674d6ef39af6c25e6a47cfb2f8.jpg"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Coriolanus Snow</h5>
                    <p class="card-text">nda dijual bg</p>
                </div>
                <div class="plus-minus-element">
                    <button class="dec plus-minus-element__button">-</button>
                    <input type="text" name="" value="2">
                    <button class="inc plus-minus-element__button">+</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     $(".plus-minus-element__button").on("click", function() {

var $button = $(this);
var oldValue = $button.parent().find("input").val();

if ($button.text() == "+") {
  var newVal = parseFloat(oldValue) + 1;
} else {
 // Don't allow decrementing below zero
  if (oldValue > 0) {
    var newVal = parseFloat(oldValue) - 1;
  } else {
    newVal = 0;
  }
}

$button.parent().find("input").val(newVal);

});
</script>

<?= $this->endSection() ?>