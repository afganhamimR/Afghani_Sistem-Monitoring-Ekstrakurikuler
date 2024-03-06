<h1 class="h3 mb-4 text-gray-800">Kesiswaan</h1>

<?php

$ambl = $kn->query("SELECT tb_user.id_user, tb_user.nama_lengkap, tb_user.username FROM tb_user WHERE tb_user.role ='Kesiswaan' ");
?>

<div class="card shadow mb-5">
                        <div class="card-header py-3 d-flex justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Data Kesiswaan</h6>
                          <p class="m-0 text-right">Gunakan tanda kutip " " untuk pencarian yang lebih spesifik</p>
                          </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color: #67999A;" class="table text-white">
                                       <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Nama Kesiswaan</th>
                                          <th scope="col">Username</th>
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
            <td>
                <a href="index.php?halaman=edit_kesiswaan&id=<?php echo $value['id_user']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?halaman=delete_kesiswaan&id=<?php echo $value['id_user']; ?>" class="btn btn-danger">Hapus</a>
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


