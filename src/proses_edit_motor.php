<?php
include 'connect.php';
$env = parse_ini_file(__DIR__ . '/.env');


$id_motor = isset($_POST['id_motor']) ? intval($_POST['id_motor']) : 0;

//ambil data lama
$stmt = $conn->prepare("SELECT * FROM motor WHERE id_motor = ?");
$stmt->bind_param("i", $id_motor);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah data ditemukan
if ($result->num_rows === 0) {
    die('Data motor tidak ditemukan');
}
// masukan data lama ke var old
$old = $result->fetch_assoc();

//validasi input 
$nama_motor = $_POST['nama_motor'] ?? '';
$merek = $_POST['merek'] ?? '';
$tipe = $_POST['tipe'] ?? '';
$harga = ($_POST['harga'] === '' || !isset($_POST['harga']))
    ? $old['harga']
    : floatval($_POST['harga']);
$gambarUrl = $old['gambar'];

// Upload file hanya jika user pilih baru
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

    $apiBase = $env['API_URL'] ?? '';
    $apiKey = $env['API_KEY'] ?? '';
    if (!$apiBase || !$apiKey) {
        die('API_URL / API_KEY belum di‑set');
    }

    $uploadUrl = rtrim($apiBase, '/') . '/files/upload';

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
        CURLOPT_HTTPHEADER => ["x-api-key: $apiKey"],
        CURLOPT_RETURNTRANSFER => true,
    ]);

    $response = curl_exec($ch);
    if ($response === false) {
        die('Gagal mengunggah gambar: ' . curl_error($ch));
    }
    curl_close($ch);

    $json = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE || empty($json['path'])) {
        die('Upload gambar gagal: ' . $response);
    }
    //ambil response path
    $gambarUrl = rtrim($apiBase, '/') . '/' . ltrim($json['path'], '/');
}

//upload ke db
$update = $conn->prepare(
    "UPDATE motor
       SET nama_motor = ?, merek = ?, tipe = ?, harga = ?, gambar = ?
     WHERE id_motor = ?"
);
$update->bind_param(
    "sssdsi",
    $nama_motor,
    $merek,
    $tipe,
    $harga,
    $gambarUrl,
    $id_motor
);

if ($update->execute()) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='daftar_motor.php?success=1';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data: " . $update->error . "'); history.back();</script>";
}
$conn->close();
?>