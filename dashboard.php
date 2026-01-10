<?php
// Query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

// Menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows;

// Query untuk mengambil data gallery (SUDAH DIAKTIFKAN)
$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil2 = $conn->query($sql2);

// Menghitung jumlah baris data gallery (SUDAH DIAKTIFKAN)
$jumlah_gallery = $hasil2->num_rows;

// Query untuk mengambil data user (TAMBAHAN AGAR DASHBOARD LENGKAP)
$sql3 = "SELECT * FROM user";
$hasil3 = $conn->query($sql3);
$jumlah_user = $hasil3->num_rows;
?>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <a href="admin.php?page=article" class="text-decoration-none">
            <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-3">
                            <h5 class="card-title text-dark"><i class="bi bi-newspaper"></i> Article</h5> 
                        </div>
                        <div class="p-3">
                            <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
        </a>
    </div> 

    <div class="col">
        <a href="admin.php?page=gallery" class="text-decoration-none">
            <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-3">
                            <h5 class="card-title text-dark"><i class="bi bi-camera"></i> Gallery</h5> 
                        </div>
                        <div class="p-3">
                            <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_gallery; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
        </a>
    </div> 

    <div class="col">
        <a href="admin.php?page=user" class="text-decoration-none">
            <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-3">
                            <h5 class="card-title text-dark"><i class="bi bi-people"></i> User</h5> 
                        </div>
                        <div class="p-3">
                            <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_user; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
        </a>
    </div> 
</div>