<?php 

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan
  WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();

?>

<div class="shadow p-3 mb-3 rounded">
  <h4>Update Profil</h4>
</div>

<div class="shadow p-3 mb-3 rounded">
  <form method="post" enctype="multipart/form-data">

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama :</label>
      <div class="col-sm-9">
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Email :</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $pecah['email_pelanggan']; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Password :</label>
      <div class="col-sm-9">
        <input type="password" class="form-control" value="<?php echo $pecah['password_pelanggan']; ?>" readonly>
        <a href="index.php?page=ubah_password" class="btn btn-sm btn-primary mt-1">Ganti Password</a>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">No. Hp. :</label>
      <div class="col-sm-9">
        <input type="text" name="telepon" class="form-control" value="<?php echo $pecah['telepon_pelanggan']; ?>">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Alamat :</label>
      <div class="col-sm-9">
        <textarea type="text" name="alamat" class="form-control"><?php echo $pecah['alamat_pelanggan']; ?></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Foto :</label>
      <div class="col-sm-9">
        <img src="../assets/foto_pelanggan/<?php echo $pecah['foto_pelanggan']; ?>" width="150">
        <input type="file" name="foto" class="form-control">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label"></label>
      <div class="col-sm-9">
        <button name="simpan" class="btn btn-primary">Simpan</button>
      </div>
    </div>

  </form>
</div>

<?php 

if(isset($_POST['simpan']))
{
  $nama = $_POST['nama'];
  $pass = sha1($_POST['password']);
  $telp = $_POST['telepon'];
  $alamat = $_POST['alamat'];

  $nama_foto = $_FILES['foto']['name'];
  $lokasi_foto = $_FILES['foto']['tmp_name'];

  move_uploaded_file($lokasi_foto, "../assets/foto_pelanggan/".$nama_foto);

  if(!empty($lokasi_foto))
  {
    $koneksi->query("UPDATE pelanggan SET
      nama_pelanggan = '$nama',
      password_pelanggan = '$pass',
      telepon_pelanggan = '$telp',
      alamat_pelanggan = '$alamat',
      foto_pelanggan = '$nama_foto'
      WHERE id_pelanggan='$id_pelanggan'");
  }
  else
  {
    $koneksi->query("UPDATE pelanggan SET
      nama_pelanggan = '$nama',
      telepon_pelanggan = '$telp',
      alamat_pelanggan = '$alamat'
      WHERE id_pelanggan='$id_pelanggan'");
  }
  echo "<script>alert('data profil berhasil di update');</script>";
  echo "<script>location='index.php';</script>";
}

?>