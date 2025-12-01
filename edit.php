<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id = '$id'");
$data = mysqli_fetch_array($query);

// LOGIKA UPDATE
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $fileLama = $_POST['file_lama'];
    
    // Cek apakah user upload file baru?
    // error === 4 artinya tidak ada file yang diupload
    if ($_FILES['file']['error'] === 4) {
        $namaFileBaru = $fileLama; // Pakai file lama
    } else {
        // Jika ada file baru, proses upload seperti biasa
        $namaFile = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        
        $ekstensiValid = ['pdf', 'doc', 'docx'];
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));

        if (!in_array($ekstensiFile, $ekstensiValid)) {
            echo "<script>alert('Format file tidak valid!');</script>";
            return false;
        }

        $namaFileBaru = uniqid() . '.' . $ekstensiFile;
        move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

        // Hapus file lama dari folder agar tidak menumpuk
        if (file_exists("uploads/" . $fileLama)) {
            unlink("uploads/" . $fileLama);
        }
    }

    // Update Database
    $queryUpdate = "UPDATE artikel SET 
                    judul = '$judul',
                    isi = '$deskripsi',
                    file_name = '$namaFileBaru'
                    WHERE id = '$id'";

    if (mysqli_query($koneksi, $queryUpdate)) {
        echo "<script>
                alert('Data berhasil diupdate!');
                document.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal update data!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card col-md-8 mx-auto">
            <div class="card-header bg-warning">
                <strong>Edit Informasi</strong>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="file_lama" value="<?= $data['file_name']; ?>">
                    
                    <div class="mb-3">
                        <label>Judul Informasi</label>
                        <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required><?= $data['isi']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>File Upload (Biarkan kosong jika tidak ingin mengganti file)</label>
                        <br>
                        <small class="text-muted">File saat ini: <a href="uploads/<?= $data['file_name']; ?>" target="_blank"><?= $data['file_name']; ?></a></small>
                        <input type="file" name="file" class="form-control mt-2">
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>