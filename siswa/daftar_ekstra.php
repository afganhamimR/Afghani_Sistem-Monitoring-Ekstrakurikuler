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

  <title>Siswa | Daftar Ekstra</title>
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

        <h2>Daftar Ekstrakurikuler</h2>
        <ol>
          <li><a href="home.php">Home</a></li>
          <li>Daftar Ekstrakurikuler</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container">

        <form class="offset-md-1" method="post" enctype="multipart/form-data">
          <div class="alert alert-success col-md-10 mb-3" role="alert">
           Silahkan pilih Ekstrakurikuler yang diminati.
          </div>
        <div class="form-group col-md-10 mb-3">
          <label>Nama Lengkap</label>
          <input type="name" class="form-control" readonly value="<?php echo $_SESSION["user"]['nama_lengkap'] ?>" >
        </div>
        <div class="form-group col-md-10 mb-3">
          <label>NIS</label>
          <?php
            $id = $_SESSION["user"]["id_user"];
            $ambl = $kn->query("SELECT * FROM tb_kelas WHERE id_user='$id'");
            $user_id=$ambl->fetch_assoc();
           ?>
          <input type="name" class="form-control" readonly value="<?php echo $user_id['nis']; ?>">
        </div>
        <div class="form-group col-md-10 mb-3">
          <?php
            $id = $_SESSION["user"]["id_user"];
            $ambl = $kn->query("SELECT * FROM tb_kelas WHERE id_user='$id'");
            $user_id=$ambl->fetch_assoc();
           ?>
          <label>Kelas</label>
          <input type="text" class="form-control" readonly value="<?php echo $user_id['kelas']; ?>" >
        </div>

        <div class="col-md-10 mb-3">
        <label>Pilih Ekstrakurikuler</label>
        <select class="form-select" aria-label="Default select example" name="ekstra">
          <?php
        $result = $kn->query("SELECT * FROM tb_ekstra");

        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['nama_ekstra'] . '">' . $row['nama_ekstra'] . '</option>';
        } ?>

        </select>
        </div>

        <div class="col-md-10 mb-3">
        <button type="submit" name="save" class="btn btn-primary my-button">Submit</button>
        </div>
      </form>

      <?php
if (isset($_POST['save'])) {
    $user_id = $_SESSION["user"]["id_user"];
    $namaEKs = $_POST['ekstra'];

    $ambil = $kn->query("SELECT * FROM tb_ekstra_diikuti WHERE id_user='$user_id'");
    $jumlah_ekstra_diikuti = $ambil->num_rows;

    if ($jumlah_ekstra_diikuti >= 3) {
        echo "<script>alert('Gagal, Anda sudah memilih 3 Ekstrakurikuler');</script>";
        echo "<script>location='daftar_ekstra.php';</script>";
    } else {
        $ambil = $kn->query("SELECT * FROM tb_ekstra_diikuti WHERE nama_ekstra='$namaEKs' and id_user='$user_id'");
        $yangcocok = $ambil->num_rows;

        if ($yangcocok == 1) {
            echo "<script>alert('Gagal, Anda sudah memilih Ekstrakurikuler itu');</script>";
            echo "<script>location='daftar_ekstra.php';</script>";
        } else {
            $ambl = $kn->query("SELECT * FROM tb_kelas WHERE id_user='$user_id'");
            $kelas_id = $ambl->fetch_assoc();

            $idkelas = $kelas_id['id_kelas'];

            $ambl = $kn->query("SELECT * FROM tb_ekstra WHERE nama_ekstra='$namaEKs'");
            $idEkstra = $ambl->fetch_assoc();

            $IDEkstra = $idEkstra['id_ekstra'];

            $ambl = $kn->query("SELECT * FROM tb_pelatih_ekstra WHERE id_ekstra='$IDEkstra'");
            $idpelatih = $ambl->fetch_assoc();

            $IDCoach = $idpelatih['id_pelatih'];

            $kn->query("INSERT INTO tb_ekstra_diikuti
            (id_user,id_ekstra,id_pelatih,id_kelas,nama_ekstra)
            VALUES('$user_id','$IDEkstra','$IDCoach','$idkelas','$namaEKs')");

            echo "<script>alert('Pendaftaran Berhasil');</script>";
            echo "<script>location='ekstra_diikuti.php';</script>";
        }
    }
}

?>

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