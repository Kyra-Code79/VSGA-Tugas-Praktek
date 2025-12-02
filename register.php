<?php
session_start();
require 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];

    // Cek user
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        echo "<script>alert('User Sudah Terdaftar');</script>";
    }else{
        // Enkripsi password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // Insert user baru
        mysqli_query($koneksi, "INSERT INTO users (username, password, nama_lengkap) VALUES ('$username', '$passwordHash', '$nama_lengkap')");
        echo "<script>alert('Registrasi Berhasil! Silakan Login.');window.location='login.php';</script>";
        exit;
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Backend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 400px;">
        <h3 class="text-center">Register Backend</h3>
        <?php if(isset($error)) : ?>
            <p class="text-danger text-center">Username / Password salah</p>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Register</button>
        </form>
        <a href="index.php" class="d-block text-center mt-3">Kembali ke Home</a>
    </div>
</body>
</html>