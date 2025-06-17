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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<body>
    <h2>Login</h2>
    <form action="proses_login.php" method="POST">
        <div class="mb-3">
            <label>Username:</label> 
            <input type="text" name="username" class="form-control" required><br>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required><br>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>   
