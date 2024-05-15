<?php
// Підключення до бази даних
$servername = "localhost"; // або IP-адреса вашого сервера MySQL
$username = "root"; // ваше ім'я користувача MySQL
$password = ""; // ваш пароль MySQL, залиште порожнім, якщо ви не встановили пароль
$dbname = "company_db"; // назва вашої бази даних

// Отримання id працівника з URL
$id = $_GET['id'];

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// SQL-запит для вибору конкретного працівника за його id
$sql = "SELECT * FROM employees WHERE id=$id";
$result = $conn->query($sql);

// Отримання даних про працівника
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $position = $row['position'];
    $salary = $row['salary'];
} else {
    echo "Працівник не знайдений";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування працівника</title>
</head>
<body>

<h2>Редагування працівника</h2>

<form action="update_employee.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="name">Ім'я:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
    <label for="position">Посада:</label><br>
    <input type="text" id="position" name="position" value="<?php echo $position; ?>"><br>
    <label for="salary">Заробітна плата:</label><br>
    <input type="text" id="salary" name="salary" value="<?php echo $salary; ?>"><br><br>
    <input type="submit" value="Зберегти зміни">
</form>
 <br><a href='employees.php'>Повернутися на головну сторінку</a>

</body>
</html>
