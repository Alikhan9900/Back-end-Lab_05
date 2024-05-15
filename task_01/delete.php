<?php
session_start();
include 'db/config.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    session_unset();
    session_destroy();
    echo "Account deleted successfully!";
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}
?>

