<?php
session_start();

include 'koneksi/koneksi.php';

// jika pelanggan belum login
if (!isset($_SESSION['pelanggan']))
{
  echo "<script>alert('silahkan ke menu login dahulu');</script>";
  echo "<script>location='login.php';</script>";
  exit();
}

// jika isi keranjang masih kosong
if (empty($_SESSION['keranjang_belanja']) or !isset($_SESSION['keranjang_belanja'])) {
  echo "<script>alert('keranjang kosong, silahkan pilih produk untuk masuk ke keranjang');</script>";
  echo "<script>location='produk.php';</script>";
  exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Checkout</title>
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- owl-carousel-css -->
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

  <!-- custom styles -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include 'include/navbar.php'; ?>

  <section class="page-keranjang">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.php">Beranda</a></li>
        <li>Checkout Produk</li>
      </ul>

      <div class="card">
        <div class="card-body">
          
          <div class="table-responsive">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Foto</th>
                  <th>Produk</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $total = 0;
                $berat = 0;
                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) :
                  $ambil = $koneksi->query("SELECT * FROM produk
                    WHERE id_produk='$id_produk'");
                  $pecah = $ambil->fetch_assoc();
                  $subtotal = $pecah['harga_produk'] * $jumlah;
                  $subberat = $pecah['berat_produk'] * $jumlah;
                  $totalharga = $total+=$subtotal;
                  $totalberat = $berat+=$subberat;
                  ?>
                  <tr>
                    <td width="20px"><?php echo $no++; ?></td>
                    <td>
                      <img src="./assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="50">
                    </td>
                    <td><?php echo $pecah['nama_produk']; ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp <?php echo number_format($pecah['harga_produk']); ?></td>
                    <td>Rp <?php echo number_format($subtotal); ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>

              <tfoot>
                <tr>
                  <th colspan="5">Total Belanja</th>
                  <th>Rp <?php echo number_format($totalharga); ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
          
        </div>
      </div>

      <div class="row mt-3">

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" readonly>
              <!-- <br> -->
              <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['email_pelanggan']; ?>" readonly>
              <!-- <br> -->
              <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" readonly>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <form method="post">

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    Alamat :
                  </label>
                  <div class="col-sm-9">
                    <textarea type="text" name="alamat" class="form-control" placeholder="Masukkan alamat pengiriman" required></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Provinsi :</label>
                  <div class="col-sm-9">
                    <select name="provinsi" class="form-control">
                      <option>Pilih Provinsi</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kab/Kota :</label>
                  <div class="col-sm-9">
                    <select name="distrik" class="form-control">
                      <option>Pilih Kab/Kota</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Ekspedisi :</label>
                  <div class="col-sm-9">
                    <select name="ekspedisi" class="form-control">
                      <option>Pilih Ekspedisi</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Paket :</label>
                  <div class="col-sm-9">
                    <select name="paket" class="form-control">
                      <option>Pilih Paket</option>
                    </select>
                  </div>
                </div>

                <input type="text" name="total_berat" class="form-control" value="<?php echo $totalberat; ?>" hidden>
                <input type="text" name="nama_provinsi" class="form-control" hidden>
                <input type="text" name="nama_distrik" class="form-control" hidden>
                <input type="text" name="type_distrik" class="form-control" hidden>
                <input type="text" name="kode_pos" class="form-control" hidden>
                <input type="text" name="nama_ekspedisi" class="form-control" hidden>
                <input type="text" name="paket" class="form-control" hidden>
                <input type="text" name="ongkir" class="form-control" hidden>
                <input type="text" name="estimasi" class="form-control" hidden>

                <div class="row">
                  <div class="col-md-3">
                    <a href="keranjang.php" class="btn btn-info btn-sm">Kembali ke Keranjang</a>
                  </div>
                  <div class="col-md-9 text-right">
                    <button name="checkout" class="btn btn-success">Checkout</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <?php 

  if(isset($_POST['checkout']))
  {
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $tanggal_pembelian = date('y-m-d');
    $alamat = $_POST['alamat'];
    $berat = $_POST['total_berat'];
    $provinsi = $_POST['nama_provinsi'];
    $distrik = $_POST['nama_distrik'];
    $type = $_POST['type_distrik'];
    $pos = $_POST['kode_pos'];
    $ekspedisi = $_POST['nama_ekspedisi'];
    $paket = $_POST['paket'];
    $ongkir = $_POST['ongkir'];
    $estimasi = $_POST['estimasi'];
    $total_pembelian = $totalharga+$ongkir;

    $koneksi->query("INSERT INTO pembelian
      (id_pelanggan,tanggal_pembelian,total_pembelian,alamat,total_berat,provinsi,distrik,type,kode_pos,ekspedisi,paket,ongkir,estimasi)
      VALUES('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$alamat','$berat','$provinsi','$distrik','$type','$pos','$ekspedisi','$paket','$ongkir','$estimasi')");

    $id_pembelian_baru = $koneksi->insert_id;

    foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah)
    {
      $ambil = $koneksi->query("SELECT * FROM produk
        WHERE id_produk='$id_produk'");
      $pecah = $ambil->fetch_assoc();
      $nama = $pecah['nama_produk'];
      $harga = $pecah['harga_produk'];
      $berat = $pecah['berat_produk'];
      $totalharga = $pecah['harga_produk']*$jumlah;
      $totalberat = $pecah['berat_produk']*$jumlah;

      $koneksi->query("INSERT INTO pembelian_produk
        (id_pembelian,id_produk,jumlah,nama,harga,berat,totalharga,totalberat)
        VALUES('$id_pembelian_baru','$id_produk','$jumlah','$nama','$harga','$berat','$totalharga','$totalberat')");

      $koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah
        WHERE id_produk='$id_produk'");
    }

    unset($_SESSION['keranjang_belanja']);
    echo "<script>alert('pembelian produk berhasil...');</script>";
    echo "<script>location='pelanggan/index.php?page=pesanan';</script>";

  }

  ?>



  <?php include 'include/footer.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/datatables-demo.js"></script>

  <!-- owl-carousel scripts -->
  <script src="assets/js/owl.carousel.min.js"></script>

  <!-- custom scripts btn-menu -->
  <script src="assets/js/main.js"></script>

</body>

</html>