<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_motor = $_POST['nama_motor'] ?? '';
    $merek = $_POST['merek'] ?? '';
    $tipe = $_POST['tipe'] ?? '';
    $harga = $_POST['harga'] ?? '';
    $gambarUrl = '';

    // Validasi dasar
    if (!$nama_motor || !$merek || !$tipe || !$harga || !isset($_FILES['file'])) {
        die('Input tidak lengkap atau file tidak ada');
    }

    $uploadDir = __DIR__ . '/public/uploads/';   // benar: /var/www/html/public/uploads/

    $relativePath = 'uploads/';                  // nanti dipakai di <img src="/uploads/…">



    // Nama file unik
    $filename = uniqid() . '-' . basename($_FILES['file']['name']);
    $targetFile = "{$uploadDir}{$filename}";

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        $gambarUrl = "{$relativePath}{$filename}";
    } else {
        die('Gagal menyimpan file gambar.');
    }

    // Simpan ke database
    $stmt = $conn->prepare('INSERT INTO motor (nama_motor, merek, tipe, harga, gambar) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssds', $nama_motor, $merek, $tipe, $harga, $gambarUrl);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='tambah_motor.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: {$stmt->error}'); window.location='tambah_motor.php';</script>";
    }
}
$conn->close();