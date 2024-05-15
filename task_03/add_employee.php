<?php
// Підключення до бази даних
$servername = "localhost"; // або IP-адреса вашого сервера MySQL
$username = "root"; // ваше ім'я користувача MySQL
$password = ""; // ваш пароль MySQL, залиште порожнім, якщо ви не встановили пароль
$dbname = "company_db"; // назва вашої бази даних

// Отримання даних з форми
$name = $_POST['name'];
$position = $_POST['position'];
$salary = $_POST['salary'];

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// SQL-запит для вставки нового працівника
$sql = "INSERT INTO employees (name, position, salary) VALUES ('$name', '$position', '$salary')";

if ($conn->query($sql) === TRUE) {
    header("Location: employees.php");
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

$conn->close();


