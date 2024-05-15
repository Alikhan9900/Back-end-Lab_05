<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab05;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Отримання даних з таблиці tov
    $sql = "SELECT * FROM tov";
    $result = $pdo->query($sql);

    // Виведення даних у вигляді таблиці з кнопками "Додати запис" і "Вилучити запис"
    echo "<h2>Products</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Category</th><th>Stock</th><th>Action</th></tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
        echo "<td>";
        echo "<form action='delete.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Форма для додавання нового запису
    echo "<h2>Add Record</h2>";
    echo "<form action='insert.php' method='post'>";
    echo "Name: <input type='text' name='name'><br>";
    echo "Description: <input type='text' name='description'><br>";
    echo "Price: <input type='text' name='price'><br>";
    echo "Category: <input type='text' name='category'><br>";
    echo "Stock: <input type='text' name='stock'><br>";
    echo "<input type='submit' value='Add Record'>";
    echo "</form>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
