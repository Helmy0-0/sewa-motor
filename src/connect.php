<?php
// Baca file .env sebagai array
$env = parse_ini_file(__DIR__ . '/.env');

// Ambil data dari env
$host = $env['DB_HOST'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];
$database = $env['DB_NAME'];

// // Buat docker
$conn = new mysqli($host, $username, $password, $database);

//buat local
#$conn = new mysqli("localhost", "root", "", "projekpbw");


// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


?>