<div class="shadow p-3 mb-3 bg-white rounded">
  <h5><b>Halaman Pesan</b></h5>
</div>

<?php 

$pesan = array();
$ambil = $koneksi->query("SELECT * FROM pesan");
while($pecah = $ambil->fetch_assoc())
{
  $pesan[] = $pecah;
}

?>

<div class="card shadow bg-white mt-3">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="tables">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>telepon</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pesan as $key => $value): ?>
            <tr>
              <td width="30"><?php echo $key+1; ?></td>
              <td><?php echo $value['nama']; ?></td>
              <td><?php echo $value['email']; ?></td>
              <td><?php echo $value['telepon']; ?></td>
              <td class="text-center" width="150" >
                <a href="index.php?halaman=detail_pesan&id=<?php echo $value['id_pesan']; ?>" class="btn btn-sm btn-info">Lihat Pesan</a>
                <a href="index.php?halaman=hapus_pesan&id=<?php echo $value['id_pesan']; ?>" class="btn btn-sm btn-danger">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>