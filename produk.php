<?php
session_start();

include 'koneksi/koneksi.php';

if (isset($_GET['idkategori'])) {
  $id_kategori = $_GET['idkategori'];
  $kategori_produk = array();
  $ambil = $koneksi->query("SELECT * FROM produk JOIN kategori
    ON produk.id_kategori=kategori.id_kategori
    WHERE produk.id_kategori='$id_kategori' ");

  while ($pecah = $ambil->fetch_assoc()) {
    $kategori_produk[] = $pecah;
  }
}
elseif(isset($_GET['keyword']))
{
  $keyword = $_GET['keyword'];

  $cariproduk = array();
  $ambil = $koneksi->query("SELECT * FROM produk
    WHERE nama_produk LIKE '%$keyword%'
    OR deskripsi_produk LIKE '%$keyword%'");
  while($pecah = $ambil->fetch_assoc())
  {
    $cariproduk[] = $pecah;
  }
}
else {
  $produk = array();
  $ambil = $koneksi->query("SELECT * FROM produk JOIN kategori
    ON produk.id_kategori=kategori.id_kategori ");

  while ($pecah = $ambil->fetch_assoc()) {
    $produk[] = $pecah;
  }
}

// echo "<pre>";
// print_r($cariproduk);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Produk</title>
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

  <section class="page-produk">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.php">Beranda</a></li>
        <li>Produk</li>
        <?php if(isset($keyword)) : ?>
          <li><?php echo $keyword; ?></li>
        <?php endif ?>
      </ul>

      <div class="row">

        <div class="col-md-3">
          <?php include 'include/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
          <div class="card box">
            <div class="card-body">
              <h2>Produk Kami</h2>
              <p>
                Kami ada penawaran spesial untuk semua pelanggan, cukup dengan membeli produk dengan pilihan kategori apapun tanpa batas minimal harga pembelian, buruan sebelum kehabisan!
              </p>
            </div>
          </div>

          <div class="row produk">

            <?php if (isset($_GET['idkategori'])) : ?>

              <?php foreach ($kategori_produk as $key => $value) : ?>
                <div class="col-md-4 card-produk">
                  <div class="card">
                    <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>">
                    <div class="card-body content">
                      <h5><?php echo $value['nama_produk']; ?></h5>
                      <p>Rp <?php echo number_format($value['harga_produk']); ?></p>
                      <a href="beli.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-success">
                        <i class="fas fa-shopping-cart"></i>
                      </a>
                      <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-success">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>

            <?php elseif(isset($keyword)) : ?>
              <?php foreach ($cariproduk as $key => $value) : ?>
                <div class="col-md-4 card-produk">
                  <div class="card">
                    <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>">
                    <div class="card-body content">
                      <h5><?php echo $value['nama_produk']; ?></h5>
                      <p>Rp <?php echo number_format($value['harga_produk']); ?></p>
                      <a href="beli.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-success">
                        <i class="fas fa-shopping-cart"></i>
                      </a>
                      <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-success">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>

            <?php else : ?>

              <?php foreach ($produk as $key => $value) : ?>
                <div class="col-md-4 card-produk">
                  <div class="card">
                    <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>">
                    <div class="card-body content">
                      <h5><?php echo $value['nama_produk']; ?></h5>
                      <p>Rp <?php echo number_format($value['harga_produk']); ?></p>
                      <a href="beli.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-success">
                        <i class="fas fa-shopping-cart"></i>
                      </a>
                      <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-success">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>

            <?php endif; ?>
          </div>

          <?php if(!empty($produk)) : ?>
            <div class="pagination justify-conten-center">
              <li class="page-item prev disabled">
                <a href="#" class="page-link">prev</a>
              </li>

              <li class="page-item halaman">
                <a href="#" class="page-link active">1</a>
              </li>
              <li class="page-item dots">
                <a href="#" class="page-link">...</a>
              </li>
              <li class="page-item halaman">
                <a href="#" class="page-link">5</a>
              </li>
              <li class="page-item halaman">
                <a href="#" class="page-link">6</a>
              </li>
              <li class="page-item dots">
                <a href="#" class="page-link">...</a>
              </li>
              <li class="page-item halaman">
                <a href="#" class="page-link">10</a>
              </li>

              <li class="page-item next">
                <a href="#" class="page-link">next</a>
              </li>
            </div>

          <?php elseif(!empty($cariproduk) OR !empty($id_kategori)) : ?>
          <div class="pagination justify-conten-center">
            <li class="page-item prev disabled">
              <a href="#" class="page-link">prev</a>
            </li>

            <li class="page-item halaman">
              <a href="#" class="page-link active">1</a>
            </li>
            <li class="page-item dots">
              <a href="#" class="page-link">...</a>
            </li>
            <li class="page-item halaman">
              <a href="#" class="page-link">5</a>
            </li>
            <li class="page-item halaman">
              <a href="#" class="page-link">6</a>
            </li>
            <li class="page-item dots">
              <a href="#" class="page-link">...</a>
            </li>
            <li class="page-item halaman">
              <a href="#" class="page-link">10</a>
            </li>

            <li class="page-item next">
              <a href="#" class="page-link">next</a>
            </li>
          </div>

        <?php elseif(empty($cariproduk)) : ?>
          <div class="col-md-12">
            <div class="alert alert-info shadow">
              <p>Pencarian produk tidak ditemukan</p>
            </div>
          </div>
        <?php endif ?>

      </div>

    </div>
  </div>
</section>

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