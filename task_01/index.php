<?php
session_start();

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>
<p><a href="register.php">Register</a></p>
</body>
</html>
