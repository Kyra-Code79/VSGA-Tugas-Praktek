<?php
include 'koneksi.php';

// --- AMBIL DATA PROFILE (Ambil data terakhir/terbaru) ---
$queryProfile = mysqli_query($koneksi, "SELECT * FROM profile ORDER BY id DESC LIMIT 1");
$dataProfile = mysqli_fetch_array($queryProfile);

// Antisipasi jika data profile kosong agar tidak error
if (!$dataProfile) {
    $dataProfile = [
        'visi' => 'Belum ada data visi',
        'misi' => 'Belum ada data misi',
        'tentang_kami' => 'Belum ada data tentang kami',
        'kontak_kami' => 'Belum ada data kontak',
        'foto_profile' => 'default.jpg' // Pastikan ada dummy image jika kosong
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile - JWD 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed; 
            top: 0; bottom: 0; left: 0;
            z-index: 100; padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            overflow-y: auto; 
            background-color: #212529; 
        }
        .sidebar a {
            color: #fff; text-decoration: none;
            padding: 10px 15px; display: block;
        }
        .sidebar a:hover { background-color: #343a40; }
        .inside-nav {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        section {
            padding-top: 20px; padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .img-event, .img-client {
            width: 100%; height: 200px; object-fit: cover;
        }
        footer {
            background: #333; color: white;
            padding: 15px; text-align: right; margin-top: 20px;
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
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#artikelSubmenu">Artikel</a>
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
                    <li class="nav-item"><a class="nav-link" href="#event">Event Galery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#klien">Foto Klien</a></li>
                </ul>
                <hr class="text-white">
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            
            <div class="sticky-top inside-nav py-2 mb-4 bg-white shadow-sm">
                <ul class="nav justify-content-center">
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#visi">Visi Misi</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#kontak">Kontak</a></li>
                </ul>
            </div>

            <section id="home" class="text-center py-5 bg-light rounded">
                <h1 class="display-4">Selamat Datang</h1>
                <p class="lead">Company Profile PT. Teknologi Digital</p>
            </section>

            <section id="visi" class="py-5">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">Visi & Misi</h2>
                        <p class="text-muted">Arah dan tujuan kami dalam membangun masa depan digital.</p>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm p-4 text-center">
                                <div class="card-body">
                                    <h3 class="text-primary mb-3">Visi</h3>
                                    <p class="lead fst-italic">
                                        "<?= nl2br($dataProfile['visi']); ?>"
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm p-4">
                                <div class="card-body">
                                    <h3 class="text-primary mb-3 text-center">Misi</h3>
                                    <div class="card-text">
                                        <?= nl2br($dataProfile['misi']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="about" class="py-5 bg-light">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0 text-center">
                            <img src="uploads/<?= $dataProfile['foto_profile']; ?>" alt="Tim Kami" class="img-fluid rounded shadow-lg" style="max-height: 400px;">
                        </div>

                        <div class="col-md-6">
                            <h2 class="fw-bold mb-4">Tentang Kami</h2>
                            <div class="text-muted" style="text-align: justify;">
                                <?= nl2br($dataProfile['tentang_kami']); ?>
                            </div>
                            <div class="mt-4">
                                <a href="#kontak" class="btn btn-primary px-4 py-2">Hubungi Kami</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="event">
                <h2 class="mb-4">Event & Gallery</h2>
                <div class="row">
                    <?php
                    $queryEvent = mysqli_query($koneksi, "SELECT * FROM event ORDER BY id DESC");
                    if (mysqli_num_rows($queryEvent) > 0) {
                        while ($event = mysqli_fetch_assoc($queryEvent)) {
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="uploads/<?= $event['image']; ?>" class="card-img-top img-event" alt="<?= $event['nama_event']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $event['nama_event']; ?></h5>
                                    <p class="card-text small text-muted"><?= substr($event['deskripsi'], 0, 100); ?>...</p>
                                </div>
                            </div>
                        </div>
                    <?php 
                        }
                    } else {
                        echo "<div class='alert alert-warning'>Belum ada data event.</div>";
                    }
                    ?>
                </div>
            </section>
            
            <section id="klien">
                <h2 class="mb-4">Klien Kami</h2>
                <div class="row">
                    <?php
                    $queryClient = mysqli_query($koneksi, "SELECT * FROM client ORDER BY id DESC");
                    if (mysqli_num_rows($queryClient) > 0) {
                        while ($client = mysqli_fetch_assoc($queryClient)) {
                    ?>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card border-0 shadow-sm h-100 text-center p-3 align-items-center justify-content-center">
                                <img src="uploads/<?= $client['image_client']; ?>" class="img-fluid" alt="<?= $client['nama_client']; ?>" style="max-height: 100px;">
                                <h6 class="mt-2 text-muted"><?= $client['nama_client']; ?></h6>
                            </div>
                        </div>
                    <?php 
                        }
                    } else {
                        echo "<div class='alert alert-warning'>Belum ada data klien.</div>";
                    }
                    ?>
                </div>
            </section>
            
            <section id="kontak">
                <h2>Kontak Kami</h2>
                <div class="alert alert-info">
                    <?= nl2br($dataProfile['kontak_kami']); ?>
                </div>
            </section>

             <footer>
                <p>Design by <a href="#" class="text-white text-decoration-none">M Habibi Siregar</a></p>
            </footer>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>