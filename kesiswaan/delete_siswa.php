<?php 

$ambl = $kn->query("SELECT * FROM tb_user, tb_kelas, tb_absensi, tb_ekstra_diikuti WHERE tb_user.id_user='$_GET[id]' AND tb_kelas.id_user='$_GET[id]' AND tb_absensi.id_user='$_GET[id]' AND tb_ekstra_diikuti.id_user='$_GET[id]'");

$kn->query("DELETE FROM tb_user WHERE id_user='$_GET[id]'");
$kn->query("DELETE FROM tb_kelas WHERE id_user='$_GET[id]'");
$kn->query("DELETE FROM tb_ekstra_diikuti WHERE id_user ='$_GET[id]'");
$kn->query("DELETE FROM tb_absensi WHERE id_user ='$_GET[id]'");

echo "<script>alert('User Terhapus');</script>";
echo "<script>location='index.php?halaman=user_siswa';</script>";
?>