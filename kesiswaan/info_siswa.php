<h1 class="h3 mb-4 text-gray-800">Informasi Siswa</h1>

<?php

$ambl = $kn->query("SELECT tb_user.id_user, tb_user.nama_lengkap, tb_kelas.kelas, tb_kelas.nis FROM tb_user
	LEFT JOIN tb_kelas ON tb_user.id_user = tb_kelas.id_user
    WHERE tb_user.id_user ='$_GET[id]' ");
	$value = $ambl->fetch_assoc();

$result = $kn->query("SELECT nama_ekstra, id_ekstra, id_user FROM tb_ekstra_diikuti WHERE id_user = '$_GET[id]' ");

$id = '$_GET[id_user]';



?>



<style>
	#bg {
		background-color: #fff;
	}
</style>

 <div class="form-group col-md-5 mb-3">
    <label>Nama Lengkap</label>
    <?php
    echo "<ul class='list-group'>";
    echo "<li class='list-group-item'>" . $value['nama_lengkap'] . "</li>";
    echo "</ul>";
    ?>
  </div>

  <div class="form-group col-md-5 mb-3">
    <label>NIS (Nomor Induk Siswa)</label>
    <?php
    echo "<ul class='list-group'>";
    echo "<li class='list-group-item'>" . $value['nis'] . "</li>";
    echo "</ul>";
    ?>
  </div>

  <div class="form-group col-md-5 mb-3">
    <label>Kelas</label>
    <?php
    echo "<ul class='list-group'>";
    echo "<li class='list-group-item'>" . $value['kelas'] . "</li>";
    echo "</ul>";
    ?>
    </div>
 
  <div class="col-md-5 mb-3">
    <label>Ekstrakurikuler yang diikuti</label>
    <?php 
if ($result->num_rows > 0) {
    echo "<ul class='list-group'>";
while($row = $result->fetch_assoc()) {
    echo "<li class='list-group-item'>" . $row["nama_ekstra"] . "
          <a href='index.php?halaman=delete_ekstra_diikuti&id_ekstra=" . $row['id_ekstra'] . "&id_user=" . $row['id_user'] . "' type='submit' class='btn btn-danger btn-sm float-right'>Delete</a>
          </li>";
    }
    echo "</ul>"; 
} else {
    echo "<ul class='list-group'>";
    echo "<li class='list-group-item'>Belum mendaftar ekstrakurikuler</li>";
    echo "</ul>";
}
?>

</div>





