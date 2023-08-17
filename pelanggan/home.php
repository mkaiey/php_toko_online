<?php 

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan
  WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();

?>

<div class="shadow p-3 mb-3 rounded">
  <h4>Selamat Datang <strong><?php echo $pecah['nama_pelanggan']; ?></strong></h4>
</div>

<div class="shadow p-3 mb-3 rounded">
  <form method="post" enctype="multipart/form-data">

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama :</label>
      <div class="col-sm-9">
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Email :</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $pecah['email_pelanggan']; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">No. Hp. :</label>
      <div class="col-sm-9">
        <input type="text" name="telepon" class="form-control" value="<?php echo $pecah['telepon_pelanggan']; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Alamat :</label>
      <div class="col-sm-9">
        <textarea type="text" name="alamat" class="form-control" readonly><?php echo $pecah['alamat_pelanggan']; ?></textarea>
      </div>
    </div>



  </form>
</div>