
<?php
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";

if (isset($_POST["submit"]))
{

    $tgl_mulai= $_POST["tglm"];
    $tgl_selesai= $_POST["tgls"];
    $ekstra = $_POST["ekstra"];
  
    $ambl = $kn->query("SELECT * FROM tb_jurnal 
    LEFT JOIN tb_pelatih_ekstra ON tb_jurnal.id_user=tb_pelatih_ekstra.id_pelatih 
    LEFT JOIN tb_user ON tb_jurnal.id_user= tb_user.id_user
    WHERE tb_jurnal.nama_ekstra ='$ekstra' AND tb_jurnal.tanggal BETWEEN '$tgl_mulai' AND  '$tgl_selesai' ");
   while($pch = $ambl->fetch_assoc())
   {
     $semuadata[]=$pch;
   }

}
 ?>

<h2 class="h3 mb-4 text-gray-800">
    Laporan Jurnal Ekstrakurikuler
    <?php
    echo (!empty($semuadata)) ? date("d-m-Y", strtotime($tgl_mulai)) : '-';
    ?> S/D
    <?php
    echo (!empty($semuadata)) ? date("d-m-Y", strtotime($tgl_selesai)) : '-';
    ?>
</h2>

 <form method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tglm" class="form-control">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tgls" class="form-control">
                </div>
            </div>
            <div class="col-md-3 mb-3">
            <label>Ekstrakurikuler</label>
            <select class="custom-select" name="ekstra">
            <option selected>Pilih Ekstrakurikuler</option>
              <?php
            $result = $kn->query("SELECT * FROM tb_ekstra");

            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['nama_ekstra'] . '">' . $row['nama_ekstra'] . '</option>';
            } ?>
            </select>
            </div>
            <div class="col-md-2 mb-3">
                <div class="form-group">
                    <button style="margin-top: 32px;" class="btn btn-primary" name="submit"><i class="fa fa-fw fa-search"></i> Lihat Laporan</button>
                </div>
            </div>
             </div>
        </div>
</form>

<div class="card shadow mb-3">
                        <div class="card-header py-3 d-flex justify-content-between">
                          <?php $ekstra = isset($_POST["ekstra"]) ? $_POST["ekstra"] : ""; ?>
                            
                            <h6 class="m-0 font-weight-bold text-primary">Laporan Jurnal Ekstrakurikuler <?php echo $ekstra ?> </h6>
                          <p class="m-0 text-right">Gunakan tanda kutip " " untuk pencarian yang lebih spesifik</p>
                          </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: #67999A;" class="table text-white">
                                       <tr>
                                           <th scope="col">No</th>
                                           <th scope="col">Nama Pelatih</th>
                                           <th scope="col">Waktu dibuat</th>
                                           <th scope="col">Deskripsi Jurnal</th>
                                           <th scope="col">Isi Jurnal</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                    <?php foreach ($semuadata as $key => $value): ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value["nama_lengkap"] ?></td>
            <td><?php echo date("d F Y H:i",strtotime($value["tanggal"])) ?></td>
            <td><?php echo $value["judul_jurnal"] ?></td>
            <td>

                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#jurnal_<?php echo $value['id_jurnal']; ?>">
                  Lihat
                </button>
            </td>
        </tr>
        <?php endforeach ?>
          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            <a href="cetak_pdf_jurnal.php?tglm=<?php echo $tgl_mulai ?>&tgls=<?php echo $tgl_selesai ?>&ekstra=<?php echo $ekstra ?>" class="btn btn-danger mb-5" target="_blank" ><i class="far fa-fw fa-file-pdf"></i> Cetak PDF</a>


<!-- Modal -->

<?php foreach ($semuadata as $value): ?>

<div class="modal fade" id="jurnal_<?php echo $value['id_jurnal']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Isi Jurnal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <p class="text-dark justify"><?php echo $value["isi_jurnal"] ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <?php endforeach ?>

  