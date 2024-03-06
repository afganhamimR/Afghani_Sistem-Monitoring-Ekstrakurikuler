<h1 class="h3 mb-4 text-gray-800">Edit Ekstrakurikuler</h1>

<form class="offset-md-1" method="post" enctype="multipart/form-data">

  <div class="form-group col-md-10 mb-3">
    <label>Nama Lengkap</label>
    <input type="name" readonly value="<?php echo $_SESSION["user"]['nama_lengkap'] ?>" class="form-control">
  </div>

  <div class="col-md-10 mb-3">
        <label>Ekstrakurikuler</label>
       <?php
        $user_id = $_SESSION["user"]["id_user"];
        $result = $kn->query("SELECT nama_ekstra FROM tb_ekstra INNER JOIN tb_pelatih_ekstra ON tb_ekstra.id_ekstra = tb_pelatih_ekstra.id_ekstra WHERE id_pelatih = '$user_id'"); 
        $id_ekstra_pelatih = $result->fetch_assoc();
        ?>
        <input type="text" name="ekstra" readonly value="<?php echo $id_ekstra_pelatih['nama_ekstra'] ?>" class="form-control">
        </div>

        <?php

        $ambl = $kn->query("SELECT * FROM tb_jurnal
             WHERE id_jurnal = '$_GET[id]' ");
        $pch = $ambl->fetch_assoc(); ?>

        <div class="form-floating col-md-10 mb-3">
        <label>Deskripsi Jurnal</label>
        <textarea class="form-control" name="judul" id="floatingTextarea" required><?php echo $pch['judul_jurnal'] ?></textarea>
        </div>

        <div class="form-floating col-md-10 mb-3">
        <label>Isi Jurnal</label>
        <textarea class="form-control" name="isi" id="floatingTextarea" required><?php echo $pch['isi_jurnal'] ?></textarea>
        </div>
        
        <div class="col-md-10 mb-3">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>

</form>

 <?php
if (isset($_POST['submit']))
{
    $kn->query("UPDATE tb_jurnal
  SET judul_jurnal = '$_POST[judul]', isi_jurnal = '$_POST[isi]' WHERE id_jurnal= '$_GET[id]' ");

    echo "<script>alert('Jurnal Berhasil diupdate');</script>";
    echo "<script>location='index.php?halaman=edit_jurnal';</script>";
}
?>