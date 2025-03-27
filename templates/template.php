<?php
// templates/template.php
function startBuffer()
{
    ob_start();
}

function endBuffer()
{
    return ob_get_clean();
}

function renderTemplate($content)
{
    $title = $GLOBALS['title'] ?? 'Página';  // Garante que a variável $title será usada
?>
    <!doctype html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo htmlspecialchars($title); ?></title>
        <link href="../public/assets/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <?php include_once '../templates/header.php'; ?>
        </header>
        <main>
            <?php echo $content; ?>
        </main>
        <footer>
            <?php include_once '../templates/footer.php'; ?>
        </footer>

        <script src="../public/assets/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
}

?>