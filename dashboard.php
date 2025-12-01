<?php
session_start();
include 'koneksi.php'; 

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";
if (isset($_POST['upload'])) {
    $judul = $_POST['judul'];
    // Ambil data deskripsi dari form
    $deskripsi = $_POST['deskripsi']; 
    $tanggal = date('Y-m-d');
    
    $namaFile = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];
    
    $ekstensiValid = ['pdf', 'doc', 'docx'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        $pesan = "<div class='alert alert-danger'>Format file harus PDF atau DOC!</div>";
    } else {
        $namaFileBaru = uniqid() . '.' . $ekstensiFile;

        if (move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru)) {
            // Update Query: Masukkan variabel $deskripsi ke kolom 'isi'
            $query = "INSERT INTO artikel (judul, isi, tanggal, file_name) VALUES ('$judul', '$deskripsi', '$tanggal', '$namaFileBaru')";
            
            if (mysqli_query($koneksi, $query)) {
                $pesan = "<div class='alert alert-success'>Berhasil mengupload informasi!</div>";
            } else {
                $pesan = "<div class='alert alert-danger'>Gagal menyimpan ke database!</div>";
            }
        } else {
            $pesan = "<div class='alert alert-danger'>Gagal mengupload file!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </nav>
    
    <div class="container mt-5">
        <h1>Selamat Datang, <?= $_SESSION['user']; ?></h1>
        <hr>
        
        <?= $pesan; ?>

        <div class="card mt-4">
            <div class="card-header">Upload File Informasi</div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Judul Informasi</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required placeholder="Tuliskan deskripsi file disini..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label>File Upload (PDF/Doc)</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button type="submit" name="upload" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>

        <div class="card mt-4 mb-5">
            <div class="card-header">Daftar Informasi Terupload</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Aksi</th> </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id DESC");
                        while($data = mysqli_fetch_array($tampil)):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['judul']; ?></td>
                            <td><?= substr($data['isi'], 0, 50) . '...'; ?></td>
                            <td>
                                <a href="uploads/<?= $data['file_name']; ?>" target="_blank" class="btn btn-sm btn-info text-white">Lihat File</a>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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