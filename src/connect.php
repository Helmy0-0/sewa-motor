<?php
$env = __DIR__ . '/../projekpbw.env';

if (file_exists($env)) {
    $env = parse_ini_file($env);
    $host = $env['DB_HOST'];
    $username = $env['DB_USER'];
    $password = $env['DB_PASSWORD'];
    $database = $env['DB_NAME'];
} else {
    $host = 'localhost';
    $username = 'root';
    $password = ''; 
    $database = 'projekpbw';
}

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

