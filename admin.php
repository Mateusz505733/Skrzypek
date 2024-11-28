<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM violins");
$violins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Panel Administracyjny</h1>
        <nav>
            <a href="index.php">Strona Główna</a> | 
            <a href="create.php">Dodaj Skrzypka</a> | 
            <a href="logout.php">Wyloguj</a>
        </nav>
    </header>

    <main>
        <h2>Zarządzanie Skrzypkami</h2>
        <ul>
            <?php foreach ($violins as $violin): ?>
                <li>
                    <?php echo htmlspecialchars($violin['model']); ?> (<?php echo htmlspecialchars($violin['year']); ?>)
                    - 
                    <a href="edit.php?id=<?php echo $violin['id']; ?>">Edytuj</a> | 
                    <a href="delete.php?id=<?php echo $violin['id']; ?>">Usuń</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

    <footer>
        <p>&copy; 2024 Wynajem Skrzypków</p>
    </footer>
</body>
</html>