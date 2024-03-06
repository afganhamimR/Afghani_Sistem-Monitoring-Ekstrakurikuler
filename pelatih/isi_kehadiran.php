<style>
	.form-check {
  display: inline-block;

  margin-right: 10px; 
}

</style>
<h1 class="h3 mb-4 text-gray-800">Isi Absensi</h1>

<form class="offset-md-1" method="post" enctype="multipart/form-data">

<?php
    $id = $_SESSION["user"]["id_user"];

	$ambl=$kn->query("SELECT tb_ekstra_diikuti.nama_ekstra, tb_kelas.kelas, tb_user.nama_lengkap, tb_user.id_user, tb_kelas.id_kelas, tb_ekstra_diikuti.id_ekstra_diikuti, tb_ekstra_diikuti.id_ekstra
        FROM tb_ekstra_diikuti
        LEFT JOIN tb_kelas ON tb_ekstra_diikuti.id_kelas = tb_kelas.id_kelas
        LEFT JOIN tb_user ON tb_ekstra_diikuti.id_user = tb_user.id_user
        WHERE tb_ekstra_diikuti.id_user = '$_GET[id]' AND tb_ekstra_diikuti.id_pelatih = '$id' "); 
	    $isi_absensi=$ambl->fetch_assoc();

	$result = $kn->query("SELECT id_buat_absensi FROM tb_buat_absensi WHERE id_pelatih = '$id' " );
	$Cre_absensi=$result->fetch_assoc();
    ?>

  <div class="form-group col-md-10 mb-3">
    <label>Nama Lengkap</label>
    <input type="name" name="name" readonly value="<?php echo $isi_absensi["nama_lengkap"] ?>" class="form-control">
  </div>
  <div class="form-group col-md-10 mb-3">
    <label>Ekstrakurikuler</label>
    <input type="text" name="nameEkstra" readonly value="<?php echo $isi_absensi["nama_ekstra"] ?>" class="form-control">
  </div>
  <div class="form-group col-md-10 mb-3">
    <label>Kelas</label>
    <input type="text" name="name" readonly value="<?php echo $isi_absensi["kelas"] ?>" class="form-control">
  </div>
  <div class="col-md-10 mb-3">
  	<label class="d-block">Keterangan</label>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="pilket" id="exampleRadios1" value="Tidak Hadir" checked>
  <label class="form-check-label" for="exampleRadios1">
    Tidak Hadir
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="pilket" id="exampleRadios2" value="Hadir">
  <label class="form-check-label" for="exampleRadios2">
    Hadir
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="pilket" id="exampleRadios3" value="Sakit">
  <label class="form-check-label" for="exampleRadios3">
    Sakit
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="pilket" id="exampleRadios4" value="Izin">
  <label class="form-check-label" for="exampleRadios4">
    Izin
  </label>
</div>

</div>
  <div class="form-group col-md-10 mb-3">
    <label>Status</label>
	  <select class="custom-select" name="status">
	  <option selected>Pilih Status</option>
	  <option value="Dikonfirmasi">Dikonfirmasi</option>
	  </select>
  </div>

  <div class="col-md-10 mb-5">
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>

<?php

        if (isset($_POST['submit']))
        {
            $pel_id = $_SESSION["user"]["id_user"];

            $idKelas = $isi_absensi['id_kelas'];
            $IDeks_diikuti = $isi_absensi['id_ekstra_diikuti'];

            $idCreAbsen = $Cre_absensi['id_buat_absensi'];
            $id_user = $isi_absensi['id_user'];
            $id_Eks = $isi_absensi['id_ekstra'];

            $kelas = $kn->query("SELECT kelas FROM tb_kelas WHERE id_kelas = '$idKelas'");
            $perkelas = $kelas->fetch_assoc();
            
            $namaKelas = $perkelas['kelas'];
            
            $kn->query("INSERT INTO tb_absensi 
                (id_ekstra,id_user, id_pelatih, id_buat_absensi, id_kelas, kelas, id_ekstra_diikuti, nama_ekstra, keterangan, status)
                VALUES ('$id_Eks','$id_user','$pel_id', '$idCreAbsen', '$idKelas', '$namaKelas','$IDeks_diikuti', '$_POST[nameEkstra]', '$_POST[pilket]', '$_POST[status]')");

            echo "<script>alert('Berhasil Melakukan Absensi');</script>";
            echo "<script>location='index.php?halaman=isi_absensi';</script>";

        }
        ?>
</form>