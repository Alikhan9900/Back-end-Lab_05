<?php
// Підключення до бази даних
$servername = "localhost"; // або IP-адреса вашого сервера MySQL
$username = "root"; // ваше ім'я користувача MySQL
$password = ""; // ваш пароль MySQL, залиште порожнім, якщо ви не встановили пароль
$dbname = "company_db"; // назва вашої бази даних

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// SQL-запит для вибору всіх записів з таблиці "employees"
$sql = "SELECT id, name, position, salary FROM employees";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employees</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Список працівників</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Ім'я</th>
        <th>Посада</th>
        <th>Заробітна плата</th>
        <th>Дії</th>
    </tr>
    <?php
    // Виведення даних кожного рядка у вигляді таблиці
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["name"]. "</td>";
            echo "<td>" . $row["position"]. "</td>";
            echo "<td>" . $row["salary"]. "</td>";
            echo "<td><a href='edit_employee.php?id=" . $row["id"] . "'>Редагувати</a> | <a href='delete_employee.php?id=" . $row["id"] . "' onclick=\"return confirm('Ви впевнені, що хочете видалити цього працівника?');\">Видалити</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>У таблиці немає записів</td></tr>";
    }
    $conn->close();
    ?>
</table>

<br><p><button type="button" onclick="location.href = 'stats.php'" >Статистика</button>
</p><br>

<form action="add_employee.php" method="post">
    <label for="name">Ім'я:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="position">Посада:</label><br>
    <input type="text" id="position" name="position"><br>
    <label for="salary">Заробітна плата:</label><br>
    <input type="text" id="salary" name="salary"><br><br>
    <input type="submit" value="Додати працівника">
</form>

</body>
</html>
