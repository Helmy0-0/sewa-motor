<?php
include 'connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID tidak valid.');
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("DELETE FROM pelanggan WHERE id_pelanggan = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Data pelanggan berhasil dihapus'); window.location='daftar_pelanggan.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data: " . $stmt->error . "'); window.location='daftar_pelanggan.php';</script>";
}

$conn->close();
