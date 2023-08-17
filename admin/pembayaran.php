<div class="shadow p-3 mb-3 bg-white rounded">
  <h5><b>Halaman Info Pembayaran</b></h5>
</div>

<?php 

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran
  WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

?>

<!-- <pre><?php //print_r($pecah) ?></pre> -->

<div class="card shadow bg-white">
  <div class="card-body row">

    <div class="col-md-8">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Nama Pelanggan</th>
            <td><?php echo $pecah['nama']; ?></td>
          </tr>
          <tr>
            <th>Nama Bank</th>
            <td><?php echo $pecah['bank']; ?></td>
          </tr>
          <tr>
            <th>Jumlah Pembayaran</th>
            <td>Rp <?php echo number_format($pecah['jumlah']); ?></td>
          </tr>
          <tr>
            <th>Tanggal</th>
            <td><?php echo date("d F Y", strtotime($pecah['tanggal'])); ?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="col-md-4">
      <img src="../assets/foto_bukti/<?php echo $pecah['bukti']; ?>" width="350" class="img-thumbnail img-responsive"> <br>
      <small class="text-success">Foto bukti pembayaran yang dikirim</small>
    </div>

  </div>
  <div class="card-footer">
    <form method="post">

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">No. Resi Pengiriman :</label>
        <div class="col-sm-6">
          <input type="text" name="resi" class="form-control" placeholder="Masukkan no. resi" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Status :</label>
        <div class="col-sm-4">
          <select name="status" class="form-control">
            <option selected disabled>Pilih Status</option>
            <option value="konfirmasi">Pembayaran dikonfirmasi</option>
            <option value="kirim">Barang dikirim</option>
            <option value="batal">Pengiriman dibatalkan</option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label"></label>
        <div class="col-sm-6">
          <button name="proses" class="btn btn-sm btn-primary">Proses</button>
        </div>
      </div>

    </form>
  </div>
</div>

<?php 

if(isset($_POST['proses']))
{
  $resi = $_POST['resi'];
  $status = $_POST['status'];

  $koneksi->query("UPDATE pembelian SET
    resi_pengiriman='$resi',
    status='$status'
    WHERE id_pembelian='$id_pembelian'");

  echo "<script>alert('data pembelian berhasil di update');</script>";
  echo "<script>location='index.php?halaman=pembelian';</script>";
}


?>