<?php
session_start();

include 'koneksi/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Kontak</title>
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
        <li>Tentang Kami</li>
      </ul>
      <div class="row">
        <div class="col-md-3">
          <?php include 'include/sidebar.php'; ?>
        </div>

        <div class="col-md-9">
          <div class="col-md-3 about-img">
            <img src="assets/banner/produktoko.jpg">
          </div>
          <div class="col-md-9 mt-4">
            <h3>Kenapa Memilih Produk Kami</h3>
            <p>Kami selalu menemukan cara bagaimana melakukan operasi pengiriman dan pelayanan terbaik terhadap semua pelanggan.</p>
            <p>Menu navigasi sederhana dengan visual yang menarik serta proses pembayaran yang mudah untuk kamu.</p>
            <p>Setelah itu rasakan bagaimana penampilan kamu saat memegang, mengenakan, atau menggunakan produk kami.</p>
          </div>
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