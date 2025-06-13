<?php
include 'connect.php';

$search_nama_motor = $_GET['nama_motor'] ?? '';
$search_merek = $_GET['merek'] ?? '';

$sql = "SELECT * FROM motor WHERE 1";

if (!empty($search_nama_motor)) {
    $sql .= " AND nama_motor LIKE '%" . $conn->real_escape_string($search_nama_motor) . "%'";
}

if (!empty($search_merek)) {
    $sql .= " AND merek LIKE '%" . $conn->real_escape_string($search_merek) . "%'";
}

$result = $conn->query($sql);
