<?php
// Require composer autoload
require_once '../koneksi/koneksi.php';
require_once '../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();



$tgl_mulai = $_GET['tglm'];
$tgl_selesai = $_GET['tgls'];
$status = $_GET['status'];

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

$html ='
<h2 style="text-align: center; background: #ccc;  margin: 0 500px 0;">Laporan Transaksi <b style="font-style: italic;"><span style="color: red; font-style: italic;">Toko</span><strong style="color: whitesmoke;">Online</strong></b></h2>
<div style="border: 2px solid black; margin: 3px 500px 3px;"></div>
<table border="1" style="border: 1px solid #f2f2f2; color: #232323; width: 100%; text-align: center; margin-top: 20px;">
  <tr style="background: #35a9db; color: #fff;">
    <th>No</th>
    <th>Nama</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th>Jumlah</th>
  </tr>';

  $total = 0;
  foreach ($semuadata as $key => $value):
  $total+=$value['total_pembelian'];
  $no = $key+1;
  $nama = $value['nama_pelanggan'];
  $tanggal = date("d F Y", strtotime($value['tanggal_pembelian']));
  $status = $value['status'];
  $jumlah = number_format($value['total_pembelian']);
  $totals = number_format($total);

  $html.='
  <tr>
    <th>'.$no.'</th>
    <th>'.$nama.'</th>
    <th>'.$tanggal.'</th>
    <th>'.$status.'</th>
    <th>Rp '.$jumlah.'</th>
  </tr>';

endforeach;

$html.='
  <tr>
    <th colspan="4">Total</th>
    <th>Rp '.$totals.' </th>
  </tr>
</table>';

// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
