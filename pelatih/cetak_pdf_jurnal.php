<?php 
$kn = new mysqli("localhost","root","","db_sistem_informasi");

$tgl_mulai = $_GET["tglm"];
$tgl_selesai = $_GET['tgls'];
$id= $_GET['id_user'];

$semuadata=array();
  
    $ambl = $kn->query("SELECT * FROM tb_jurnal 
    LEFT JOIN tb_pelatih_ekstra ON
    tb_jurnal.id_user=tb_pelatih_ekstra.id_pelatih
    LEFT JOIN tb_user ON tb_jurnal.id_user = tb_user.id_user WHERE tb_jurnal.id_user = '$id' AND tb_jurnal.tanggal BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
   while($pch = $ambl->fetch_assoc())
   {
     $semuadata[]=$pch;
   }
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Jurnal <?php echo date("d-m-Y",strtotime ($tgl_mulai)) ?> S/D <?php echo date("d-m-Y",strtotime ($tgl_selesai)) ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <style>
    .container {
      text-align: center;
      margin-top: 35px;
    }
    .div-dengan-border {
            border-top: 1px solid black; 
            border-bottom: 3px solid black;
            padding: 2px;
        }
  </style>
</head>
<body>
  <div class="container">
    <div class="heading">
      <?php
      $ambl = $kn->query("SELECT tb_jurnal.nama_ekstra, tb_user.nama_lengkap FROM tb_jurnal 
      LEFT JOIN tb_user ON tb_jurnal.id_user = tb_user.id_user WHERE tb_user.id_user = '$id' "); 
      $eks = $ambl->fetch_assoc(); ?>

      <h3 style="font-weight: bold;">Laporan Jurnal Ekstrakurikuler <?php echo $eks["nama_ekstra"] ?></h3>
      <h3 style="font-weight: bold;">SMK NEGERI 1 JENANGAN</h3>
      <p><?php echo date("d F Y",strtotime ($tgl_mulai)) ?> S/D <?php echo date("d F Y",strtotime ($tgl_selesai)) ?></p>
    </div>
    <div class="div-dengan-border">
        
    </div>
    <p class="mb-4 mt-3">Nama Pelatih: <?php echo $eks["nama_lengkap"] ?></p>
    <table class="table" style="border: 2px solid black; border-collapse: collapse; font-family: 'Times New Roman', Times, serif;">
      <thead>
        <tr>
            <th style="border: 2px solid black;">No</th>
            <th style="border: 2px solid black;">Tanggal, Waktu</th>
            <th style="border: 2px solid black;">Judul Jurnal</th>
            <th style="border: 2px solid black;">Isi Jurnal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($semuadata as $key => $value): ?>
        <tr>
            <td style="border: 2px solid black;"><?php echo $key+1; ?></td>
            <td style="border: 2px solid black;"><?php echo date("d F Y H:i",strtotime($value["tanggal"])) ?></td>
            <td style="border: 2px solid black;"><?php echo $value["judul_jurnal"] ?></td>
            <td class="text-left" style="border: 2px solid black;"><?php echo $value["isi_jurnal"] ?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
</table>

  </div>
  <script>
     window.print();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>