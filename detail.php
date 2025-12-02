<?php
include 'koneksi.php';

// Ambil ID dan Data Artikel
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id='$id'");
    $data = mysqli_fetch_array($query);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!');window.location='index.php';</script>";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - <?= $data['judul']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #343a40;
        }
        .inside-nav {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        footer {
            background: #333;
            color: white;
            padding: 15px;
            text-align: right;
            margin-top: 50px;
        }
        .detail-content {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse show">
            <div class="pt-3">
                <div class="text-center mb-4 text-white">
                    <img src="https://static.vecteezy.com/system/resources/previews/042/156/815/non_2x/company-logo-design-vector.jpg" alt="Logo" class="img-fluid rounded-circle mb-2" style="max-height: 80px;">
                    <h5>PT. TEKNOLOGI DIGITAL</h5>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php#home">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#artikelSubmenu">
                            Artikel
                        </a>
                        <div class="collapse ps-3" id="artikelSubmenu">
                            <ul class="list-unstyled">
                                <?php
                                $queryArtikel = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id DESC");
                                
                                if(mysqli_num_rows($queryArtikel) > 0){
                                    while($row = mysqli_fetch_assoc($queryArtikel)){
                                        echo '<li><a href="detail.php?id='.$row['id'].'">📄 '.$row['judul'].'</a></li>';
                                    }
                                } else {
                                    echo '<li><a href="#">Belum ada artikel</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#event">Event Galery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#klien">Foto Klien</a>
                    </li>
                </ul>

                <hr class="text-white">

                <div class="px-3">
                    <p class="text-white-50 small">Area Anggota</p>
                    <a href="login.php" class="btn btn-primary btn-sm w-100 mb-2">Sign In</a>
                    <a href="#" class="btn btn-outline-light btn-sm w-100">Sign Up</a>
                </div>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            
            <div class="sticky-top inside-nav py-2 mb-4 bg-white shadow-sm">
                <ul class="nav justify-content-center">
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="index.php#profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="index.php#visi">Visi Misi</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="index.php#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="index.php#kontak">Kontak</a></li>
                </ul>
            </div>

            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Artikel</li>
                    </ol>
                </nav>

                <div class="detail-content">
                    <h1 class="mb-3"><?= $data['judul']; ?></h1>
                    <p class="text-muted small">Diposting pada: <?= date('d F Y', strtotime($data['tanggal'])); ?></p>
                    <hr>
                    
                    <div class="mb-4">
                        <h5>Deskripsi:</h5>
                        <p class="lead" style="text-align: justify;">
                            <?= nl2br($data['isi']); ?>
                        </p>
                    </div>

                    <div class="alert alert-light border p-4 text-center">
                        <p class="mb-3">Untuk membaca dokumen selengkapnya, silakan unduh file lampiran berikut:</p>
                        
                        <a href="uploads/<?= $data['file_name']; ?>" target="_blank" class="btn btn-success btn-lg">
                            <i class="bi bi-file-earmark-pdf"></i> Download / Lihat Dokumen (PDF/DOC)
                        </a>
                        
                        <br><br>
                        <a href="index.php" class="btn btn-outline-secondary">Kembali ke Halaman Utama</a>
                    </div>
                </div>
            </div>

            <footer>
                <p>Design by <a href="https://www.linkedin.com/in/habibisiregar79/" class="text-white">M Habibi Siregar</a></p>
            </footer>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>