<?php
session_start(); // Rozpoczynamy sesję

// Domyślna wartość zmiennej file
$file = 'oferta.php';

// Sprawdzamy, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdzamy, czy wybrano plik
    if (isset($_POST['file_option'])) {
        $file = $_POST['file_option'];
        $_SESSION['file'] = $file; // Zapisujemy do sesji
    }

    // Zapisujemy zmodyfikowaną treść do pliku
    $content = $_POST['content'];
    
    // Używamy wyrażenia regularnego do zastąpienia zawartości div'a o id "kontent"
    $fullContent = file_get_contents($file);
    $newContent = preg_replace('/<div id="kontent">.*?<\/div>/s', '<div id="kontent">' . $content . '</div>', $fullContent);
    
    file_put_contents($file, $newContent);
}

// Sprawdzamy, czy w sesji jest zapisany plik
if (isset($_SESSION['file'])) {
    $file = $_SESSION['file'];
}

// Wczytujemy istniejącą treść z pliku
$existingContent = '';
if (file_exists($file)) {
    $existingContent = file_get_contents($file);
    
    // Używamy wyrażenia regularnego do wyodrębnienia zawartości div'a o id "kontent"
    preg_match('/<div id="kontent">(.*?)<\/div>/s', $existingContent, $matches);
    
    // Sprawdzamy, czy znaleziono zawartość
    $existingContent = isset($matches[1]) ? trim($matches[1]) : '';
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytor Treści - Oferta</title>
    <link rel="stylesheet" href="styleedytor.css">
    <script src="https://cdn.tiny.cloud/1/3gjfx29yg5xjtn7c9cw20bpzifsfyl0bayu92tvlcjcxsd59/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            menubar: false,
            height: 300
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Edytor Treści - Oferta</h1>

        <!-- Suwak wyboru pliku -->
        <form method="post" id="fileForm">
            <label for="file_option">Wybierz plik:</label>
            <select id="file_option" name="file_option" onchange="document.getElementById('fileForm').submit()">
                <option value="index.html" <?php echo ($file == 'index.php') ? 'selected' : ''; ?>>Index</option>
                <option value="galeria.html" <?php echo ($file == 'galeria.php') ? 'selected' : ''; ?>>Galeria</option>
                <option value="oferta.php" <?php echo ($file == 'oferta.php') ? 'selected' : ''; ?>>Oferta</option>
            </select>
        </form>

        <!-- Formularz do edycji treści -->
        <form method="post">
            <textarea id="editor" name="content"><?php echo htmlspecialchars($existingContent); ?></textarea><br>
            <button type="submit">Zapisz</button>
        </form>

        <h2>Podgląd Treści</h2>
        <div class="preview">
            <?php echo $existingContent; ?>
        </div>
    </div>
</body>
</html>