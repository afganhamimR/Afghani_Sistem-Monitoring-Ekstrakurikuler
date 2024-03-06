<?php 

$ambil = $kn->query("SELECT * FROM tb_buat_absensi WHERE id_buat_absensi='$_GET[id]'");
$pch = $ambil->fetch_assoc();


$User_id = $_SESSION["user"]["id_user"];

$id = $kn->query("SELECT id_ekstra FROM tb_pelatih_ekstra WHERE id_pelatih = '$User_id'");
$ID_eks = $id->fetch_assoc();

$siswa_belum_absensi = $kn->query("SELECT COUNT(*) as total FROM tb_ekstra_diikuti  
    LEFT JOIN tb_buat_absensi ON tb_ekstra_diikuti.id_ekstra = tb_buat_absensi.id_ekstra 
    WHERE tb_ekstra_diikuti.id_ekstra = '{$ID_eks["id_ekstra"]}' AND tb_buat_absensi.id_buat_absensi = '$_GET[id]'"); 

$siswa_absensi = $kn->query("SELECT COUNT(*) as total_dua FROM tb_absensi  
    LEFT JOIN tb_buat_absensi ON tb_absensi.id_buat_absensi = tb_buat_absensi.id_buat_absensi 
    WHERE tb_absensi.id_buat_absensi = '$_GET[id]' AND tb_buat_absensi.id_buat_absensi = '$_GET[id]'");


$jumlah_siswa_belum_absensi = $siswa_belum_absensi->fetch_assoc()['total'];

$jumlah_siswa_absensi = $siswa_absensi->fetch_assoc()['total_dua'];


if ($jumlah_siswa_belum_absensi == $jumlah_siswa_absensi) {

    $kn->query("DELETE FROM tb_buat_absensi WHERE id_buat_absensi='$_GET[id]'");
    echo "<script>alert('Absensi Terhapus');</script>";
    echo "<script>location='index.php?halaman=buat_absensi';</script>";
} else {
  
    echo "<script>alert('Masih ada siswa yang belum melakukan absensi');</script>";
    echo "<script>location='index.php?halaman=isi_absensi';</script>";
}



?>
