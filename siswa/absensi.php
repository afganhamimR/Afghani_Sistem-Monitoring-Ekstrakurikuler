<?php
session_start();

$kn = new mysqli("localhost","root","","db_sistem_informasi");

if($_SESSION['role']==""){
    header("location:../index.php");
  }
  elseif ($_SESSION['role']=="pelatih") {
    header("location:../index.php");
  }
    elseif ($_SESSION['role']=="kesiswaan") {
    header("location:../index.php");
  }

$User_id = $_SESSION["user"]["id_user"];

$ambl = $kn->query("SELECT * FROM tb_ekstra_diikuti, tb_buat_absensi WHERE tb_buat_absensi.id_ekstra= '$_GET[id]' AND tb_ekstra_diikuti.id_user= '$User_id'");
$perabsen = $ambl->fetch_assoc();

$query = $kn->query("SELECT MAX(id_buat_absensi) AS max_id FROM tb_buat_absensi WHERE id_ekstra = '$_GET[id]' ");
$row = $query->fetch_assoc();
$id_buat_absensi_baru = $row['max_id'];

$result = $kn->query("SELECT keterangan, status, waktu_absen FROM tb_absensi WHERE id_ekstra= '$_GET[id]' and id_user= '$User_id' and id_buat_absensi = '$id_buat_absensi_baru' ");
$perket = $result->fetch_assoc();


// Isi Absensi otomatis

if (!empty($perabsen['tanggal'])) {
    $tanggal_absensi = $perabsen['tanggal'];

    date_default_timezone_set('Asia/Jakarta');

    $tanggal_sekarang = date('Y-m-d');

    $tanggal_absensi_timestamp = strtotime($tanggal_absensi);
    $tanggal_absensi_formatted = date('Y-m-d', $tanggal_absensi_timestamp);

    if ($tanggal_sekarang > $tanggal_absensi_formatted) {
        $user_id = $_SESSION["user"]["id_user"];
        $idKelas = $perabsen['id_kelas'];
        $IDeks_diikuti = $perabsen['id_ekstra_diikuti'];
        $ekstra_name =  $perabsen['nama_ekstra'];
        $idCreAbsen = $perabsen['id_buat_absensi'];
        $coach = $perabsen['id_pelatih'];
        $id_Eks = $perabsen['id_ekstra'];
        $kelas = $kn->query("SELECT kelas FROM tb_kelas WHERE id_kelas = '$idKelas'");
        $perkelas = $kelas->fetch_assoc();

        $namaKelas = $perkelas['kelas'];

        $query = $kn->query("SELECT MAX(id_buat_absensi) AS max_id_buat FROM tb_buat_absensi WHERE id_ekstra = '$_GET[id]' ");
        $id_baru = $query->fetch_assoc();
        $id_buat_baru = $id_baru['max_id_buat'];

        $absensi_sudah_dilakukan = $kn->query("SELECT COUNT(*) as total_absen FROM tb_absensi WHERE id_user = '$user_id' AND id_ekstra = '$_GET[id]' AND id_buat_absensi = '$id_buat_baru'");
        $data_absensi = $absensi_sudah_dilakukan->fetch_assoc();
        $total_absensi = $data_absensi['total_absen'];

        if ($total_absensi == 0) {
            $kn->query("INSERT INTO tb_absensi 
                (id_ekstra, id_user, id_pelatih, id_buat_absensi, id_kelas, kelas, id_ekstra_diikuti, nama_ekstra, keterangan, status)
                VALUES ('$id_Eks','$user_id','$coach', '$idCreAbsen', '$idKelas', '$namaKelas', '$IDeks_diikuti', '$ekstra_name', 'Tidak Hadir', 'Dikonfirmasi')");
            
            echo "<script>location.href='absensi.php?id=" . urlencode($perabsen['id_ekstra']) . "';</script>";
        } else {
            'sudah absensi';
        }
    }
} else {
    'Tanggal absensi tidak tersedia'; 
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Siswa | Absensi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Open+Sans:wght@500&family=Quicksand:wght@500;600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/home.css" rel="stylesheet">

</head>

<body>

  <?php include 'navbar.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/stmj.jpeg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Absensi</h2>
        <ol>
          <li><a href="ekstra_diikuti.php">Ekstrakurikuler Diikuti</a></li>
          <li>Absensi</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container">

        <div class="table-responsive">
        <table class="table table-bordered">
        <thead style="background-color: #67999A;" class="table text-white">
          <tr>
            <th>Hari</th>
            <th>Tanggal</th>
            <th>Absensi</th>
            <th>Keterangan</th>
            <th>Waktu Absensi</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>

     <?php if ($perabsen) { ?>
    <tr>
        <td><?php echo $perabsen['hari']; ?></td>
        <td><?php echo date("d F Y", strtotime($perabsen['tanggal'])); ?></td>

        <?php 
        
        $hideButton = false;

        if ($perket && $result->num_rows > 0) {
            $result->data_seek(0);
            while ($PerKet = $result->fetch_assoc()) {
                
                if ($PerKet['keterangan'] == "Hadir" || $PerKet['keterangan'] == "Izin" || $PerKet['keterangan'] == "Sakit" || $PerKet['keterangan'] == "Tidak Hadir") {
                    $hideButton = true;
                    break; 
                }
            }
        } else {
            
            $hideButton = false;
        }
        ?>

        <?php if ($hideButton) { ?>
            <td colspan="1">Sudah Absensi</td>
        <?php } else { ?>
            <td>
                <button id="isiKehadiranBtn" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#absenModal">Isi Kehadiran
                </button>
            </td>
        <?php } ?>

        <?php if ($perket && $result->num_rows > 0) { ?>
            <?php $result->data_seek(0); ?>
            <?php while ($PerKet = $result->fetch_assoc()) { ?>
                <td>
                    <?php if ($PerKet['keterangan'] == "Hadir"): ?>
                        <p>Hadir</p>
                    <?php elseif ($PerKet['keterangan'] == "Izin"): ?>
                        <p>Izin</p>
                    <?php elseif ($PerKet['keterangan'] == "Sakit"): ?>
                        <p>Sakit</p>
                    <?php elseif ($PerKet['keterangan'] == "Tidak Hadir"): ?>
                        <p>Tidak Hadir</p>
                    <?php endif ?>
                </td>
                <td><?php echo date('d F Y H:i:s',strtotime($perket['waktu_absen'])) ?></td>
                <td><?php echo $PerKet['status']; ?></td>
            <?php } ?>
        <?php } else { ?>
            <td colspan="2">Belum Absensi</td>
        <?php } ?>
    </tr>
<?php } else { ?>
    <tr>
        <td colspan="5" style="text-align: center;">Tidak Ada Data.</td>
    </tr>
<?php } ?>


        </tbody>
        </table>
      </div>
      </div>

      <div class="modal fade" id="absenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header mb-3">
        <h5 class="modal-title" id="exampleModalLabel">Isi Absensi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="post" enctype="multipart/form-data">
          <div class="form-check">
          <input class="form-check-input" type="radio" name="pilabsen" value="Hadir" id="flexRadioDefault1">
          <label class="form-check-label" for="flexRadioDefault1">
            Hadir
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pilabsen" value="Izin" id="flexRadioDefault2">
          <label class="form-check-label" for="flexRadioDefault2">
            Izin
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pilabsen" value="Sakit" id="flexRadioDefault2">
          <label class="form-check-label" for="flexRadioDefault2">
            Sakit
          </label>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="radio" name="pilabsen" value="Tidak Hadir" id="flexRadioDefault2" checked>
          <label class="form-check-label" for="flexRadioDefault2">
            Tidak Hadir
          </label>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="submit" class="btn btn-primary" onclick="handleSubmission()">Submit</button>
        </div>


         <?php

        if (isset($_POST['submit']))
        {
            $user_id = $_SESSION["user"]["id_user"];

            $idKelas = $perabsen['id_kelas'];
            $IDeks_diikuti = $perabsen['id_ekstra_diikuti'];

            $ekstra_name =  $perabsen['nama_ekstra'];
            $idCreAbsen = $perabsen['id_buat_absensi'];
            $coach = $perabsen['id_pelatih'];

            $id_Eks = $perabsen['id_ekstra'];

            $kelas = $kn->query("SELECT kelas FROM tb_kelas WHERE id_kelas = '$idKelas'");
            $perkelas = $kelas->fetch_assoc();
            
            $namaKelas = $perkelas['kelas'];

            $kn->query("INSERT INTO tb_absensi 
                (id_ekstra,id_user, id_pelatih, id_buat_absensi, id_kelas, kelas, id_ekstra_diikuti, nama_ekstra, keterangan)
                VALUES ('$id_Eks','$user_id','$coach', '$idCreAbsen', '$idKelas', '$namaKelas', '$IDeks_diikuti', '$ekstra_name', '$_POST[pilabsen]')");

            echo "<script>alert('Berhasil Melakukan Absensi');</script>";
            echo "<script>$('#absenModal').modal('hide');</script>";
            echo "<script>location.href='absensi.php?id=" . urlencode($perabsen['id_ekstra']) . "';</script>";

        }
        ?>
         </form>
      </div>
    </div>
  </div>
</div>

    </section>

  </main><!-- End #main -->

        <script>
        
        function handleSubmission() {
            $('#absenModal').modal('hide');
        }
      </script>
  

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>