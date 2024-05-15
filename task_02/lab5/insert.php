<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab05;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Перевірка, чи були надіслані дані формою
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $stock = $_POST['stock'];

        // Вставка нового запису у таблицю tov
        $sql = "INSERT INTO tov (name, description, price, category, stock) VALUES (:name, :description, :price, :category, :stock)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':stock', $stock);

        if ($stmt->execute()) {
            echo "New record added successfully!". "<p><a href='index.php'>Повернутися</a></p>";
        } else {
            echo "Error: Unable to add record.". "<p><a href='index.php'>Повернутися</a></p>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
