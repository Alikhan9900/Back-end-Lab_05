<?php
session_start();
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or Email already exists!";
    } else {
        $sql = "INSERT INTO users (username, password, email, first_name, last_name, birth_date, gender, phone, address, city, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssss", $username, $password, $email, $first_name, $last_name, $birth_date, $gender, $phone, $address, $city, $country);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form action="register.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name">
    <br>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name">
    <br>
    <label for="birth_date">Birth Date:</label>
    <input type="date" id="birth_date" name="birth_date">
    <br>
    <label for="gender">Gender:</label>
    <select id="gender" name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <br>
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone">
    <br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address">
    <br>
    <label for="city">City:</label>
    <input type="text" id="city" name="city">
    <br>
    <label for="country">Country:</label>
    <input type="text" id="country" name="country">
    <br>
    <button type="submit">Register</button>
</form>
</body>
</html>

