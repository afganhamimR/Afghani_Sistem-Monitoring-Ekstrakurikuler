<?php

$cek_pelatih = $kn->query("SELECT * FROM tb_pelatih_ekstra WHERE id_ekstra='$_GET[id]'");


if ($cek_pelatih->num_rows > 0) {

    echo "<script>alert('Ekstra tidak dapat dihapus karena terkait dengan pelatih');</script>";
    echo "<script>location='index.php?halaman=ekstra';</script>";
} else {
  
    $ambl = $kn->query("SELECT * FROM tb_ekstra WHERE tb_ekstra.id_ekstra='$_GET[id]' ");
    
    $kn->query("DELETE FROM tb_ekstra WHERE id_ekstra='$_GET[id]'");
    echo "<script>alert('Ekstra Terhapus');</script>";
    echo "<script>location='index.php?halaman=ekstra';</script>";
}
?>
