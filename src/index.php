<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - Sewa Motor Karawang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include 'nav.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Selamat Datang di Sewa Motor Karawang - Sistem Pencatatan Berbasis Web</h1>

        <div class="mt-4 text-center">
            <p>Sistem ini digunakan oleh admin untuk mencatat dan mengelola data penyewaan motor, pelanggan, serta transaksi yang berlangsung.</p>
            <p>Gunakan menu navigasi di atas untuk mengakses fitur seperti data motor, pelanggan, maupun pemesanan.</p>
        </div>
    </div>
</body>
</html>
