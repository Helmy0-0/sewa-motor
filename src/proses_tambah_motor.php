<?php
include 'connect.php';
$env = parse_ini_file(__DIR__ . '/.env');

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

    //parse env
    $apiBase = $env['API_URL'];
    $apiKey = $env['API_KEY'];
    if (!$apiBase || !$apiKey) {
        die('API_URL / API_KEY belum di‑set di environment PHP');
    }

    //base URL untuk upload
    $uploadUrl = $apiBase . '/files/upload';

    //payload untuk upload
    $cfile = new CURLFile(
        $_FILES['file']['tmp_name'],
        mime_content_type($_FILES['file']['tmp_name']),
        $_FILES['file']['name']
    );


    $ch = curl_init($uploadUrl);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => ['file' => $cfile],
        CURLOPT_RETURNTRANSFER => true,
    ]);


    $response = curl_exec($ch);

    if ($response === false) {
        die('Gagal mengunggah gambar: ' . curl_error($ch));

    }

    curl_close($ch);

    $json = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE || empty($json['path'])) {
        die('Gagal mengunggah gambar: ' . $response);
    }

    //ambil response path
    $gambarUrl = $apiBase . "/" . $json['path'];

    // Simpan ke database
    $stmt = $conn->prepare('INSERT INTO motor (nama_motor, merek, tipe, harga, gambar) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssds', $nama_motor, $merek, $tipe, $harga, $gambarUrl);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='tambah_motor.php';</script>";

    } else {
        echo "<script>alert('Gagal menambahkan data: " . $stmt->error . "'); window.location='tambah_motor.php';</script>";

    }
}
$conn->close();
?>