<?php
// Підключення до бази даних
$servername = "localhost"; // або IP-адреса вашого сервера MySQL
$username = "root"; // ваше ім'я користувача MySQL
$password = ""; // ваш пароль MySQL, залиште порожнім, якщо ви не встановили пароль
$dbname = "company_db"; // назва вашої бази даних

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// SQL-запит для отримання середньої заробітної плати
$sql_avg_salary = "SELECT AVG(salary) AS avg_salary FROM employees";
$result_avg_salary = $conn->query($sql_avg_salary);

if ($result_avg_salary->num_rows > 0) {
    $row_avg_salary = $result_avg_salary->fetch_assoc();
    $avg_salary = $row_avg_salary['avg_salary'];
    echo "<h3>Статистика</h3>";
    echo "Середня заробітна плата всіх працівників: <strong>$" . number_format($avg_salary, 2) . "</strong><br>";
} else {
    echo "Середня заробітна плата не доступна<br>";
}

// SQL-запит для отримання кількості працівників на кожній посаді
$sql_position_count = "SELECT position, COUNT(*) AS count FROM employees GROUP BY position";
$result_position_count = $conn->query($sql_position_count);

if ($result_position_count->num_rows > 0) {
    echo "<h4>Кількість працівників на кожній посаді:</h4>";
    while($row_position_count = $result_position_count->fetch_assoc()) {
        echo "<strong>" . $row_position_count['position'] . "</strong>: " . $row_position_count['count'] . "<br>";
    }
} else {
    echo "Дані про кількість працівників на кожній посаді відсутні<br>";
}

// Посилання на головну сторінку
echo "<br><a href='employees.php'>Повернутися на головну сторінку</a>";

$conn->close();
?>
