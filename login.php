<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   // Prosty mechanizm logowania dla przykładu
   if ($_POST['username'] === 'admin' && password_verify($_POST['password'], password_hash('password', PASSWORD_DEFAULT))) {
       $_SESSION['admin_logged_in'] = true;
       header('Location: admin.php');
       exit;
   } else {
       echo "Nieprawidłowe dane logowania.";
   }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>

<header><h1>Logowanie do Panelu Administracyjnego</h1></header>

<main>

<form method='post'>
      Nazwa użytkownika:<input type='text' name='username' required/><br/>
      Hasło:<input type='password' name='password' required/><br/>
      <input type='submit' value='Zaloguj'/>
  </form>

  </main>


<footer>&copy; 2024 Wynajem Skrzypków</footer>

<body>

