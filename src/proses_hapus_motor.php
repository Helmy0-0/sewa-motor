<?php


include 'connect.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];


    $id_motor = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM motor WHERE id_motor = ?");
    $stmt->bind_param("i", $id_motor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Data motor tidak ditemukan.");
    }

    $motor = $result->fetch_assoc();

    $deleteStmt = $conn->prepare("DELETE FROM motor WHERE id_motor = ?");
    $deleteStmt->bind_param("i", $id_motor);

    if ($deleteStmt->execute()) {
        echo "<script>alert('Data motor berhasil dihapus'); window.location='daftar_motor.php';</script>";
 
    } else {
        echo "<script>alert('Gagal menghapus data motor: " . $deleteStmt->error . "'); window.location='daftar_motor.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location='daftar_motor.php';</script>";
}
   $conn->close();
?>