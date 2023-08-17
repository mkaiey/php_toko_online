<?php 

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

?>

<div class="shadow p-3 mb-3 rounded">
  <h4>Update Password</h4>
</div>

<div class="shadow p-3 mb-3 rounded">
  <form method="post">

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Password Lama :</label>
      <div class="col-sm-9">
        <input type="password" name="pass_lama" class="form-control" placeholder="Masukkan password lama...">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Password Baru :</label>
      <div class="col-sm-9">
        <input type="password" name="pass_baru" class="form-control" placeholder="Masukkan password baru...">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label"></label>
      <div class="col-sm-9">
        <button name="update" class="btn btn-primary">Update</button>
      </div>
    </div>

  </form>
</div>

<?php 

if(isset($_POST['update']))
{
  $pass_lama = sha1($_POST['pass_lama']);
  $pass_baru = sha1($_POST['pass_baru']);

  $ambil = $koneksi->query("SELECT * FROM pelanggan
    WHERE password_pelanggan='$pass_lama'");
  $pass = $ambil->num_rows;

  if($pass==1)
  {
    $koneksi->query("UPDATE pelanggan SET password_pelanggan='$pass_baru'
      WHERE id_pelanggan='$id_pelanggan'");

    echo "<script>alert('password berhasil di update');</script>";
    echo "<script>location='../login.php';</script>";
  }
  else
  {
    echo "<script>alert('password tidak sesuai, update gagal..!');</script>";
    echo "<script>location='index.php?page=ubah_password';</script>";
  }
}

?>