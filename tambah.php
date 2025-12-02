<?php
$tabel = $_GET['tabel'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data <?= ucfirst($tabel) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">Tambah Data <?= ucfirst($tabel) ?></div>
        <div class="card-body">
            <form action="proses.php?aksi=tambah&tabel=<?= $tabel ?>" method="post" enctype="multipart/form-data">
                
                <?php if($tabel == 'profile'): ?>
                    <div class="mb-3"><label>Visi</label><textarea name="visi" class="form-control" required></textarea></div>
                    <div class="mb-3"><label>Misi</label><textarea name="misi" class="form-control" required></textarea></div>
                    <div class="mb-3"><label>Tentang Kami</label><textarea name="tentang_kami" class="form-control" required></textarea></div>
                    <div class="mb-3"><label>Kontak Kami</label><input type="text" name="kontak_kami" class="form-control" required></div>
                    <div class="mb-3"><label>Foto Profile</label><input type="file" name="foto" class="form-control" required></div>
                
                <?php elseif($tabel == 'event'): ?>
                    <div class="mb-3"><label>Nama Event</label><input type="text" name="nama_event" class="form-control" required></div>
                    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" required></textarea></div>
                    <div class="mb-3"><label>Gambar Event</label><input type="file" name="foto" class="form-control" required></div>

                <?php elseif($tabel == 'client'): ?>
                    <div class="mb-3"><label>Nama Client</label><input type="text" name="nama_client" class="form-control" required></div>
                    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" required></textarea></div>
                    <div class="mb-3"><label>Logo Client</label><input type="file" name="foto" class="form-control" required></div>
                <?php elseif($tabel == 'artikel'): ?>
                    <div class="mb-3">
                        <label>Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Isi Artikel</label>
                        <textarea name="isi" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>File Lampiran (PDF/DOC)</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>