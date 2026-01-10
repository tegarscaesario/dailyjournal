<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Keterangan</th>
            <th class="text-center">Gambar</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    include "koneksi.php";

    $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
    $limit = 3;
    $limit_start = ($hlm - 1) * $limit;
    $no = $limit_start + 1;

    $sql = "SELECT * FROM gallery ORDER BY tanggal DESC LIMIT $limit_start, $limit";
    $hasil = $conn->query($sql);

    while ($row = $hasil->fetch_assoc()) {
    ?>
        <tr>
            <td><?= $no++ ?></td>

            <!-- KETERANGAN -->
            <td>
                <strong><?= $row["judul"] ?></strong><br>
                pada : <?= $row["tanggal"] ?><br>
                oleh : <?= $row["username"] ?>
            </td>

            <!-- GAMBAR -->
            <td class="text-center">
                <?php if ($row["gambar"] != '' && file_exists('img/'.$row["gambar"])) { ?>
                    <img src="img/<?= $row["gambar"] ?>" class="img-thumbnail w-50">
                <?php } else { ?>
                    <span class="text-muted">Tidak ada</span>
                <?php } ?>
            </td>

            <!-- AKSI -->
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <a href="#" title="Edit"
                       class="badge rounded-pill text-bg-success"
                       data-bs-toggle="modal"
                       data-bs-target="#modalEdit<?= $row["id"] ?>">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <a href="#" title="Hapus"
                       class="badge rounded-pill text-bg-danger"
                       data-bs-toggle="modal"
                       data-bs-target="#modalHapus<?= $row["id"] ?>">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
            </td>
        </tr>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="modalEdit<?= $row["id"] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Ganti Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar Lama</label><br>
                                <?php if ($row["gambar"] != '' && file_exists('img/'.$row["gambar"])) { ?>
                                    <img src="img/<?= $row["gambar"] ?>" class="img-thumbnail w-50">
                                <?php } ?>
                                <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL HAPUS -->
        <div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            Yakin hapus "<strong><?= $row["judul"] ?></strong>"?
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php } ?>
    </tbody>
</table>

<?php
$sql1 = "SELECT * FROM gallery";
$hasil1 = $conn->query($sql1);
$total_records = $hasil1->num_rows;
?>

<p>Total gallery : <?= $total_records ?></p>

<nav>
<ul class="pagination justify-content-end">
<?php
$jumlah_page = ceil($total_records / $limit);

if ($hlm > 1) {
    echo '<li class="page-item halaman" id="1"><a class="page-link">First</a></li>';
    echo '<li class="page-item halaman" id="'.($hlm-1).'"><a class="page-link">&laquo;</a></li>';
}

for ($i = 1; $i <= $jumlah_page; $i++) {
    $active = ($hlm == $i) ? 'active' : '';
    echo '<li class="page-item halaman '.$active.'" id="'.$i.'">
            <a class="page-link">'.$i.'</a>
          </li>';
}

if ($hlm < $jumlah_page) {
    echo '<li class="page-item halaman" id="'.($hlm+1).'"><a class="page-link">&raquo;</a></li>';
    echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link">Last</a></li>';
}
?>
</ul>
</nav>
