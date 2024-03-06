<?php 

$ambl = $kn->query("SELECT * FROM tb_user, tb_kelas, tb_absensi, tb_ekstra_diikuti WHERE tb_user.id_user='$_GET[id]' AND tb_kelas.id_user='$_GET[id]' AND tb_absensi.id_user='$_GET[id]' AND tb_ekstra_diikuti.id_user='$_GET[id]'");

$kn->query("DELETE FROM tb_user WHERE id_user='$_GET[id]'");
$kn->query("DELETE FROM tb_pelatih_ekstra WHERE id_pelatih='$_GET[id]'");

$kn->query("UPDATE tb_ekstra_diikuti SET id_pelatih = '0' WHERE id_pelatih = '$_GET[id]'");
$kn->query("UPDATE tb_absensi SET id_pelatih = '0' WHERE id_pelatih = '$_GET[id]'");

echo "<script>alert('User Terhapus');</script>";
echo "<script>location='index.php?halaman=user_pelatih';</script>";
?>