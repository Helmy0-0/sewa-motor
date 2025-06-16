<?php
session_start();
include "connect.php";

// Cek apakah form login diisi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Siapkan query aman
    $stmt = $conn->prepare("SELECT * FROM pengguna WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // 2 string
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek hasil login
    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location='login.php';</script>";
    }
} else {
    header("Location: login.php");
    exit();
}
?>