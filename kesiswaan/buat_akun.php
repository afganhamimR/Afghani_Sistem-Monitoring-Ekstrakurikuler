  <style>
  .custom-select-overflow {
    overflow: auto; 
    max-height: 200px; 
  }
span #bin {
    color: red;
}
  </style>
<h1 class="h3 mb-4 text-gray-800">Buat Akun</h1>

<form class="offset-md-1" method="post" enctype="multipart/form-data">

  <div class="form-group col-md-10 mb-3">
    <label>Nama Lengkap</label>
    <input type="name" name="name" class="form-control" required>
  </div>

  <div class="form-group col-md-10 mb-3">
    <label>NIS (Nomor Induk Siswa)<span><span id="bin"> *</span>Jika role siswa</span></label>
    <input type="text" name="nis" class="form-control">
  </div>

  <div class="form-group col-md-10 mb-3">
    <label>Username</label>
    <input type="username" name="username" class="form-control" required>
  </div>

  <div class="form-group col-md-10 mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
  </div>
  
  <div class="col-md-10 mb-3">
  <label>Role</label>
  <select class="custom-select" name="role">
  <option selected>Pilih Role</option>
  <option value="kesiswaan">Kesiswaan</option>
  <option value="pelatih">Pelatih</option>
  <option value="siswa">Siswa</option>
  </select>
  </div>

  <div class="col-md-10 mb-3">
        <label>Ekstrakurikuler Pelatih <span><span id="bin">*</span>Jika role pelatih</span></label>
        <select class="custom-select" name="ekstra">
        <option selected>Pilih Ekstrakurikuler Pelatih</option>
          <?php
        $result = $kn->query("SELECT * FROM tb_ekstra");

        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['nama_ekstra'] . '">' . $row['nama_ekstra'] . '</option>';
        } ?>
        </select>

  </div>

  <div class="col-md-10 mb-3">
  <label>Kelas<span><span id="bin"> *</span>Jika role siswa</span></label>
  <select class="custom-select custom-select-overflow" name="kelas">
  <option selected>Pilih Kelas</option>
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
  
  <div class="col-md-10 mb-4">
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>

</form>



<?php
if (isset($_POST['submit'])) {
    $pass = md5($_POST['password']);

    $ekstra_exists = false;

    $username = $_POST['username'];
    $check_username_query = $kn->query("SELECT * FROM tb_user WHERE username = '$username'");
    if ($check_username_query->num_rows > 0) {
        echo "<script>alert('Username sudah digunakan. Silakan pilih username lain.');</script>";
        echo "<script>location='index.php?halaman=buatakun';</script>";
        exit();
    }
   
    if ($_POST['ekstra'] != "Pilih Ekstrakurikuler Pelatih") {
        
        $result = $kn->query("SELECT id_ekstra FROM tb_ekstra WHERE nama_ekstra = '$_POST[ekstra]'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_ekstra = $row['id_ekstra'];

            $result = $kn->query("SELECT id_ekstra FROM tb_pelatih_ekstra WHERE id_ekstra = '$id_ekstra'");

            if ($result->num_rows > 0) {
                
                echo "<script>alert('Ekstra sudah terdapat pada pelatih.');</script>";
                echo "<script>location='index.php?halaman=buatakun';</script>";
                exit();
            } else {
            
                $ekstra_exists = true;

                $kn->query("INSERT INTO tb_user (nama_lengkap,username,password,role)
                    VALUES('$_POST[name]','$_POST[username]','$pass','$_POST[role]')");

                $pelatih_id = $kn->insert_id;
                $kn->query("INSERT INTO tb_pelatih_ekstra (id_ekstra, id_pelatih) VALUES ('$id_ekstra', '$pelatih_id')");

                $kn->query("UPDATE tb_ekstra_diikuti SET id_pelatih='$pelatih_id'
                WHERE id_ekstra='$id_ekstra'");
                 
                echo "<script>alert('Data berhasil dimasukkan');</script>";
                echo "<script>location='index.php?halaman=buatakun';</script>";


            }
        }
    }

    if (!$ekstra_exists) {
       
        $kn->query("INSERT INTO tb_user (nama_lengkap,username,password,role)
                    VALUES('$_POST[name]','$_POST[username]','$pass','$_POST[role]')");
        
        $user_id = $kn->insert_id;
        $nis = $_POST['nis'];

        if ($_POST['kelas'] != "Pilih Kelas") {
            $kn->query("INSERT INTO tb_kelas (id_user,kelas,nis)
                        VALUES('$user_id','$_POST[kelas]','$nis')");
        }

       
        echo "<script>alert('Data berhasil dimasukkan');</script>";
    
        echo "<script>location='index.php?halaman=buatakun';</script>";
    }
}

?>  