<div class="shadow p-3 mb-3 bg-white rounded">
  <h5><b>Halaman Pelanggan</b></h5>
</div>


<?php

$pelanggan = array();
$ambil = $koneksi->query("SELECT * FROM pelanggan");
while($pecah = $ambil->fetch_assoc())
{
  $pelanggan[] = $pecah;
}

?>

<div class="card shadow bg-white">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="tables">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto Profil</th>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pelanggan as $key => $value): ?>
            <tr>
              <td width="30"><?php echo $key+1; ?></td>
              <td>
                <img src="../assets/foto_pelanggan/<?php echo $value['foto_pelanggan']; ?>" width="50" class="img-thumbnail">
              </td>
              <td><?php echo $value['nama_pelanggan']; ?></td>
              <td><?php echo $value['email_pelanggan']; ?></td>
              <td><?php echo $value['telepon_pelanggan']; ?></td>
              <td class="text-center" width="100" >
                <a href="#" class="btn btn-sm btn-danger">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>