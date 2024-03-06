
<!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="home.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="logo.png">
        <h1 style="color: #fff;">SMKN 1 JENANGAN</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="home.php">Home</a></li>
          <?php
          $statusDaftar = $kn->query("SELECT status FROM tb_update_daftar_eks");
          if ($statusDaftar->num_rows > 0) {
              
              $rowstatus = $statusDaftar->fetch_assoc();
              
              $daftarEks = $rowstatus['status'];

              
              if ($daftarEks == "Open") {
                  echo '<li><a href="daftar_ekstra.php">Daftar Ekstrakurikuler</a></li>';
              } elseif ($daftarEks == "Close") {
                  echo '<li><span>Daftar Ekstrakurikuler (Ditutup)</span></li>';
              } else {
                  echo '<li><span>Status tidak valid</span></li>';
              }
          } else {
              echo '<li><span>Status tidak ditemukan</span></li>';
          }
           ?>

          <li><a href="ekstra_diikuti.php">Ekstrakurikuler yang diikuti</a></li>
          <li><a href="#" data-bs-toggle="modal" data-bs-target="#modallogout">Logout</a></li>
          
      </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<!-- Modal -->
<div class="modal fade" id="modallogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>