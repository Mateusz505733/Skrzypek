<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM violins");
$violins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynajem Skrzypków</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Wynajem Skrzypków</h1>
        <nav>
            <a href="admin.php">Panel Administracyjny</a>
        </nav>
    </header>

    <main>
        <h2>Dostępne Skrzypki</h2>
        <ul>
            <?php foreach ($violins as $violin): ?>
                <li>
                    <strong><?php echo htmlspecialchars($violin['model']); ?></strong> (<?php echo htmlspecialchars($violin['year']); ?>)
                    <br>Cena: <?php echo htmlspecialchars($violin['price']); ?> PLN/dobę
                    <br>Opis: <?php echo nl2br(htmlspecialchars($violin['description'])); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

    <footer>
        <p>&copy; 2024 Wynajem Skrzypków</p>
    </footer>
</body>
</html>