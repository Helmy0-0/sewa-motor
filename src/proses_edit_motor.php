<?php
include 'connect.php';

$id_motor = isset($_POST['id_motor']) ? intval($_POST['id_motor']) : 0;

// Ambil data lama
$stmt = $conn->prepare("SELECT * FROM motor WHERE id_motor = ?");
$stmt->bind_param("i", $id_motor);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Data motor tidak ditemukan');
}
$old = $result->fetch_assoc();

// Validasi input
$nama_motor = $_POST['nama_motor'] ?? '';
$merek = $_POST['merek'] ?? '';
$tipe = $_POST['tipe'] ?? '';
$status = $_POST['status'] ?? '';
$harga = ($_POST['harga'] === '' || !isset($_POST['harga']))
    ? $old['harga']
    : floatval($_POST['harga']);
$gambarUrl = $old['gambar'];

// Upload file hanya jika ada gambar baru
// Upload file hanya jika ada gambar baru
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // ➜ Path absolut ke folder uploads
    $uploadDir     = dirname(__DIR__) . '/public/uploads/';
    $relativePath  = 'uploads/';      // ➜ yang disimpan di kolom `gambar`

    // Pastikan folder ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Nama file unik
    $filename    = uniqid() . '-' . basename($_FILES['file']['name']);
    $targetFile  = $uploadDir . $filename;

    // Simpan file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        $gambarUrl = $relativePath . $filename;   // simpan ke DB
    } else {
        die('Gagal menyimpan file gambar.');
    }
}


// Update ke DB
$update = $conn->prepare(
    "UPDATE motor
     SET nama_motor = ?, merek = ?, tipe = ?, harga = ?, gambar = ?, status = ?
     WHERE id_motor = ?"
);
$update->bind_param(
    "sssdssi",
    $nama_motor,
    $merek,
    $tipe,
    $harga,
    $gambarUrl,
    $status,
    $id_motor
);

if ($update->execute()) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='daftar_motor.php?success=1';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data: " . $update->error . "'); history.back();</script>";
}

$conn->close();
?>
