<?php
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4">Tambah Pelanggan</h3>
            <form method="post" action="proses_tambah_pelanggan.php">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" required>
                </div>
                <button class="btn btn-dark w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
