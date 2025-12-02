<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Sign Out</a>
    </nav>
    
    <div class="container mt-4">
        <h3>Selamat Datang, <?= $_SESSION['user']; ?></h3>
        <hr>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button">Data Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button">Data Event</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="client-tab" data-bs-toggle="tab" data-bs-target="#client" type="button">Data Client</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="artikel-tab" data-bs-toggle="tab" data-bs-target="#artikel" type="button">Data Artikel</button>
            </li>
        </ul>

        <div class="tab-content p-3 border border-top-0" id="myTabContent">
            
            <div class="tab-pane fade show active" id="profile">
                <a href="tambah.php?tabel=profile" class="btn btn-primary mb-3">Tambah Profile</a>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Foto</th>
                            <th>Visi & Misi</th>
                            <th>Tentang & Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM profile");
                        while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><img src="uploads/<?= $row['foto_profile'] ?>" width="100"></td>
                            <td>
                                <b>Visi:</b> <?= substr($row['visi'], 0, 50) ?>...<br>
                                <b>Misi:</b> <?= substr($row['misi'], 0, 50) ?>...
                            </td>
                            <td>
                                <b>Tentang:</b> <?= substr($row['tentang_kami'], 0, 50) ?>...<br>
                                <b>Kontak:</b> <?= $row['kontak_kami'] ?>
                            </td>
                            <td>
                                <a href="edit.php?tabel=profile&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses.php?aksi=hapus&tabel=profile&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="event">
                <a href="tambah.php?tabel=event" class="btn btn-primary mb-3">Tambah Event</a>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Nama Event</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM event");
                        while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><img src="uploads/<?= $row['image'] ?>" width="100"></td>
                            <td><?= $row['nama_event'] ?></td>
                            <td><?= substr($row['deskripsi'], 0, 100) ?>...</td>
                            <td>
                                <a href="edit.php?tabel=event&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses.php?aksi=hapus&tabel=event&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="client">
                <a href="tambah.php?tabel=client" class="btn btn-primary mb-3">Tambah Client</a>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Logo Client</th>
                            <th>Nama Client</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM client");
                        while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><img src="uploads/<?= $row['image_client'] ?>" width="100"></td>
                            <td><?= $row['nama_client'] ?></td>
                            <td><?= substr($row['deskripsi'], 0, 100) ?>...</td>
                            <td>
                                <a href="edit.php?tabel=client&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses.php?aksi=hapus&tabel=client&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="artikel">
                <a href="tambah.php?tabel=artikel" class="btn btn-primary mb-3">Tambah Artikel</a>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Judul & Isi</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY tanggal DESC");
                        while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                            <td>
                                <b><?= $row['judul'] ?></b><br>
                                <small class="text-muted"><?= substr($row['isi'], 0, 100) ?>...</small>
                            </td>
                            <td>
                                <a href="uploads/<?= $row['file_name'] ?>" target="_blank" class="btn btn-sm btn-info text-white">Download</a>
                            </td>
                            <td>
                                <a href="edit.php?tabel=artikel&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses.php?aksi=hapus&tabel=artikel&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>