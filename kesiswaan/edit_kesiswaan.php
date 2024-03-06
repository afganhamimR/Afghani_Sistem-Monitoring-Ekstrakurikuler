<h1 class="h3 mb-4 text-gray-800">Edit Kesiswaan</h1>

<?php

$ambl = $kn->query("SELECT tb_user.id_user, tb_user.nama_lengkap, tb_user.username FROM tb_user
    WHERE tb_user.id_user ='$_GET[id]' ");
    $value = $ambl->fetch_assoc();
?>

<form method="post">

 <div class="form-group col-md-5 mb-3">
    <label>Nama Lengkap</label>
    <input type="text" name="name" value="<?php echo $value['nama_lengkap'] ?>" class="form-control">
  </div>

  <div class="form-group col-md-5 mb-3">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $value['username'] ?>" class="form-control">
  </div>  

  <div class="form-group col-md-5 mb-3">
  <button class="btn btn-primary" type="submit" name="submit">Submit</button>
  </div>


</form>

 <?php
if (isset($_POST['submit']))
{

        $kn->query("UPDATE tb_user SET nama_lengkap='$_POST[name]',
        username='$_POST[username]'
        WHERE tb_user.id_user='$_GET[id]'");
    
    echo "<script>alert('Data Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=user_kesiswaan';</script>";
    
}
?>