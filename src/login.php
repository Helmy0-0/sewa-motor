<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE ht`ml>
<html> 
<head>
    <title>Login</title></head>
<body>
    <h2>Login</h2>
    <form action="proses_login.php" method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>