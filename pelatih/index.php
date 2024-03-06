<?php
session_start();

if($_SESSION['role']==""){
    header("location:../index.php");
  }
  elseif ($_SESSION['role']=="siswa") {
    header("location:../index.php");
  }
    elseif ($_SESSION['role']=="kesiswaan") {
    header("location:../index.php");
  }

$kn = new mysqli("localhost","root","","db_sistem_informasi"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Pelatih | Page</title>

    <!-- Favicons -->
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-3.min.css" rel="stylesheet">
    <link href="css/sb-admin-3.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
     @media only screen and (max-width: 768px) {
    .element {
        margin-right: 8px;
    }
}
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i style="color: #FD6300;" class="fas fa-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3" style="color: #FD6300;">Pelatih</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="far fa-fw fa-edit"></i>
                    <span>Absensi</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?halaman=buat_absensi">Buat Absensi</a>
                        <a class="collapse-item" href="index.php?halaman=cek_absensi">Cek Absensi</a>
                        <a class="collapse-item" href="index.php?halaman=isi_absensi">Isi Absensi</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?halaman=laporan_absensi">Laporan Absensi</a>
                        <a class="collapse-item" href="index.php?halaman=laporan_jurnal">Laporan Jurnal</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsejurnal"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Jurnal Kegiatan</span>
                </a>
                <div id="collapsejurnal" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?halaman=jurnal">Tambah Jurnal</a>
                        <a class="collapse-item" href="index.php?halaman=edit_jurnal">Edit Jurnal</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                  
                  <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                   

                    <div class="ml-auto">
                    <span style="color: #FD6300; font-weight: bold;" class="element"><?php echo $_SESSION["user"]['nama_lengkap'] ?></span>
                </div>

                 <div class="topbar-divider d-none d-sm-block"></div>

                <button href="#" data-toggle="modal" data-target="#logoutModal" class="btn btn-danger mr-4"><i class="fas fa-sign-out-alt"></i>
                Logout</button>


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

               <?php
               if (isset($_GET['halaman'])) 
               {
                 if ($_GET['halaman']=="laporan_jurnal")
                 {
                    include 'laporan_jurnal.php';
                 }
                 elseif ($_GET['halaman']=="jurnal")
                   {
                     include 'jurnal.php';
                   }
                   elseif ($_GET['halaman']=="edit_jurnal")
                   {
                     include 'edit_jurnal.php';
                   }
                   elseif ($_GET['halaman']=="edit_jurnaleks")
                   {
                     include 'edit_jurnaleks.php';
                   }
                   elseif ($_GET['halaman']=="laporan_absensi")
                   {
                     include 'laporan_absensi.php';
                   }
                   elseif ($_GET['halaman']=="cetak_pdf")
                   {
                     include 'cetak_pdf.php';
                   }
                   elseif ($_GET['halaman']=="isi_absensi")
                   {
                     include 'isi_absensi.php';
                   }
                   elseif ($_GET['halaman']=="isi_kehadiran")
                   {
                     include 'isi_kehadiran.php';
                   }
                   elseif ($_GET['halaman']=="buat_absensi")
                   {
                     include 'buat_absensi.php';
                   }
                   elseif ($_GET['halaman']=="cek_absensi")
                   {
                     include 'cek_absensi.php';
                   }
                    elseif ($_GET['halaman']=="edit_cekabsensi")
                   {
                     include 'edit_cekabsensi.php';
                   }
                   elseif ($_GET['halaman']=="delete_absensi")
                   {
                     include 'delete_absensi.php';
                   }
                 elseif ($_GET['halaman']=="logout")
                   {
                     include 'logout.php';
                   }
                   } 
                   else
                   {
                      include 'home.php';
                   } 
                   ?>   
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    

</body>

</html>