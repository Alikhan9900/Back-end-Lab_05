<?php
session_start();
include 'db/config.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $sql = "UPDATE users SET email = ?, first_name = ?, last_name = ?, birth_date = ?, gender = ?, phone = ?, address = ?, city = ?, country = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $email, $first_name, $last_name, $birth_date, $gender, $phone, $address, $city, $country, $user_id);

    if ($stmt->execute()) {
        echo "Data updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
<p><a href="logout.php">Logout</a> | <a href="delete.php">Delete Account</a></p>

<form action="welcome.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    <br>
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>">
    <br>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>">
    <br>
    <label for="birth_date">Birth Date:</label>
    <input type="date" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($user['birth_date']); ?>">
    <br>
    <label for="gender">Gender:</label>
    <select id="gender" name="gender">
        <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        <option value="Other" <?php echo ($user['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
    </select>
    <br>
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
    <br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
    <br>
    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>">
    <br>
    <label for="country">Country:</label>
    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($user['country']); ?>">
    <br>
    <button type="submit">Update</button>
</form>
</body>
</html>

