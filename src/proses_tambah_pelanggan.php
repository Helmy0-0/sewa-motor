<?php
include 'connect.php';

$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$telepon = $_POST['telepon'] ?? '';

if (!$nama || !$alamat || !$telepon) {
    die('Semua field wajib diisi!');
}

$stmt = $conn->prepare("INSERT INTO pelanggan (nama, alamat, telepon) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $alamat, $telepon);

if ($stmt->execute()) {
    echo "<script>alert('Pelanggan berhasil ditambahkan'); window.location='daftar_pelanggan.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan pelanggan'); history.back();</script>";
}

$conn->close();
