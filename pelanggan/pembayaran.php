<div class="shadow bg-white p-3 mb-3 rounded">
  <h3><strong>Menu Pembayaran</strong></h3>
</div>

<?php 

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembelian
  WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

?>

<div class="alert alert-primary shadow text-dark">
  Total tagihan anda: <b>Rp. <?php echo number_format($pecah['total_pembelian']); ?></b>
</div>

<div class="shadow bg-white p-3 mb-3 rounded">
  <form method="post" enctype="multipart/form-data">

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama :</label>
      <div class="col-sm-9">
        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Bank :</label>
      <div class="col-sm-6">
        <select name="bank" class="form-control">
          <option selected disabled>Pilih Bank</option>
          <option value="bri">BRI</option>
          <option value="bni">BNI</option>
          <option value="btn">BTN</option>
          <option value="mandiri">MANDIRI</option>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Jumlah : (Rp)</label>
      <div class="col-sm-6">
        <input type="text" name="jumlah" class="form-control" value="<?php echo ($pecah['total_pembelian']); ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Bukti :</label>
      <div class="col-sm-9">
        <input type="file" name="bukti" class="form-control" required>
        <small class="text-danger">Foto bukti harus format jpg/png max uk. 2mb</small>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label"></label>
      <div class="col-sm-9">
        <button name="kirim" class="btn btn-primary">Kirim</button>
      </div>
    </div>

  </form>
</div>

<?php 

if(isset($_POST['kirim']))
{
  $nama = $_POST['nama'];
  $bank = $_POST['bank'];
  $jumlah = $_POST['jumlah'];
  $tanggal = date('Y-m-d');

  $nama_bukti = $_FILES['bukti']['name'];
  $lokasi_bukti = $_FILES['bukti']['tmp_name'];
  $tgl_bukti = date('YmdHis').$nama_bukti;

  move_uploaded_file($lokasi_bukti, "../assets/foto_bukti/".$tgl_bukti);

  $koneksi->query("INSERT INTO pembayaran
    (id_pembelian,nama,bank,jumlah,tanggal,bukti)
    VALUES ('$id_pembelian','$nama','$bank','$jumlah','$tanggal','$tgl_bukti')");

  $koneksi->query("UPDATE pembelian SET status='diproses'
    WHERE id_pembelian='$id_pembelian'");

  echo "<script>alert('detail pembayaran terkirim');</script>";
  echo "<script>location='index.php?page=pesanan';</script>";
}

?>