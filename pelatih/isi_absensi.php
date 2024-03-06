<h1 class="h3 mb-4 text-gray-800">Isi Absensi</h1>

<?php

$User_id = $_SESSION["user"]["id_user"];

$id = $kn->query("SELECT id_ekstra FROM tb_pelatih_ekstra WHERE id_pelatih = '$User_id'");
$ID_eks = $id->fetch_assoc();

$ambl = $kn->query("SELECT tb_user.nama_lengkap, tb_user.id_user, tb_kelas.kelas, tb_buat_absensi.hari, tb_buat_absensi.tanggal, tb_ekstra_diikuti.nama_ekstra FROM tb_ekstra_diikuti 
  LEFT JOIN tb_buat_absensi ON tb_ekstra_diikuti.id_ekstra =tb_buat_absensi.id_ekstra 
  LEFT JOIN tb_user ON tb_ekstra_diikuti.id_user = tb_user.id_user 
  LEFT JOIN tb_kelas ON tb_ekstra_diikuti.id_kelas = tb_kelas.id_kelas
  WHERE tb_buat_absensi.id_ekstra = '{$ID_eks["id_ekstra"]}' AND tb_ekstra_diikuti.id_pelatih = '$User_id'");
?>

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
                                            <th scope="col">Ekstrakurikuler</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Hari</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Absensi</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                  <?php $nmr=1; ?>
                            <?php while($perabsen = $ambl->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $nmr; ?></td>
                                <td><?php echo $perabsen['nama_lengkap']; ?></td>
                                <td><?php echo $perabsen['nama_ekstra']; ?></td>
                                <td><?php echo $perabsen['kelas']; ?></td>
                                <td><?php echo $perabsen['hari']; ?></td>
                                <td><?php echo date("d F Y", strtotime($perabsen['tanggal'])); ?></td>
                                <td>
                                <?php  
                                $query = $kn->query("SELECT MAX(id_buat_absensi) AS max_id FROM tb_buat_absensi WHERE id_ekstra='{$ID_eks["id_ekstra"]}' ");
                                $row = $query->fetch_assoc();
                                $id_buat_absensi_baru = $row['max_id']; 

                                $ket_query = $kn->query("SELECT keterangan FROM tb_absensi WHERE id_user = '{$perabsen["id_user"]}' AND id_buat_absensi = '$id_buat_absensi_baru'");
                                $ket_row = $ket_query->fetch_assoc();

                               
                                if ($ket_row !== null && isset($ket_row['keterangan'])) {
                                    $ket = $ket_row['keterangan'];
                                } else {
                                    
                                    $ket = 'Sudah Absensi';
                                }

                               
                                if($ket != 'Hadir' && $ket != 'Tidak Hadir' && $ket != 'Sakit' && $ket != 'Izin') {
                                    echo '<a href="index.php?halaman=isi_kehadiran&id='.$perabsen['id_user'].'" class="btn btn-primary">Isi Absensi</a>';
                                } else {
                               echo 'Sudah Absensi';
                                }
                                ?>

                                </td>

                            <?php $nmr++; ?>
                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>