<?php
include 'connect.php';

$id_motor = $_GET['id'] ?? 0;

if ($id_motor === 0) {
    die("Parameter ID tidak valid.");
}

$stmt = $conn->prepare("SELECT * FROM motor WHERE id_motor = ?");
$stmt->bind_param("i", $id_motor);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data motor tidak ditemukan.");
}

$motor = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h3>Edit Data Motor</h3>

        <form action="proses_edit_motor.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_motor" value="<?php echo $motor['id_motor'] ?>">

            <div class="mb-3">
                <label for="nama_motor" class="form-label">Nama Motor</label>
                <input type="text" id="nama_motor" name="nama_motor" class="form-control" required
                    value="<?php echo htmlspecialchars($motor['nama_motor']) ?>">
            </div>

            <div class="mb-3">
                <label for="merek" class="form-label">Merek</label>
                <input type="text" id="merek" name="merek" class="form-control" required
                    value="<?php echo htmlspecialchars($motor['merek']) ?>">
            </div>

            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <input type="text" id="tipe" name="tipe" class="form-control" required
                    value="<?php echo htmlspecialchars($motor['tipe']) ?>">
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" required
                    value="<?php echo htmlspecialchars($motor['harga']) ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="Tersedia" <?= $motor['status'] === 'Tersedia' ? 'selected' : '' ?>>
                        Tersedia
                    </option>
                    <option value="Tidak Tersedia" <?= $motor['status'] === 'Tidak Tersedia' ? 'selected' : '' ?>>
                        Tidak Tersedia
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label><br>
                <?php if (!empty($motor['gambar'])): ?>
                    <img src="/public/<?php echo htmlspecialchars($motor['gambar']) ?>" alt="Gambar Motor" width="120">
                <?php else: ?>
                    <span class="text-muted">Tidak ada gambar</span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Ganti Gambar (opsional)</label>
                <input type="file" id="file" name="file" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="daftar_motor.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>