<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM violins WHERE id = ?");
$stmt->execute([$id]);
$violinToEdit = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE violins SET model = ?, year = ?, price = ?, description = ? WHERE id = ?");
    $stmt->execute([$model, $year, $price, $description, $id]);
    
    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
   <!-- Dodaj metadane -->
   <!-- Dodaj tytuł i style -->
   <!-- Dodaj style CSS -->
   
   
   
   

<head>


<body>

<header><h1>Edytuj Skrzypka</h1></header>

<main>

<form method='post'>
      Model:<input type='text' name='model' value="<?php echo htmlspecialchars($violinToEdit['model']); ?>" required/><br/>
      Rok:<input type='number' name='year' value="<?php echo htmlspecialchars($violinToEdit['year']); ?>" required/><br/>
      Cena:<input type='text' name='price' value="<?php echo htmlspecialchars($violinToEdit['price']); ?>" required/><br/>
      Opis:<textarea name='description' required><?php echo htmlspecialchars($violinToEdit['description']); ?></textarea><br/>
      
      <input type='submit' value='Zapisz zmiany'/>
  </form>

<a href='admin.php'>Powrót do panelu administracyjnego</a>

</main>


<footer>&copy; 2024 Wynajem Skrzypków</footer>

<body>

