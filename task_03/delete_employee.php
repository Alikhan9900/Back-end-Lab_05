<?php
// Підключення до бази даних
$servername = "localhost"; // або IP-адреса вашого сервера MySQL
$username = "root"; // ваше ім'я користувача MySQL
$password = ""; // ваш пароль MySQL, залиште порожнім, якщо ви не встановили пароль
$dbname = "company_db"; // назва вашої бази даних

// Отримання id працівника з параметру запиту
$id = $_GET['id'];

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// SQL-запит для видалення працівника
$sql = "DELETE FROM employees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Після успішного видалення перенаправляємо користувача на головну сторінку
    header("Location: employees.php");
    exit();
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

$conn->close();


