<h1 class="h3 mb-4 text-gray-800">Ekstrakurikuler</h1>

<style>
  .btn-ekstra {
    background-color: #278183;
    border-color: #67999A ;
    color: #fff;
  }
  .btn-ekstra:hover {
    background-color: #67999A;
    color: #fff;
  }
</style>

<div class="modal fade" id="tambahEkstra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Ekstrakurikuler</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">

  <div class="form-group col-md-10 mb-3">
    <label>Nama Ekstrakurikuler</label>
    <input type="name" name="name" class="form-control" required>
  </div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php
if (isset($_POST['submit']))
{
    
    {

        $kn->query("INSERT INTO tb_ekstra
        (nama_ekstra)
        VALUES('$_POST[name]')"); 

    }
    
    echo "<script>alert('Data berhasil di masukkan');</script>";
    echo "<script>location='index.php?halaman=ekstra';</script>";
    
}
?>

<button type="button" class="btn btn-ekstra mb-3 tooltip-test" title="Tambah Ekstrakurikuler" data-toggle="modal" data-target="#tambahEkstra"><i class="fas fa-plus-circle"></i> Tambah</button>

<div class="card shadow mb-5">
                        <div class="card-header py-3 d-flex justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Data Ekstrakurikuler</h6>
                          <p class="m-0 text-right">Gunakan tanda kutip " " untuk pencarian yang lebih spesifik</p>
                          </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: #67999A;" class="table text-white">
                                       <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Nama Ekstrakurikuler</th>
                                          <th scope="col">Hari</th>
                                          <th scope="col">Jam</th>
                                          <th scope="col">Aksi</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                    <?php $nmr=1; ?>
        <?php $ambl=$kn->query("SELECT * FROM tb_ekstra"); ?>
        <?php while($pch = $ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama_ekstra']; ?></td>
            <td><?php echo $pch['hari']; ?></td>
            <td><?php echo date("H:i",strtotime($pch["jam"])) ?></td>
            <td><a href="index.php?halaman=delete_ekstra&id=<?php echo $pch['id_ekstra']; ?>" class="btn btn-danger">Hapus</a>


              <div class="modal fade" id="editEkstra_<?php echo $pch['id_ekstra']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Ekstrakurikuler</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">

  <div class="form-group col-md-10 mb-3">
    <label>Nama Ekstrakurikuler</label>
    <input type="name" class="form-control" name="namaeks" value="<?php echo $pch['nama_ekstra']; ?>" readonly>
  </div>
  <div class="form-group col-md-10 mb-3">
    <label>Pilih Hari kegiatan Ekstrakurikuler</label>
    <select class="custom-select" name="hari">
    <option selected><?php echo $pch["hari"] ?></option>
    <option value="Senin">Senin</option>
    <option value="Selasa">Selasa</option>
    <option value="Rabu">Rabu</option>
    <option value="Kamis">Kamis</option>
    <option value="Jumat">Jumat</option>
    <option value="Sabtu">Sabtu</option>
    </select>
</div>
  <div class="form-group col-md-10 mb-3">
    <label>Jam Ekstrakurikuler</label>
<?php


$ideks = $pch['id_ekstra'];

$query = $kn->query("SELECT jam FROM tb_ekstra WHERE id_ekstra='$ideks'");
$row = $query->fetch_assoc();
$jam_default = $row['jam'];

$jam_default_formatted = date('H:i', strtotime($jam_default));
?>

<input type="time" name="jam" class="form-control" value="<?php echo $jam_default_formatted; ?>">

</div>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
      </div>

      <?php
if (isset($_POST['edit']))
{
    
        $ambl=$kn->query("SELECT * FROM tb_ekstra WHERE nama_ekstra = '$_POST[namaeks]'"); 
        $namaeks = $ambl->fetch_assoc();

        $ideks = $namaeks['id_ekstra'];

        $kn->query("UPDATE tb_ekstra SET hari='$_POST[hari]',
        jam='$_POST[jam]'
        WHERE id_ekstra='$ideks'");
 

    
    echo "<script>alert('Data berhasil di tambahkan');</script>";
    echo "<script>location='index.php?halaman=ekstra';</script>";
    
}
?>

      </form>
    </div>
  </div>
</div>

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editEkstra_<?php echo $pch['id_ekstra']; ?>">Edit</button>
        </tr>
        <?php $nmr++; ?>
        <?php } ?>
          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>