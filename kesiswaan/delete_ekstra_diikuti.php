<?php 

$id_user = $_GET['id_user'];

$ambl = $kn->query("SELECT * FROM tb_ekstra_diikuti, tb_absensi WHERE tb_ekstra_diikuti.id_user= $id_user AND tb_ekstra_diikuti.id_ekstra='$_GET[id_ekstra]' AND tb_absensi.id_user= $id_user AND tb_absensi.id_ekstra='$_GET[id_ekstra]'");
$value = $ambl->fetch_assoc();

$kn->query("DELETE FROM tb_ekstra_diikuti WHERE id_user= $id_user AND id_ekstra='$_GET[id_ekstra]'");
$kn->query("DELETE FROM tb_absensi WHERE id_user= $id_user AND id_ekstra='$_GET[id_ekstra]'");

echo "<script>alert('Ekstrakurikuler diikuti Siswa terhapus');</script>";
echo "<script>location='index.php?halaman=info_siswa&id=" . $id_user . "';</script>";
?>
