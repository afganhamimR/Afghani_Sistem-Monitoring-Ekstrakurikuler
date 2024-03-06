<?php
session_start();

if($_SESSION['role']==""){
    header("location:../index.php");
  }
  elseif ($_SESSION['role']=="pelatih") {
    header("location:../index.php");
  }
    elseif ($_SESSION['role']=="siswa") {
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

    <title>Kesiswaan | Page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <!-- Favicons -->
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">    

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-3.min.css" rel="stylesheet">
    <link href="css/sb-admin-3.css" rel="stylesheet">

     <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

     <style>
     @media only screen and (max-width: 768px) {
    .element {
        margin-right: 7px;
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
                <div class="sidebar-brand-text mx-3" style="color: #FD6300;">Kesiswaan</div>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?halaman=laporan_absensi">Laporan Absensi</a>
                        <a class="collapse-item" href="index.php?halaman=laporan_jurnal">Laporan Jurnal</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?halaman=user_kesiswaan">Kesiswaan</a>
                        <a class="collapse-item" href="index.php?halaman=user_pelatih">Pelatih</a>
                        <a class="collapse-item" href="index.php?halaman=user_siswa">Siswa</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=buatakun">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>Buat Akun</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=ekstra">
                    <i class="fas fa-fw fa-filter"></i>
                    <span>Ekstrakurikuler</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=update_daftar_eks">
                    <i class="far fa-fw fa-edit"></i>
                    <span>Update Daftar Ekstra</span></a>
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
                    <span style="color: #FD6300; font-weight: bold;"><?php echo $_SESSION["user"]['nama_lengkap'] ?></span>
                </div>

                 <div class="topbar-divider d-none d-sm-block"></div>

                <button href="#" data-toggle="modal" data-target="#logoutModal" class="btn btn-danger mr-4"><i class="fas fa-fw fa-sign-out-alt"></i>
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
                 elseif ($_GET['halaman']=="laporan_absensi")
                   {
                     include 'laporan_absensi.php';
                   }
                   elseif ($_GET['halaman']=="buatakun")
                   {
                     include 'buat_akun.php';
                   }
                   elseif ($_GET['halaman']=="user_kesiswaan")
                   {
                     include 'user_kesiswaan.php';
                   }
                   elseif ($_GET['halaman']=="edit_kesiswaan")
                   {
                     include 'edit_kesiswaan.php';
                   }
                   elseif ($_GET['halaman']=="delete_kesiswaan")
                   {
                     include 'delete_kesiswaan.php';
                   }
                   elseif ($_GET['halaman']=="user_pelatih")
                   {
                     include 'user_pelatih.php';
                   }
                   elseif ($_GET['halaman']=="edit_pelatih")
                   {
                     include 'edit_pelatih.php';
                   }
                   elseif ($_GET['halaman']=="delete_pelatih")
                   {
                     include 'delete_pelatih.php';
                   }
                   elseif ($_GET['halaman']=="delete_ekstra_diikuti")
                   {
                     include 'delete_ekstra_diikuti.php';
                   }
                   elseif ($_GET['halaman']=="user_siswa")
                   {
                     include 'user_siswa.php';
                   }
                   elseif ($_GET['halaman']=="info_siswa")
                   {
                     include 'info_siswa.php';
                   }
                   elseif ($_GET['halaman']=="edit_siswa")
                   {
                     include 'edit_siswa.php';
                   }
                   elseif ($_GET['halaman']=="delete_siswa")
                   {
                     include 'delete_siswa.php';
                   }
                   elseif ($_GET['halaman']=="ekstra")
                   {
                     include 'ekstra.php';
                   }
                   elseif ($_GET['halaman']=="delete_ekstra")
                   {
                     include 'delete_ekstra.php';
                   }
                   elseif ($_GET['halaman']=="update_daftar_eks")
                   {
                     include 'update_daftar_eks.php';
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