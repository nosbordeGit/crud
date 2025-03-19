<?php
// templates/template.php
function startBuffer() {
    ob_start();
}

function endBuffer() {
    return ob_get_clean();
}

function renderTemplate($content) {
    global $title;  // Acessa a variável global
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? 'Página'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
}
?>
