<?php
include 'connect.php';

$id_pelanggan = isset($_POST['id_pelanggan']) ? intval($_POST['id_pelanggan']) : 0;
$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$telepon = $_POST['telepon'] ?? '';

if (!$id_pelanggan || !$nama || !$alamat || !$telepon) {
    die('Data tidak lengkap.');
}

$stmt = $conn->prepare("UPDATE pelanggan SET nama = ?, alamat = ?, telepon = ? WHERE id_pelanggan = ?");
$stmt->bind_param("sssi", $nama, $alamat, $telepon, $id_pelanggan);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='daftar_pelanggan.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data: " . $stmt->error . "'); history.back();</script>";
}

$conn->close();
