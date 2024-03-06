
<h1 class="h3 mb-4 text-gray-800">Cek Absensi</h1>

                    <div class="card shadow mb-5">
                        <div class="card-header py-3 d-flex justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Data Absensi</h6>
                          <p class="m-0 text-right">Gunakan tanda kutip " " untuk pencarian yang lebih spesifik</p>
                          </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: #67999A;" class="table text-white">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Siswa</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Ekstrakurikuler</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Waktu Absensi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
           <?php $nmr=1; ?>
          <?php 
          $id = $_SESSION["user"]["id_user"];

          $ambl=$kn->query("SELECT tb_absensi.nama_ekstra, tb_absensi.id_absensi, tb_absensi.waktu_absen, tb_absensi.keterangan, tb_absensi.status, tb_kelas.kelas, tb_user.nama_lengkap
          FROM tb_absensi
          INNER JOIN tb_kelas ON tb_absensi.id_kelas = tb_kelas.id_kelas
          INNER JOIN tb_user ON tb_absensi.id_user = tb_user.id_user
          WHERE tb_absensi.id_pelatih = '$id'
          ORDER BY tb_absensi.waktu_absen DESC "); ?>

          <?php while($pch = $ambl->fetch_assoc()){ ?>
          <tr>
              <td><?php echo $nmr; ?></td>
              <td><?php echo $pch['nama_lengkap']; ?></td>
              <td><?php echo $pch['kelas']; ?></td>
              <td><?php echo $pch['nama_ekstra']; ?></td>
              <td><?php echo $pch['keterangan']; ?></td>
              <td><?php echo date('d F Y H:i', strtotime($pch['waktu_absen'])); ?></td>
              <td><?php echo $pch['status']; ?></td>
              <td>
                <a href="index.php?halaman=edit_cekabsensi&id=<?php echo $pch['id_absensi']; ?>" class="btn btn-warning">Edit</a>
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

      

 