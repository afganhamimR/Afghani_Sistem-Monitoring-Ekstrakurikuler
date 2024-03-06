<h1 class="h3 mb-4 text-gray-800">Update Pendaftaran Ekstrakurikuler</h1>

<?php
	$result = $kn->query("SELECT status FROM tb_update_daftar_eks");              
    $row = $result->fetch_assoc(); ?>

<form method="post">
     
  	<div class="form-group col-md-5 mb-3">
  	<h5 class="mb-3">Status Pendaftaran : <?php echo $row['status'] ?></h5>
    <label>Ubah Status</label>
	  <select class="custom-select" name="pil">
	  <option value="Open">Open</option>
	  <option value="Close">Close</option>
	  </select>
  </div>

<div class="col-md-10 mb-3">
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>

  </form>

 <?php
if (isset($_POST['submit']))
{
    $kn->query("UPDATE tb_update_daftar_eks
	SET status = '$_POST[pil]' ");

    echo "<script>alert('Status Berhasil diupdate');</script>";
    echo "<script>location='index.php?halaman=update_daftar_eks';</script>";
}
?>