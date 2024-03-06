<style>
  .custom-select-overflow {
    overflow: auto; 
    max-height: 140px; 
  }
</style>
<?php
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
$kelas="-";
$status="-";


if (isset($_POST["submit"]))
{
	$id = $_SESSION["user"]["id_user"];

    $tgl_mulai= $_POST["tglm"];
    $tgl_selesai= $_POST["tgls"];
    $kelas = $_POST['kelas'];
    $status = $_POST['status'];

  
$ambl = $kn->query("SELECT tb_user.nama_lengkap, tb_user.id_user, tb_kelas.nis, max(tb_absensi.keterangan), max(tb_absensi.waktu_absen), max(tb_kelas.kelas) as kelas FROM tb_absensi 
    INNER JOIN tb_user ON tb_absensi.id_user = tb_user.id_user
    INNER JOIN tb_kelas ON tb_absensi.id_kelas = tb_kelas.id_kelas
    INNER JOIN tb_pelatih_ekstra ON tb_absensi.id_pelatih = tb_pelatih_ekstra.id_pelatih
    WHERE tb_absensi.id_pelatih='$id' AND tb_absensi.kelas= '$kelas' AND tb_absensi.status= '$status' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND '$tgl_selesai' GROUP BY tb_user.nama_lengkap");

   while($pch = $ambl->fetch_assoc())
   {
     $semuadata[]=$pch;
   }

}
 ?>

<h2 class="h3 mb-4 text-gray-800">
    Laporan Absensi Ekstrakurikuler
    <?php
    echo (!empty($semuadata)) ? date("d-m-Y", strtotime($tgl_mulai)) : '-';
    ?> S/D
    <?php
    echo (!empty($semuadata)) ? date("d-m-Y", strtotime($tgl_selesai)) : '-';
    ?>
</h2>

 <form method="post" class="mb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tglm" class="form-control">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tgls" class="form-control">
                </div>
            </div>

             <div class="col-md-3 mb-3">
              <label>Kelas</label>
              <select class="custom-select custom-select-overflow" name="kelas">
              <option selected>Pilih Kelas</option>
              <!-- KELAS X -->
              <option value="X DPIB A">X DPIB A</option>
              <option value="X DPIB B">X DPIB B</option>
              <option value="X DPIB C">X DPIB C</option>
              <option value="X RPL A">X RPL A</option>
              <option value="X RPL B">X RPL B</option>
              <option value="X RPL C">X RPL C</option>
              <option value="X T BKP A">X T BKP A</option>
              <option value="X T BKP B">X T BKP B</option>
              <option value="X T EI A">X T EI A</option>
              <option value="X T EI B">X T EI B</option>
              <option value="X T LAS A">X T LAS A</option>
              <option value="X T LAS B">X T LAS B</option>
              <option value="X T OI A">X T OI A</option>
              <option value="X T OI B">X T OI B</option>
              <option value="X TBSM A">X TBSM A</option>
              <option value="X TBSM B">X TBSM B</option>
              <option value="X TPM A">X TPM A</option>
              <option value="X TPM B">X TPM B</option>
              <option value="X TPM C">X TPM C</option>
              <option value="X TPM D">X TPM D</option>
              <option value="X TPTU A">X TPTU A</option>
              <option value="X TPTU B">X TPTU B</option>
              <!-- KELAS XI -->
              <option value="XI DPIB A">XI DPIB A</option>
              <option value="XI DPIB B">XI DPIB B</option>
              <option value="XI DPIB C">XI DPIB C</option>
              <option value="XI RPL A">XI RPL A</option>
              <option value="XI RPL B">XI RPL B</option>
              <option value="XI RPL C">XI RPL C</option>
              <option value="XI T BKP A">XI T BKP A</option>
              <option value="XI T BKP B">XI T BKP B</option>
              <option value="XI T EI A">XI T EI A</option>
              <option value="XI T EI B">XI T EI B</option>
              <option value="XI T LAS A">XI T LAS A</option>
              <option value="XI T LAS B">XI T LAS B</option>
              <option value="XI T OI A">XI T OI A</option>
              <option value="XI T OI B">XI T OI B</option>
              <option value="XI TBSM A">XI TBSM A</option>
              <option value="XI TBSM B">XI TBSM B</option>
              <option value="XI TPM A">XI TPM A</option>
              <option value="XI TPM B">XI TPM B</option>
              <option value="XI TPM C">XI TPM C</option>
              <option value="XI TPM D">XI TPM D</option>
              <option value="XI TPTU A">XI TPTU A</option>
              <option value="XI TPTU B">XI TPTU B</option>
              <!-- KELAS XII -->
              <option value="XII DPIB A">XII DPIB A</option>
              <option value="XII DPIB B">XII DPIB B</option>
              <option value="XII DPIB C">XII DPIB C</option>
              <option value="XII RPL A">XII RPL A</option>
              <option value="XII RPL B">XII RPL B</option>
              <option value="XII RPL C">XII RPL C</option>
              <option value="XII T BKP A">XII T BKP A</option>
              <option value="XII T BKP B">XII T BKP B</option>
              <option value="XII T EI A">XII T EI A</option>
              <option value="XII T EI B">XII T EI B</option>
              <option value="XII T LAS A">XII T LAS A</option>
              <option value="XII T LAS B">XII T LAS B</option>
              <option value="XII T OI A">XII T OI A</option>
              <option value="XII T OI B">XII T OI B</option>
              <option value="XII TBSM A">XII TBSM A</option>
              <option value="XII TBSM B">XII TBSM B</option>
              <option value="XII TPM A">XII TPM A</option>
              <option value="XII TPM B">XII TPM B</option>
              <option value="XII TPM C">XII TPM C</option>
              <option value="XII TPM D">XII TPM D</option>
              <option value="XII TPTU A">XII TPTU A</option>
              <option value="XII TPTU B">XII TPTU B</option>

              </select>
              </div>


            <div class="col-md-3 mb-3">
                <label>Status</label>
                <select class="custom-select" name="status">
                <option selected>Pilih Status</option>
                <option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
                <option value="Dikonfirmasi">Dikonfirmasi</option>
                </select>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <button class="btn btn-primary" name="submit"><i class="fa fa-fw fa-search"></i> Lihat Laporan</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="card shadow mb-3">

    <div class="card-header py-3 d-flex justify-content-between">
    <?php
      $id = $_SESSION["user"]["id_user"];
      $ambl = $kn->query("SELECT nama_ekstra FROM tb_ekstra INNER JOIN tb_pelatih_ekstra ON tb_ekstra.id_ekstra = tb_pelatih_ekstra.id_ekstra WHERE id_pelatih = '$id' "); 
      $eks = $ambl->fetch_assoc(); ?>
    <h6 class="m-0 font-weight-bold text-primary">Laporan Absensi Ekstrakurikuler <?php echo $eks["nama_ekstra"] ?> </h6>
    <h6 class="m-0 font-weight-bold text-primary">Status : <?php echo $status ?> </h6>
    </div>

    <div class="card-body">
        <p class="text-right">Gunakan tanda kutip " " untuk pencarian yang lebih spesifik</p>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead style="background-color: #67999A;" class="table text-white">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Hadir</th>
                        <th scope="col">Tidak Hadir</th>
                        <th scope="col">Sakit</th>
                        <th scope="col">Izin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($semuadata as $key => $value): ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value["nama_lengkap"] ?></td>
            <td><?php echo $value["nis"] ?></td>
            <td><?php echo $value["kelas"] ?></td>            
           <?php    

           $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_hadir FROM tb_absensi WHERE keterangan = 'Hadir' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $hadir = $ambl->fetch_assoc();
            ?>
            <td> <?php  
                 echo $hadir["total_hadir"]; 
            ?>
            </td>

            <?php   
            $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_tidak_hadir FROM tb_absensi WHERE keterangan = 'Tidak Hadir' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $tidak_hadir = $ambl->fetch_assoc();
            ?>
            <td> <?php  
                 echo $tidak_hadir["total_tidak_hadir"]; 
            ?>
            </td>

            <?php   
            $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_sakit FROM tb_absensi WHERE keterangan = 'Sakit' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $sakit = $ambl->fetch_assoc();
            ?>
            <td> <?php  
                 echo $sakit["total_sakit"]; 
            ?>
            </td>

            <?php  
            $id_user = $value["id_user"];

            $ambl = $kn->query("SELECT COUNT(*) as total_izin FROM tb_absensi WHERE keterangan = 'Izin' AND id_pelatih= '$id' AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
            $izin = $ambl->fetch_assoc();
            ?>
            <td> <?php  
                 echo $izin["total_izin"]; 
            ?>
            </td>
        </tr>
        <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

 <a href="cetak_pdf.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai ?>&kelas=<?php echo $kelas ?>&status=<?php echo $status ?>&id_user=<?php echo $id ?>" class="btn btn-danger mb-5" target="_blank" ><i class="far fa-fw fa-file-pdf"></i> Cetak PDF</a>