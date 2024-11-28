<?php
$host = 'localhost';
$db = 'rental_service';
$user = 'root'; // Użytkownik bazy danych
$pass = ''; // Hasło do bazy danych

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>