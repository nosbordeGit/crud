<?php
// public/index.php
$title = "Home";
session_start();
include '../templates/template.php';
include '../config/config.php';
ob_start();
?>
<?php if ($conn = dbConnect()) : ?>
    <div class="container-fluid">
        <h1>Home</h1>
    </div>
<?php else : ?>
    <h1>Erro ao Conectar ao Banco de Dados!</h1>
<?php endif; ?>

<?php
$content = ob_get_clean();
echo renderTemplate($content);
?>