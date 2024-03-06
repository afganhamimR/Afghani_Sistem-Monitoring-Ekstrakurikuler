<?php 

$ambl = $kn->query("SELECT * FROM tb_user WHERE tb_user.id_user='$_GET[id]' ");

$kn->query("DELETE FROM tb_user WHERE id_user='$_GET[id]'");

echo "<script>alert('User Terhapus');</script>";
echo "<script>location='index.php?halaman=user_kesiswaan';</script>";
?>
