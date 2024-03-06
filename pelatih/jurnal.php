
<h1 class="h3 mb-4 text-gray-800">Jurnal Ekstrakurikuler</h1>

<form class="offset-md-1" method="post" enctype="multipart/form-data">

  <div class="form-group col-md-10 mb-3">
    <label>Nama Lengkap</label>
    <input type="name" readonly value="<?php echo $_SESSION["user"]['nama_lengkap'] ?>" class="form-control">
  </div>

  <div class="col-md-10 mb-3">
        <label>Ekstrakurikuler</label>
       <?php
        $user_id = $_SESSION["user"]["id_user"];
        $result = $kn->query("SELECT nama_ekstra FROM tb_ekstra JOIN tb_pelatih_ekstra ON tb_ekstra.id_ekstra = tb_pelatih_ekstra.id_ekstra WHERE id_pelatih = '$user_id'"); 
        $id_ekstra_pelatih = $result->fetch_assoc();
        ?>
        <input type="text" name="ekstra" readonly value="<?php echo $id_ekstra_pelatih['nama_ekstra'] ?>" class="form-control">
        </div>

        <div class="form-floating col-md-10 mb-3">
        <label>Deskripsi Jurnal</label>
        <textarea class="form-control" name="judul" id="floatingTextarea" required></textarea>
        </div>

        <div class="form-floating col-md-10 mb-3">
        <label>Isi Jurnal</label>
        <textarea class="form-control" name="isi" id="floatingTextarea" required></textarea>
        </div>
        
        <div class="col-md-10 mb-3">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>

</form>

 <?php
if (isset($_POST['submit']))
{
    $user_id = $_SESSION["user"]["id_user"];

        $result = $kn->query("SELECT * FROM tb_ekstra JOIN tb_pelatih_ekstra ON tb_ekstra.id_ekstra = tb_pelatih_ekstra.id_ekstra WHERE id_pelatih = '$user_id'"); 
        $id_ekstra_pelatih = $result->fetch_assoc();

        $idEks = $id_ekstra_pelatih['id_ekstra'];

    $kn->query("INSERT INTO tb_jurnal
        (id_user, id_ekstra, nama_ekstra, judul_jurnal, isi_jurnal)
        VALUES ('$user_id', '$idEks', '$_POST[ekstra]', '$_POST[judul]', '$_POST[isi]')");

    echo "<script>alert('Data berhasil dimasukkan');</script>";
    echo "<script>location='index.php?halaman=jurnal';</script>";
}
?>