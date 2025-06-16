<?php
include 'connect.php';
include 'nav.php';

$search_nama = $_GET['nama'] ?? '';
$query = "SELECT * FROM pelanggan WHERE nama LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = "%" . $search_nama . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4">Daftar Pelanggan</h3>
            <form method="get" class="row g-3 mb-3">
                <div class="col-md-6">
                    <input type="text" name="nama" class="form-control" placeholder="Cari Nama" value="<?= htmlspecialchars($search_nama) ?>">
                </div>
                <div class="col-md-3 d-grid">
                    <button class="btn btn-primary">Cari</button>
                </div>
                <div class="col-md-3 d-grid">
                    <a href="tambah_pelanggan.php" class="btn btn-success">+ Tambah Pelanggan</a>
                </div>
            </form>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_pelanggan'] ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['telepon']) ?></td>
                            <td>
                                <a href="edit_pelanggan.php?id=<?= $row['id_pelanggan'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="proses_hapus_pelanggan.php?id=<?= $row['id_pelanggan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted">Data tidak ditemukan</td></tr>
                <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
