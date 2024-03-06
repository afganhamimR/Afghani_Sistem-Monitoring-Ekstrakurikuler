<style>
  p .isi {
    margin-bottom: 10px; 
    line-height: 1.5; 
}
</style>

<h1 class="h3 mb-4 text-gray-800">Edit Jurnal</h1>

 <div class="card shadow mb-5">
                        <div class="card-header py-3 d-flex justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Data Jurnal</h6>
                          <p class="m-0 text-right">Gunakan tanda kutip " " untuk pencarian yang lebih spesifik</p>
                          </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: #67999A;" class="table text-white">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Ekstrakurikuler</th>
                                            <th scope="col">Tanggal, Waktu</th>
                                            <th scope="col">Deskripsi Jurnal</th>
                                            <th scope="col">Isi Jurnal</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
           <?php $nmr=1; ?>
          <?php 
          $user_id = $_SESSION["user"]["id_user"];

         $ambl = $kn->query("SELECT * FROM tb_jurnal INNER JOIN tb_pelatih_ekstra ON tb_jurnal.id_user = tb_pelatih_ekstra.id_pelatih
         	 INNER JOIN tb_user ON tb_jurnal.id_user = tb_user.id_user
             WHERE id_pelatih = '$user_id' ORDER BY tanggal DESC"); ?>

          <?php while($pch = $ambl->fetch_assoc()){ ?>
          <tr>
              <td><?php echo $nmr; ?></td>
              <td><?php echo $pch['nama_ekstra']; ?></td>
              <td><?php echo date('d F Y H:i', strtotime($pch['tanggal'])); ?></td>
              <td><?php echo $pch['judul_jurnal']; ?></td>
              <td>

                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#jurnal_<?php echo $pch['id_jurnal']; ?>">
                  Lihat
                </button>
            </td>
              <td>
                <a href="index.php?halaman=edit_jurnaleks&id=<?php echo $pch['id_jurnal']; ?>" class="btn btn-warning">Edit</a>
              </td>
          </tr>
          <?php $nmr++; ?>
          <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

 <?php 
          $user_id = $_SESSION["user"]["id_user"];

         $ambl = $kn->query("SELECT * FROM tb_jurnal INNER JOIN tb_pelatih_ekstra ON tb_jurnal.id_user = tb_pelatih_ekstra.id_pelatih
         	 JOIN tb_user ON tb_jurnal.id_user = tb_user.id_user
             WHERE id_pelatih = '$user_id'"); ?>               

<?php while($pch = $ambl->fetch_assoc()){ ?>

<div class="modal fade" id="jurnal_<?php echo $pch['id_jurnal']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Isi Jurnal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	 
     <p class="text-dark justify isi"><?php echo $pch["isi_jurnal"] ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php } ?>
