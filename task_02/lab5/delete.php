<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab05;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Перевірка, чи був надісланий номер запису для вилучення
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        // Вилучення запису з таблиці tov
        $sql = "DELETE FROM tov WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Record deleted successfully!". "<p><a href='index.php'>Повернутися</a></p>";
        } else {
            echo "Error: Unable to delete record.". "<p><a href='index.php'>Повернутися</a></p>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
