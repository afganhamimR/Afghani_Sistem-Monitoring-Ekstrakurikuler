<?php
$semuadata = array();
$tgl_mulai = "";
$tgl_selesai = "";
$status = "";
$ekstra = "";

if (isset($_POST["submit"])) {
    $id = $_SESSION["user"]["id_user"];
    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];
    $status = $_POST['status'];
    $ekstra = $_POST['ekstra'];

    $ambl = $kn->query("SELECT tb_user.nama_lengkap, tb_user.id_user, tb_kelas.nis, max(tb_absensi.keterangan), max(tb_absensi.waktu_absen), max(tb_kelas.kelas), max(tb_kelas.kelas) as kelas FROM tb_absensi 
    INNER JOIN tb_user ON tb_absensi.id_user = tb_user.id_user
    INNER JOIN tb_kelas ON tb_absensi.id_kelas = tb_kelas.id_kelas
    WHERE tb_absensi.nama_ekstra= '$ekstra' AND tb_absensi.status= '$status' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' GROUP BY tb_user.nama_lengkap  ");
    
    while ($pch = $ambl->fetch_assoc()) {
        $semuadata[] = $pch;
    }
}
?>

<h2 class="h3 mb-4 text-gray-800">
    Laporan Absensi Ekstrakurikuler 
    <?php echo ($tgl_mulai != '' && $tgl_selesai != '') ? date("d-m-Y", strtotime($tgl_mulai)) : '-'; ?> S/D 
    <?php echo ($tgl_mulai != '' && $tgl_selesai != '') ? date("d-m-Y", strtotime($tgl_selesai)) : '-'; ?>
</h2>

<form method="post">
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
                <label>Ekstrakurikuler</label>
                <select class="custom-select" name="ekstra">
                    <option selected>Pilih Ekstrakurikuler</option>
                    <?php
                    $result = $kn->query("SELECT * FROM tb_ekstra");

                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['nama_ekstra'] . '">' . $row['nama_ekstra'] . '</option>';
                    }
                    ?>
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

            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <button class="btn btn-primary" name="submit"><i class="fa fa-fw fa-search"></i> Lihat Laporan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="card shadow mb-3">
    <div class="card-header py-3 d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Laporan Absensi Ekstrakurikuler <?php echo $ekstra ?> </h6>
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
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value["nama_lengkap"] ?></td>
                            <td><?php echo $value["nis"] ?></td>
                            <td><?php echo $value["kelas"] ?></td>

                            <?php    
                            $id_user = $value["id_user"];
                            $ambl = $kn->query("SELECT COUNT(*) as total_hadir FROM tb_absensi WHERE keterangan = 'Hadir' AND nama_ekstra= '$ekstra'  AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai'  ");
                            $hadir = $ambl->fetch_assoc();
                            ?>
                            <td><?php echo $hadir["total_hadir"]; ?></td>

                            <?php    
                            $id_user = $value["id_user"];
                            $ambl = $kn->query("SELECT COUNT(*) as total_tidak_hadir FROM tb_absensi WHERE keterangan = 'Tidak Hadir' AND nama_ekstra= '$ekstra'  AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
                            $tidak_hadir = $ambl->fetch_assoc();
                            ?>
                            <td><?php echo $tidak_hadir["total_tidak_hadir"]; ?></td>

                            <?php    
                            $id_user = $value["id_user"];
                            $ambl = $kn->query("SELECT COUNT(*) as total_sakit FROM tb_absensi WHERE keterangan = 'Sakit' AND nama_ekstra= '$ekstra'  AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
                            $sakit = $ambl->fetch_assoc();
                            ?>
                            <td><?php echo $sakit["total_sakit"]; ?></td>

                            <?php    
                            $id_user = $value["id_user"];
                            $ambl = $kn->query("SELECT COUNT(*) as total_izin FROM tb_absensi WHERE keterangan = 'Izin' AND nama_ekstra= '$ekstra'  AND status='$status' AND id_user ='$id_user' AND tb_absensi.waktu_absen BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
                            $izin = $ambl->fetch_assoc();
                            ?>
                            <td><?php echo $izin["total_izin"]; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

 <a href="cetak_pdf.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai ?>&ekstra=<?php echo $ekstra ?>&status=<?php echo $status ?>" class="btn btn-danger mb-5" target="_blank" ><i class="far fa-fw fa-file-pdf"></i> Cetak PDF</a>

