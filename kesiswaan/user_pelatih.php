<h1 class="h3 mb-4 text-gray-800">Pelatih</h1>

<?php

$ambl = $kn->query("SELECT tb_user.id_user, tb_user.nama_lengkap, tb_user.username, tb_ekstra.nama_ekstra FROM tb_user
    LEFT JOIN tb_pelatih_ekstra ON tb_user.id_user=tb_pelatih_ekstra.id_pelatih 
    LEFT JOIN tb_ekstra ON tb_pelatih_ekstra.id_ekstra = tb_ekstra.id_ekstra
    WHERE tb_user.role ='Pelatih' ");
?>

<div class="card shadow mb-5">
                        <div class="card-header py-3 d-flex justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Data Pelatih</h6>
                          <p class="m-0 text-right">Gunakan tanda kutip " " untuk pencarian yang lebih spesifik</p>
                          </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: #67999A;" class="table text-white">
                                       <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Nama Pelatih</th>
                                          <th scope="col">Username</th>
                                          <th scope="col">Ekstrakurikuler</th>
                                          <th scope="col">Aksi</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                    <?php $nmr=1; ?>
    <?php while ($value = $ambl->fetch_assoc()): ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $value["nama_lengkap"] ?></td>
            <td><?php echo $value["username"] ?></td>
            <td><?php echo $value["nama_ekstra"] ?></td>
            <td>
                <a href="index.php?halaman=edit_pelatih&id=<?php echo $value['id_user']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?halaman=delete_pelatih&id=<?php echo $value['id_user']; ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php $nmr++; ?>
    <?php endwhile; ?>
          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


