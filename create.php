<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO violins (model, year, price, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$model, $year, $price, $description]);
    
    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Skrzypka</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header><h1>Dodaj Skrzypka</h1></header>

<main>

<form method="post">
        Model: 
        <input type="text" name="model" required><br/>
        Rok: 
        <input type="number" name="year" required><br/>
        Cena: 
        <input type="text" name="price" required><br/>
        Opis: 
        <textarea name="description" required></textarea><br/>
        
        <input type="submit" value="Dodaj Skrzypka">
</form>

<a href="admin.php">Powrót do panelu administracyjnego</a>

</main>

<footer>&copy; 2024 Wynajem Skrzypków</footer>

</body>
</html>
