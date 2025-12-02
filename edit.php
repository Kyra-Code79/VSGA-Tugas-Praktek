<?php
include 'koneksi.php';
$tabel = $_GET['tabel'];
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data <?= ucfirst($tabel) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning">Edit Data <?= ucfirst($tabel) ?></div>
        <div class="card-body">
            <form action="proses.php?aksi=edit&tabel=<?= $tabel ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                
                <?php if($tabel == 'profile'): ?>
                    <div class="mb-3"><label>Visi</label><textarea name="visi" class="form-control"><?= $data['visi'] ?></textarea></div>
                    <div class="mb-3"><label>Misi</label><textarea name="misi" class="form-control"><?= $data['misi'] ?></textarea></div>
                    <div class="mb-3"><label>Tentang Kami</label><textarea name="tentang_kami" class="form-control"><?= $data['tentang_kami'] ?></textarea></div>
                    <div class="mb-3"><label>Kontak Kami</label><input type="text" name="kontak_kami" class="form-control" value="<?= $data['kontak_kami'] ?>"></div>
                    <div class="mb-3">
                        <label>Foto Profile (Biarkan kosong jika tidak diganti)</label>
                        <input type="file" name="foto" class="form-control">
                        <input type="hidden" name="foto_lama" value="<?= $data['foto_profile'] ?>">
                    </div>
                
                <?php elseif($tabel == 'event'): ?>
                    <div class="mb-3"><label>Nama Event</label><input type="text" name="nama_event" class="form-control" value="<?= $data['nama_event'] ?>"></div>
                    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea></div>
                    <div class="mb-3">
                        <label>Gambar Event (Biarkan kosong jika tidak diganti)</label>
                        <input type="file" name="foto" class="form-control">
                        <input type="hidden" name="foto_lama" value="<?= $data['image'] ?>">
                    </div>

                <?php elseif($tabel == 'client'): ?>
                    <div class="mb-3"><label>Nama Client</label><input type="text" name="nama_client" class="form-control" value="<?= $data['nama_client'] ?>"></div>
                    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea></div>
                    <div class="mb-3">
                        <label>Logo Client (Biarkan kosong jika tidak diganti)</label>
                        <input type="file" name="foto" class="form-control">
                        <input type="hidden" name="foto_lama" value="<?= $data['image_client'] ?>">
                    </div>
                <?php elseif($tabel == 'artikel'): ?>
                    <div class="mb-3">
                        <label>Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>">
                    </div>
                    <div class="mb-3">
                        <label>Isi Artikel</label>
                        <textarea name="isi" class="form-control" rows="5"><?= $data['isi'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>File Lampiran (Biarkan kosong jika tidak diganti)</label>
                        <input type="file" name="file" class="form-control">
                        <input type="hidden" name="file_lama" value="<?= $data['file_name'] ?>">
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>