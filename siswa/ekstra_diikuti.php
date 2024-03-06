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

 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Siswa | Ekstra Diikuti</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/home.css" rel="stylesheet">

</head>

<body>

  <?php include 'navbar.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/stmj.jpeg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Ekstrakurikuler Diikuti</h2>
        <ol>
          <li><a href="home.php">Home</a></li>
          <li>Ekstrakurikuler Diikuti</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container">

        <div class="row">

           <?php
            $id = $_SESSION["user"]["id_user"];
            $ambl = $kn->query("SELECT * FROM tb_ekstra_diikuti 
            LEFT JOIN tb_user ON tb_ekstra_diikuti.id_pelatih=tb_user.id_user 
            LEFT JOIN tb_kelas ON tb_ekstra_diikuti.id_user = tb_kelas.id_user
            LEFT JOIN tb_ekstra ON tb_ekstra_diikuti.id_ekstra = tb_ekstra.id_ekstra
            WHERE tb_ekstra_diikuti.id_user='$id' "); 
            ?>

          <?php if ($ambl->num_rows > 0) { ?>
         
            <?php while($perekstra = $ambl->fetch_assoc()){ ?>



            <div class="col-sm-4">
            <div class="card custom-card mb-4">
            <div class="card-body">
              <h5 style="color: #278183;" class="card-title fw-bold"><?php echo $perekstra['nama_ekstra']; ?></h5>
              <hr class="my-4">
              <p style="color: #FD6300;" class="card-text fw-bold">Pelatih: <?php echo $perekstra['nama_lengkap']; ?></p>
              <p style="color: #FD6300;" class="card-text fw-bold">Hari, Jam: <?php echo $perekstra['hari']; ?>, <?php echo date('H:i', strtotime($perekstra['jam'])); ?></p>
            
              <a  href="absensi.php?id=<?php echo $perekstra['id_ekstra']; ?>" class="btn bg-color-absensi float-end">Absensi</a>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php } else { ?>
        <div class="alert alert-danger text-center" role="alert">
          Tidak Ada Ekstrakurikuler yang Diikuti.
        </div>
      <?php } ?>

      </div>

    </section>

  </main><!-- End #main -->

  

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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