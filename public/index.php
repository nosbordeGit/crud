<?php
//public/index.php
session_start();
include '../templates/template.php';

$title = "Home";
ob_start();

$_SESSION['username'] = 'admin';
?>

<h2 class="text-center mt-5">Bem-vindo, <?php echo $_SESSION['username']; ?>!</h2>
<p class="text-center">Pagina dinamica em PHP</p>

<?php
$content = ob_get_clean();
echo renderTemplate($content);
?>