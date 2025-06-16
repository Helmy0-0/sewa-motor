<?php
include 'proses_get_motor.php';
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Motor</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        img.motor-thumbnail {
            width: 80px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4">Daftar Motor</h3>

            <!-- Tombol Tambah -->
            <div class="d-flex justify-content-end mb-3">
                <a href="tambah_motor.php" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Motor
                </a>
            </div>

            <!-- Form Pencarian -->
            <form method="get" class="row g-3 mb-3">
                <div class="col-md-5">
                    <label for="nama_motor" class="form-label">Cari Nama Motor</label>
                    <input type="text" class="form-control" id="nama_motor" name="nama_motor"
                           placeholder="Masukkan nama motor" value="<?php echo htmlspecialchars($search_nama_motor ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label for="merek" class="form-label">Cari Merek</label>
                    <input type="text" class="form-control" id="merek" name="merek"
                           placeholder="Masukkan merek" value="<?php echo htmlspecialchars($search_merek ?? '') ?>">
                </div>
                <div class="col-md-2 align-self-end d-grid">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
                </div>
                <div class="col-md-2 align-self-end d-grid">
                    <a href="daftar_motor.php" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
                </div>
            </form>

            <!-- Tabel Daftar Motor -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Motor</th>
                            <th>Merek</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_motor'] ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_motor']) ?></td>
                                    <td><?php echo htmlspecialchars($row['merek']) ?></td>
                                    <td><?php echo htmlspecialchars($row['tipe']) ?></td>
                                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if (!empty($row['gambar'])): ?>
                                            <img src="<?php echo htmlspecialchars($row['gambar']) ?>" alt="Gambar Motor" class="motor-thumbnail">
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_motor.php?id=<?php echo $row['id_motor'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="proses_hapus_motor.php?id=<?php echo $row['id_motor'] ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada data motor ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</body>
</html>
