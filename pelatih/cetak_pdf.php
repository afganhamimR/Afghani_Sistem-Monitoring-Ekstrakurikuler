<?php 
$kn = new mysqli("localhost","root","","db_sistem_informasi");

 $tgl_mulai = $_GET["tglm"];
 $tgl_selesai = $_GET['tgls'];
$status= $_GET['status'];
$kelas= $_GET['kelas'];
$id= $_GET['id_user'];

$semuadata=array();

 $ambl = $kn->query("SELECT tb_user.nama_lengkap, tb_user.id_user, tb_kelas.nis, max(tb_absensi.keterangan), max(tb_absensi.waktu_absen), max(tb_kelas.kelas) as kelas FROM tb_absensi 
    INNER JOIN tb_user ON tb_absensi.id_user = tb_user.id_user
    INNER JOIN tb_kelas ON tb_absensi.id_kelas = tb_kelas.id_kelas
    INNER JOIN tb_pelatih_ekstra ON tb_absensi.id_pelatih = tb_pelatih_ekstra.id_pelatih
    WHERE tb_absensi.id_pelatih='$id' AND tb_absensi.kelas= '$kelas' AND tb_absensi.status= '$status' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND '$tgl_selesai' GROUP BY tb_user.nama_lengkap");
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
  <title>Laporan Absensi <?php echo date("d-m-Y",strtotime ($tgl_mulai)) ?> S/D <?php echo date("d-m-Y",strtotime ($tgl_selesai)) ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <style>
    * {
      font-family: 'Times New Roman', Times, serif;
    }
    .container {
      text-align: center;
      margin-top: 65px;
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
      $ambl = $kn->query("SELECT nama_ekstra FROM tb_absensi WHERE id_pelatih = '$id' "); 
      $eks = $ambl->fetch_assoc(); ?>

      <h3 style="font-weight: bold;">Laporan Absensi Ekstrakurikuler <?php echo $eks["nama_ekstra"] ?></h3>
      <h3 style="font-weight: bold;">SMK NEGERI 1 JENANGAN</h3>
      <p><?php echo date("d F Y",strtotime ($tgl_mulai)) ?> S/D <?php echo date("d F Y",strtotime ($tgl_selesai)) ?></p>
    </div>
    <div class="div-dengan-border">
        
    </div>
    <p class="mb-4 mt-3">Status: <?php echo $status ?></p>
    <table class="table" style="border: 2px solid black; border-collapse: collapse;">
      <thead>
        <tr>
          <th style="border: 2px solid black;">No</th>
          <th style="border: 2px solid black;">Nama Siswa</th>
          <th style="border: 2px solid black;">NIS</th>
          <th style="border: 2px solid black;">Kelas</th>
          <th style="border: 2px solid black;">Hadir</th>
          <th style="border: 2px solid black;">Tidak Hadir</th>
          <th style="border: 2px solid black;">Sakit</th>
          <th style="border: 2px solid black;">Izin</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($semuadata as $key => $value): ?>
        <tr>
            <td style="border: 2px solid black;"><?php echo $key+1; ?></td>
            <td style="border: 2px solid black; text-align: left;"><?php echo $value["nama_lengkap"] ?></td>
            <td style="border: 2px solid black;"><?php echo $value["nis"] ?></td>
            <td style="border: 2px solid black;"><?php echo $value["kelas"] ?></td>            
           <?php    

           $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_hadir FROM tb_absensi WHERE keterangan = 'Hadir' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $hadir = $ambl->fetch_assoc();
            ?>
            <td style="border: 2px solid black;"> <?php  
                 echo $hadir["total_hadir"]; 
            ?>
            </td>

            <?php   
            $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_tidak_hadir FROM tb_absensi WHERE keterangan = 'Tidak Hadir' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $tidak_hadir = $ambl->fetch_assoc();
            ?>
            <td style="border: 2px solid black;"> <?php  
                 echo $tidak_hadir["total_tidak_hadir"]; 
            ?>
            </td>

            <?php   
            $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_sakit FROM tb_absensi WHERE keterangan = 'Sakit' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $sakit = $ambl->fetch_assoc();
            ?>
            <td style="border: 2px solid black;"> <?php  
                 echo $sakit["total_sakit"]; 
            ?>
            </td>

            <?php  
            $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_izin FROM tb_absensi WHERE keterangan = 'Izin' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $izin = $ambl->fetch_assoc();
            ?>
            <td style="border: 2px solid black;"> <?php  
                 echo $izin["total_izin"]; 
            ?>
            </td>
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