<?php
include 'koneksi.php';
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
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            overflow-y: auto; 
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
        section {
            padding-top: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        footer {
            background: #333;
            color: white;
            padding: 15px;
            text-align: right;
            margin-top: 20px;
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
                        <a class="nav-link active" href="#home">Home</a>
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
                        <a class="nav-link" href="#event">Event Galery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#klien">Foto Klien</a>
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
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#profile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#visi">Visi Misi</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-dark fw-bold" href="#produk">Produk Kami</a></li>
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
                                        "Menjadi perusahaan teknologi terdepan yang memberikan solusi digital inovatif, adaptif, dan transformatif untuk memajukan ekosistem bisnis di Indonesia maupun global."
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm p-4">
                                <div class="card-body">
                                    <h3 class="text-primary mb-3 text-center">Misi</h3>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item border-0">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Memberikan layanan pengembangan perangkat lunak dengan standar kualitas terbaik.
                                        </li>
                                        <li class="list-group-item border-0">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Menciptakan inovasi teknologi yang efisien dan tepat guna bagi klien.
                                        </li>
                                        <li class="list-group-item border-0">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Membangun sumber daya manusia yang kompeten, kreatif, dan berintegritas.
                                        </li>
                                        <li class="list-group-item border-0">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Menjalin kemitraan strategis yang berkelanjutan dengan berbagai sektor industri.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="about" class="py-5 bg-light">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tim Kami" class="img-fluid rounded shadow-lg">
                        </div>

                        <div class="col-md-6">
                            <h2 class="fw-bold mb-4">Tentang Kami</h2>
                            <h4 class="text-primary">Membangun Solusi Digital Sejak 2010</h4>
                            <p class="lead text-muted">
                                PT. Teknologi Digital adalah perusahaan konsultan IT dan pengembangan perangkat lunak yang berdedikasi untuk membantu transformasi digital bisnis di Indonesia.
                            </p>
                            <p>
                                Bermula dari sebuah tim kecil di garasi pada tahun 2010, kami kini telah berkembang menjadi entitas korporat dengan lebih dari 100 talenta digital berbakat. Kami berfokus pada pengembangan aplikasi web, mobile, dan integrasi sistem enterprise.
                            </p>
                            <p>
                                Komitmen kami adalah memberikan hasil kerja berkualitas tinggi yang tidak hanya memenuhi spesifikasi teknis, tetapi juga memberikan dampak bisnis nyata bagi klien kami.
                            </p>
                            <div class="mt-4">
                                <a href="#kontak" class="btn btn-primary px-4 py-2">Hubungi Kami</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="event">
                <h2>Event & Gallery</h2>
                <div class="row">
                    <div class="col-md-4"><img src="https://i.pinimg.com/originals/68/d1/35/68d135b6acf1c79367d30ce8cb36189f.png" class="img-fluid mb-2 rounded" alt="Event 1"></div>
                    <div class="col-md-4"><img src="https://wallpapers.com/images/hd/corporate-event-1920-x-1080-wallpaper-ye26661ghfhn8aro.jpg" class="img-fluid mb-2 rounded" alt="Event 2"></div>
                    <div class="col-md-4"><img src="https://utahwoodturning.com/wp-content/uploads/2023/07/53-2048x1365.jpg" class="img-fluid mb-2 rounded" alt="Event 3"></div>
                </div>
            </section>
            
            <section id="klien">
                <h2>Klien Kami</h2>
                <div class="row">
                    <div class="col-md-4"><img src="https://pixelz.cc/wp-content/uploads/2018/07/google-logo-redesign-uhd-4k-wallpaper.jpg" class="img-fluid mb-2 rounded" alt="Klien 1"></div>
                    <div class="col-md-4"><img src="https://i.ytimg.com/vi/1id7wsJCcEM/maxresdefault.jpg" class="img-fluid mb-2 rounded" alt="Klien 2"></div>
                    <div class="col-md-4"><img src="https://cakapinterview.com/wp-content/uploads/2022/02/Bank-BCA-03-scaled.jpg" class="img-fluid mb-2 rounded" alt="Klien 3"></div>
                </div>
            </section>
            
            <section id="kontak">
                <h2>Kontak Kami</h2>
                <div class="alert alert-info">
                    <strong>Alamat:</strong> Jl. Jendral Sudirman No. Kav 10, Jakarta Pusat<br>
                    <strong>Email:</strong> info@teknologidigital.com<br>
                    <strong>Telp:</strong> (021) 123-4567
                </div>
            </section>

             <footer>
                <p>Design by <a href="https://www.linkedin.com/in/habibisiregar79/">M Habibi Siregar</a></p>
            </footer>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>