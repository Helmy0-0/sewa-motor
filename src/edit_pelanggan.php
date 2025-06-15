<?php
include 'connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID tidak valid.');
}

$id_pelanggan = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM pelanggan WHERE id_pelanggan = ?");
$stmt->bind_param("i", $id_pelanggan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data pelanggan tidak ditemukan.");
}

$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4">Edit Pelanggan</h3>
            <form method="post" action="proses_edit_pelanggan.php">
                <input type="hidden" name="id_pelanggan" value="<?= $data['id_pelanggan'] ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($data['nama']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" name="telepon" id="telepon" value="<?= htmlspecialchars($data['telepon']) ?>" class="form-control" required>
                </div>

                <button class="btn btn-dark w-100">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
