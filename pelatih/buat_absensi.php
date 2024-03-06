<h1 class="h3 mb-4 text-gray-800">Buat Absensi</h1>

<?php
if (isset($_POST['submit'])) {
    $user_id = $_SESSION["user"]["id_user"];
    $namaEKs = $_POST['ekstra'];
    $hari = $_POST['hari'];

    $check_absensi = $kn->query("SELECT COUNT(*) AS jumlah_absensi FROM tb_buat_absensi WHERE id_pelatih = '$user_id'");
    $row = $check_absensi->fetch_assoc();
    $jumlah_absensi = $row['jumlah_absensi'];

    if ($jumlah_absensi > 0) {
        echo "<script>alert('Anda sudah membuat absensi sebelumnya');</script>";
        echo "<script>location='index.php?halaman=buat_absensi';</script>";
    } else {
      
        $ambl = $kn->query("SELECT * FROM tb_ekstra WHERE nama_ekstra='$namaEKs'");
        $idEkstra = $ambl->fetch_assoc();
        $IDEkstra = $idEkstra['id_ekstra'];

        $kn->query("INSERT INTO tb_buat_absensi (id_pelatih, id_ekstra, nama_ekstra, hari) VALUES ('$user_id', '$IDEkstra', '$_POST[ekstra]', '$_POST[hari]')");

        echo "<script>alert('Absensi berhasil ditambahkan');</script>";
        echo "<script>location='index.php?halaman=buat_absensi';</script>";
    }
}
?>

<style>
  .btn-absen {
    background-color: #278183;
    border-color: #67999A ;
    color: #fff;
  }
  .btn-absen:hover {
    background-color: #67999A;
    color: #fff;
  }
</style>


<div class="modal fade" id="buatabsensi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Absensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">

  <div class="form-group col-md-10 mb-3">
    <label>Nama Lengkap</label>
    <input type="name" name="name" readonly value="<?php echo $_SESSION["user"]['nama_lengkap'] ?>" class="form-control">
  </div>

  <div class="form-group col-md-10 mb-3">
    <label>Ekstrakurikuler</label>
    <?php
        $user_id = $_SESSION["user"]["id_user"];
        $result = $kn->query("SELECT nama_ekstra FROM tb_ekstra JOIN tb_pelatih_ekstra ON tb_ekstra.id_ekstra = tb_pelatih_ekstra.id_ekstra WHERE id_pelatih = '$user_id'"); 
        $id_ekstra_pelatih = $result->fetch_assoc();
        ?>
    <input type="text" name="ekstra" readonly value="<?php echo $id_ekstra_pelatih['nama_ekstra'] ?>" class="form-control">
  </div>
  
  <div class="col-md-10 mb-3">
  <label>Hari</label>
  <input type="text" name="hari" id="hari" readonly class="form-control">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<button type="button" class="btn btn-absen mb-3" data-toggle="modal" data-target="#buatabsensi"><i class="fas fa-plus-circle"></i> Buat Absensi</button>
<div class="table-responsive">
<table class="table table-bordered">
  <thead style="background-color: #67999A;" class="table text-white">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Ekstrakurikuler</th>
      <th scope="col">Hari</th>
      <th scope="col">Tanggal, Waktu</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $nmr=1; ?>
        <?php 
        $id = $_SESSION["user"]["id_user"];
        $ambl=$kn->query("SELECT * FROM tb_buat_absensi WHERE id_pelatih='$id' "); ?>
        <?php while($pch = $ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama_ekstra']; ?></td>
            <td><?php echo $pch['hari']; ?></td>
            <td><?php echo date('d F Y H:i', strtotime($pch['tanggal'])); ?></td>
            <td><a href="index.php?halaman=delete_absensi&id=<?php echo $pch['id_buat_absensi']; ?>" class="btn btn-danger">Hapus</a></td>
        </tr>
        <?php $nmr++; ?>
        <?php } ?>
  </tbody>
</table>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  var hariElement = document.getElementById('hari');

  var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

  var tanggalHariIni = new Date();

  var hariIni = namaHari[tanggalHariIni.getDay()];

  hariElement.value = hariIni;
});
</script>