<div class="shadow p-3 mb-3 bg-white rounded">
  <h5><b>Halaman Pesan Masuk</b></h5>
</div>

<?php

$id_pesan = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pesan
  WHERE id_pesan='$id_pesan'");
$detail = $ambil->fetch_assoc();

?>

<!-- <pre><?php //print_r($detail); ?></pre> -->

<div class="card shadow bg-white">
  <div class="card-body">
    
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama :</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="<?php echo $detail['nama']; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Email :</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="<?php echo $detail['email']; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Telepon :</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="<?php echo $detail['telepon']; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Pesan :</label>
      <div class="col-sm-9">
        <textarea class="form-control" readonly><?php echo $detail['isi_pesan']; ?></textarea>
      </div>
    </div>

  </div>
</div>