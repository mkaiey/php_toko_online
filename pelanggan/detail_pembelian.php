<div class="shadow p-3 mb-4 bg-white rounded">
  <h5><b>Detail Pesanan Pembelian</b></h5>
</div>

<?php

$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
  ON pembelian.id_pelanggan=pelanggan.id_pelanggan
  WHERE pembelian.id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

$idpembelian = $detail['id_pelanggan'];
$idpelanggan = $_SESSION['pelanggan']['id_pelanggan'];

if($idpembelian!==$idpelanggan)
{
  echo "<script>alert('session tidak ditemukan');</script>";
  echo "<script>location='index.php?page=pesanan';</script>";
}

?>

<!-- <pre><?php //print_r($detail); ?></pre> -->

<div class="row">
  <!-- data pelanggan -->
  <div class="col-md-4">
    <h6>Data Pelanggan</h6>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Nama</th>
          <td><?php echo $detail['nama_pelanggan']; ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo $detail['email_pelanggan']; ?></td>
        </tr>
        <tr>
          <th>Telepon</th>
          <td><?php echo $detail['telepon_pelanggan']; ?></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- data pembelian -->
  <div class="col-md-4">
    <h6>Data Pembelian</h6>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>No. Nota</th>
          <td><?php echo $detail['id_pembelian']; ?></td>
        </tr>
        <tr>
          <th>Tanggal</th>
          <td><?php echo $detail['tanggal_pembelian']; ?></td>
        </tr>
        <tr>
          <th>Total</th>
          <td>Rp <?php echo number_format($detail['total_pembelian']); ?></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- data pengiriman -->
  <div class="col-md-4">
    <h6>Data Pengiriman</h6>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Alamat</th>
          <td><?php echo $detail['alamat']; ?></td>
        </tr>
        <tr>
          <th>Ekspedisi</th>
          <td><?php echo $detail['ekspedisi']; ?></td>
        </tr>
        <tr>
          <th>Ongkir</th>
          <td>Rp <?php echo number_format($detail['ongkir']); ?></td>
        </tr>
      </table>
    </div>
  </div>
  
</div>

<?php 

$pp = array();
$ambil = $koneksi->query("SELECT * FROM pembelian_produk
  WHERE pembelian_produk.id_pembelian='$id_pembelian'");
while($pecah = $ambil->fetch_assoc())
{
  $pp[] = $pecah;
}

?>

<div class="card shadow bg-white mt-3">
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Berat</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pp as $key => $value): ?>
          <tr>
            <td width="20px">
              <?php echo $key+1; ?>
            </td>
            <td>
              <?php echo $value['nama']; ?>
            </td>
            <td>Rp 
              <?php echo number_format($value['harga']); ?>
            </td>
            <td>
              <?php echo number_format($value['jumlah']); ?> item
            </td>
            <td>
              <?php echo number_format($value['totalberat']); ?> gr
            </td>
            <td>
              Rp <?php echo number_format($value['totalharga']); ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<div class="alert alert-primary shadow mt-2">
  <p>
    Total pesanan setelah ditambah ongkos kirim : Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
    Silahkan lakukan pembayaran untuk proses selanjutnya..!<br>
    <strong>BANK MANDIRI NO.REK: 123-456789-01 AN. Mkai Ey. </strong>
  </p>
</div>