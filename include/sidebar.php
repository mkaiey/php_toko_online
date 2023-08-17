<?php

include 'koneksi/koneksi.php';

$kategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while($pecah = $ambil->fetch_assoc())
{
  $kategori[] = $pecah;
}

?>

<div class="card">
  <div class="card-header">
    <h4>Kategori Produk</h4>
  </div>
  <div class="card-body">
    <ul class="nav navpills flex-column">
    <?php foreach ($kategori as $key => $value) : ?>
      <li class="nav-item">
        <a href="produk.php?idkategori=<?php echo $value['id_kategori']; ?>" class="nav-link">
          <?php echo $value['nama_kategori']; ?>
        </a>
      </li>
      <?php endforeach ?>
      <li class="nav-item">
        <a href="produk.php" class="nav-link">
          Semua Produk
        </a>
      </li>
    </ul>
  </div>
</div>