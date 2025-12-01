<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Ambil nama file lama sebelum menghapus record database
    $queryAmbil = mysqli_query($koneksi, "SELECT file_name FROM artikel WHERE id = '$id'");
    $data = mysqli_fetch_array($queryAmbil);
    $fileLama = $data['file_name'];

    // 2. Hapus file fisik di folder uploads
    if (file_exists("uploads/" . $fileLama)) {
        unlink("uploads/" . $fileLama);
    }

    // 3. Hapus data dari database
    $queryHapus = mysqli_query($koneksi, "DELETE FROM artikel WHERE id = '$id'");

    if ($queryHapus) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'dashboard.php';
              </script>";
    }
} else {
    header("Location: dashboard.php");
}
?>