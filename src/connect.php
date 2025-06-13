<?php
$conn = new mysqli('localhost', 'root', '', 'projekpbw');

if ($conn->connect_error){
    die("Connection failed: " . $con->connect_error);
}
?>