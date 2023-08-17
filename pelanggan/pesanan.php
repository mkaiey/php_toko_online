<div class="shadow bg-white p-3 mb-3 rounded">
  <h3><strong>Pesanan Saya</strong></h3>
</div>

<?php 

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
  ON pembelian.id_pelanggan=pelanggan.id_pelanggan
  WHERE pembelian.id_pelanggan='$id_pelanggan'");
while($pecah = $ambil->fetch_assoc())
{
  $pembelian[] = $pecah;
}

?>

<div class="card shadow">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover tabel-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Opsi Pesanan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pembelian as $key => $value): ?>
            <tr>
              <td>
                <?php echo $key+1; ?>
              </td>
              <td>
                <?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?>
              </td>
              <td>Rp 
                <?php echo number_format($value['total_pembelian']); ?>
              </td>

              <?php if($value['status']=='pending') : ?>
                <td class="text-center text-danger">
                  <?php echo $value['status']; ?> <br>
                  <!-- tambah info resi pengiriman -->
                  <?php if(!empty($value['resi_pengiriman'])) : ?>
                    <?php echo $value['resi_pengiriman']; ?>
                  <?php endif ?>
                </td>
              <?php else: ?>
                <td class="text-center text-success">
                  <?php echo $value['status']; ?> <br>
                  <!-- tambah info resi pengiriman -->
                  <?php if(!empty($value['resi_pengiriman'])) : ?>
                    <?php echo $value['resi_pengiriman']; ?>
                  <?php endif ?>
                </td>
              <?php endif ?>

              <td class="text-center" width="250">
                <a href="index.php?page=detail_pembelian&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-primary">Nota</a>
                <!-- jika status masih pending -->
                <?php if($value['status']=='pending'): ?>
                  <a href="index.php?page=pembayaran&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-success">Proses Bayar</a>
                  <!-- jika status sedang diproses -->
                <?php else: ?>
                  <a href="index.php?page=detail_pembayaran&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-warning">Detail Bayar</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>