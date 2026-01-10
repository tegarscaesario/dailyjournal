<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-25">Username</th>
            <th class="w-50">Foto</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
        $limit = 5; // LIMIT 5 UNTUK USER
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;

        $sql = "SELECT * FROM user ORDER BY id DESC LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);

        while ($row = $hasil->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><strong><?= $row["username"] ?></strong></td>
                <td>
                    <?php if ($row["foto"] != '' && file_exists('img/' . $row["foto"])) { ?>
                        <img src="img/<?= $row["foto"] ?>" width="100">
                    <?php } ?>
                </td>
                <td>
                    <a href="#" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Edit User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" value="<?= $row["username"] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password baru" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Foto Lama</label><br>
                                            <img src="img/<?= $row["foto"] ?>" width="100">
                                            <input type="hidden" name="foto_lama" value="<?= $row["foto"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Konfirmasi Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <label>Yakin menghapus user "<strong><?= $row["username"] ?></strong>"?</label>
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <input type="hidden" name="foto" value="<?= $row["foto"] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
$sql1 = "SELECT * FROM user";
$hasil1 = $conn->query($sql1); 
$total_records = $hasil1->num_rows;
?>
<p>Total User : <?= $total_records; ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
    <?php
        $jumlah_page = ceil($total_records / $limit);
        for($i = 1; $i <= $jumlah_page; $i++){
            $active = ($hlm == $i)? ' active' : '';
            echo '<li class="page-item halaman '.$active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }
    ?>
    </ul>
</nav>