<?php
include 'koneksi.php';

$aksi = $_GET['aksi'];
$tabel = $_GET['tabel'];

// Fungsi Upload Gambar (Untuk Profile, Event, Client)
function uploadImage($file) {
    $namaFile = $file['name'];
    $tmpName = $file['tmp_name'];
    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>alert('Format file harus gambar (JPG/PNG)!'); window.location='dashboard.php';</script>";
        return false;
    }
    $namaBaru = uniqid() . '.' . $ekstensi;
    move_uploaded_file($tmpName, 'uploads/' . $namaBaru);
    return $namaBaru;
}

// Fungsi Upload Dokumen (Khusus Artikel)
function uploadDokumen($file) {
    $namaFile = $file['name'];
    $tmpName = $file['tmp_name'];
    $ekstensiValid = ['pdf', 'doc', 'docx'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>alert('Format file harus PDF atau DOC!'); window.location='dashboard.php';</script>";
        return false;
    }
    $namaBaru = uniqid() . '.' . $ekstensi;
    move_uploaded_file($tmpName, 'uploads/' . $namaBaru);
    return $namaBaru;
}

// --- LOGIKA TAMBAH DATA ---
if ($aksi == 'tambah') {
    
    // Logika Khusus Artikel (Upload Dokumen)
    if ($tabel == 'artikel') {
        $file = uploadDokumen($_FILES['file']);
        if (!$file) exit;
        
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $tanggal = date('Y-m-d'); // Tanggal otomatis hari ini
        
        $query = "INSERT INTO artikel VALUES (NULL, '$judul', '$isi', '$tanggal', '$file')";
    
    // Logika Profile, Event, Client (Upload Gambar)
    } else {
        $gambar = uploadImage($_FILES['foto']);
        if (!$gambar) exit;

        if ($tabel == 'profile') {
            $visi = $_POST['visi'];
            $misi = $_POST['misi'];
            $tentang = $_POST['tentang_kami'];
            $kontak = $_POST['kontak_kami'];
            $query = "INSERT INTO profile VALUES (NULL, '$gambar', '$visi', '$misi', '$tentang', '$kontak')";
        } elseif ($tabel == 'event') {
            $nama = $_POST['nama_event'];
            $desk = $_POST['deskripsi'];
            $query = "INSERT INTO event VALUES (NULL, '$nama', '$desk', '$gambar')";
        } elseif ($tabel == 'client') {
            $nama = $_POST['nama_client'];
            $desk = $_POST['deskripsi'];
            $query = "INSERT INTO client VALUES (NULL, '$nama', '$desk', '$gambar')";
        }
    }

    mysqli_query($koneksi, $query);
    header("Location: dashboard.php");

// --- LOGIKA EDIT DATA ---
} elseif ($aksi == 'edit') {
    $id = $_POST['id'];

    if ($tabel == 'artikel') {
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $file = $_POST['file_lama'];

        // Cek jika upload dokumen baru
        if ($_FILES['file']['error'] === 0) {
            $file = uploadDokumen($_FILES['file']);
        }
        $query = "UPDATE artikel SET judul='$judul', isi='$isi', file_name='$file' WHERE id='$id'";

    } else {
        // Edit untuk Profile, Event, Client
        $gambar = $_POST['foto_lama'];
        if ($_FILES['foto']['error'] === 0) {
            $gambar = uploadImage($_FILES['foto']);
        }

        if ($tabel == 'profile') {
            $visi = $_POST['visi'];
            $misi = $_POST['misi'];
            $tentang = $_POST['tentang_kami'];
            $kontak = $_POST['kontak_kami'];
            $query = "UPDATE profile SET foto_profile='$gambar', visi='$visi', misi='$misi', tentang_kami='$tentang', kontak_kami='$kontak' WHERE id='$id'";
        } elseif ($tabel == 'event') {
            $nama = $_POST['nama_event'];
            $desk = $_POST['deskripsi'];
            $query = "UPDATE event SET nama_event='$nama', deskripsi='$desk', image='$gambar' WHERE id='$id'";
        } elseif ($tabel == 'client') {
            $nama = $_POST['nama_client'];
            $desk = $_POST['deskripsi'];
            $query = "UPDATE client SET nama_client='$nama', deskripsi='$desk', image_client='$gambar' WHERE id='$id'";
        }
    }

    mysqli_query($koneksi, $query);
    header("Location: dashboard.php");

// --- LOGIKA HAPUS DATA ---
} elseif ($aksi == 'hapus') {
    $id = $_GET['id'];
    
    // Tentukan nama kolom file berdasarkan tabel
    if ($tabel == 'artikel') {
        $fieldFile = 'file_name';
    } elseif ($tabel == 'profile') {
        $fieldFile = 'foto_profile';
    } elseif ($tabel == 'event') {
        $fieldFile = 'image';
    } else {
        $fieldFile = 'image_client';
    }
    
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT $fieldFile FROM $tabel WHERE id='$id'"));
    
    if(file_exists('uploads/' . $data[$fieldFile])){
        unlink('uploads/' . $data[$fieldFile]);
    }

    mysqli_query($koneksi, "DELETE FROM $tabel WHERE id='$id'");
    header("Location: dashboard.php");
}
?>