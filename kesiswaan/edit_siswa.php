<h1 class="h3 mb-4 text-gray-800">Edit Siswa</h1>

<?php

$ambl = $kn->query("SELECT tb_user.id_user, tb_user.nama_lengkap, tb_kelas.kelas, tb_user.username,
tb_kelas.nis
 FROM tb_user
	LEFT JOIN tb_kelas ON tb_user.id_user = tb_kelas.id_user
    WHERE tb_user.id_user ='$_GET[id]' ");
	$value = $ambl->fetch_assoc();
?>

<form method="post">

 <div class="form-group col-md-5 mb-3">
    <label>Nama Lengkap</label>
    <input type="text" name="name" value="<?php echo $value['nama_lengkap'] ?>" class="form-control">
  </div>

  <div class="form-group col-md-5 mb-3">
    <label>NIS (Nomor Induk Siswa)</label>
    <input type="text" name="nis" value="<?php echo $value['nis'] ?>" class="form-control">
  </div>

  <div class="form-group col-md-5 mb-3">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $value['username'] ?>" class="form-control">
  </div>

  <div class="col-md-5 mb-3">
  <label class="d-block d-md-inline">Kelas</label>
  <select class="custom-select custom-select-overflow" name="kelas">
  <option selected><?php echo $value['kelas'] ?></option>
  <!-- KELAS X -->
              <option value="X DPIB A">X DPIB A</option>
              <option value="X DPIB B">X DPIB B</option>
              <option value="X DPIB C">X DPIB C</option>
              <option value="X RPL A">X RPL A</option>
              <option value="X RPL B">X RPL B</option>
              <option value="X RPL C">X RPL C</option>
              <option value="X T BKP A">X T BKP A</option>
              <option value="X T BKP B">X T BKP B</option>
              <option value="X T EI A">X T EI A</option>
              <option value="X T EI B">X T EI B</option>
              <option value="X T LAS A">X T LAS A</option>
              <option value="X T LAS B">X T LAS B</option>
              <option value="X T OI A">X T OI A</option>
              <option value="X T OI B">X T OI B</option>
              <option value="X TBSM A">X TBSM A</option>
              <option value="X TBSM B">X TBSM B</option>
              <option value="X TPM A">X TPM A</option>
              <option value="X TPM B">X TPM B</option>
              <option value="X TPM C">X TPM C</option>
              <option value="X TPM D">X TPM D</option>
              <option value="X TPTU A">X TPTU A</option>
              <option value="X TPTU B">X TPTU B</option>
              <!-- KELAS XI -->
              <option value="XI DPIB A">XI DPIB A</option>
              <option value="XI DPIB B">XI DPIB B</option>
              <option value="XI DPIB C">XI DPIB C</option>
              <option value="XI RPL A">XI RPL A</option>
              <option value="XI RPL B">XI RPL B</option>
              <option value="XI RPL C">XI RPL C</option>
              <option value="XI T BKP A">XI T BKP A</option>
              <option value="XI T BKP B">XI T BKP B</option>
              <option value="XI T EI A">XI T EI A</option>
              <option value="XI T EI B">XI T EI B</option>
              <option value="XI T LAS A">XI T LAS A</option>
              <option value="XI T LAS B">XI T LAS B</option>
              <option value="XI T OI A">XI T OI A</option>
              <option value="XI T OI B">XI T OI B</option>
              <option value="XI TBSM A">XI TBSM A</option>
              <option value="XI TBSM B">XI TBSM B</option>
              <option value="XI TPM A">XI TPM A</option>
              <option value="XI TPM B">XI TPM B</option>
              <option value="XI TPM C">XI TPM C</option>
              <option value="XI TPM D">XI TPM D</option>
              <option value="XI TPTU A">XI TPTU A</option>
              <option value="XI TPTU B">XI TPTU B</option>
              <!-- KELAS XII -->
              <option value="XII DPIB A">XII DPIB A</option>
              <option value="XII DPIB B">XII DPIB B</option>
              <option value="XII DPIB C">XII DPIB C</option>
              <option value="XII RPL A">XII RPL A</option>
              <option value="XII RPL B">XII RPL B</option>
              <option value="XII RPL C">XII RPL C</option>
              <option value="XII T BKP A">XII T BKP A</option>
              <option value="XII T BKP B">XII T BKP B</option>
              <option value="XII T EI A">XII T EI A</option>
              <option value="XII T EI B">XII T EI B</option>
              <option value="XII T LAS A">XII T LAS A</option>
              <option value="XII T LAS B">XII T LAS B</option>
              <option value="XII T OI A">XII T OI A</option>
              <option value="XII T OI B">XII T OI B</option>
              <option value="XII TBSM A">XII TBSM A</option>
              <option value="XII TBSM B">XII TBSM B</option>
              <option value="XII TPM A">XII TPM A</option>
              <option value="XII TPM B">XII TPM B</option>
              <option value="XII TPM C">XII TPM C</option>
              <option value="XII TPM D">XII TPM D</option>
              <option value="XII TPTU A">XII TPTU A</option>
              <option value="XII TPTU B">XII TPTU B</option>

  </select>
  </div>

  <div class="form-group col-md-5 mb-3">
  <button class="btn btn-primary" type="submit" name="submit">Submit</button>
  </div>

</form>

  <?php
if (isset($_POST['submit']))
{
          
        $kn->query("UPDATE tb_user, tb_kelas SET nama_lengkap='$_POST[name]',
        username='$_POST[username]',kelas='$_POST[kelas]', nis='$_POST[nis]'
        WHERE tb_user.id_user='$_GET[id]' AND tb_kelas.id_user='$_GET[id]'");
    
    echo "<script>alert('Data Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=user_siswa';</script>";
    
}
?>


