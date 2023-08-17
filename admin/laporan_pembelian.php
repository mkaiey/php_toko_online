<div class="shadow p-3 mb-3 bg-white rounded">
  <h5><b>Halaman Laporan Pembelian</b></h5>
</div>

<?php 

if(isset($_POST['cari']))
{
  $tgl_mulai = $_POST['tglm'];
  $tgl_selesai = $_POST['tgls'];
  $status = $_POST['status'];

  $semuadata = array();
  $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE status='$status' AND tanggal_pembelian
    BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
  while($pecah = $ambil->fetch_assoc())
  {
    $semuadata[] = $pecah;
  }

  // echo "<pre>";
  // print_r($semuadata);
  // echo "</pre>";

}

?>

<div class="card shadow bg-white">
  <div class="card-body">
    <form method="post">
      <div class="row">

        <div class="col-md-4">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Mulai :</label>
            <div class="col-sm-8">
              <input type="date" name="tglm" class="form-control" value="<?php echo $tgl_mulai; ?>">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Selesai :</label>
            <div class="col-sm-8">
              <input type="date" name="tgls" class="form-control" value="<?php echo $tgl_selesai; ?>">
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group row">
            <div class="col-sm-12">
              <select name="status" class="form-control">
                <option>Pilih Status</option>
                <option value="pending">Pending</option>
                <option value="diproses">Proses Penyiapan</option>
                <option value="konfirmasi">Pembayaran dikonfirmasi</option>
                <option value="kirim">Barang dikirim</option>
                <option value="batal">Pengiriman dibatalkan</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-1">
          <button name="cari" class="btn btn-sm btn-primary">
            <i class="fas fa-search"></i>
          </button>
        </div>

      </div>
    </form>
  </div>
</div>

<?php if(!empty($semuadata)): ?>
  <div class="alert alert-info shadow mt-3">
    <h6>
      <b>Catatan transaksi terhitung tanggal <?php echo date("d F Y", strtotime($tgl_mulai)); ?> s/d <?php echo date("d F Y", strtotime($tgl_selesai)); ?></b>
    </h6>
  </div>
<?php endif ?>

<div class="card shadow bg-white mt-2">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="tables">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($semuadata)): ?>
            <?php $total = 0; ?>
            <?php foreach ($semuadata as $key => $value): ?>
              <?php $totals = $total+=$value['total_pembelian']; ?>
              <tr>
                <td width="30"><?php echo $key+1; ?></td>
                <td><?php echo $value['nama_pelanggan']; ?></td>
                <td><?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?></td>
                <td><?php echo $value['status']; ?></td>
                <td>Rp <?php echo number_format($value['total_pembelian']); ?></td>
              </tr>
            <?php endforeach ?>
          <?php else: ?>
            <tr class="text-center">
              <td colspan="5" class="alert alert-danger shadow">
                <h6><strong>tidak ada data yang dicari</strong></h6>
              </td>
            </tr>
          <?php endif ?>
        </tbody>
        <tfoot>
          <?php if(!empty($semuadata)): ?>
            <tr>
              <th colspan="4">Total</th>
              <th>Rp <?php echo number_format($totals); ?></th>
            </tr>
          <?php endif ?>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php if(!empty($semuadata)): ?>
<div class="alert alert-primary shadow mt-2">
  <a href="download_laporan.php?tglm=<?php echo $tgl_mulai; ?>&tgls=<?php echo $tgl_selesai; ?>&status=<?php echo $status; ?>" class="btn btn-success">Unduh Laporan</a>
</div>
<?php endif ?>