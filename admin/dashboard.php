<?php
//admin/dashboard.php
session_start();
include '../config/config.php';
include '../templates/template.php';

$title = "Dashboard";
ob_start();

$_SESSION['username'] = 'admin';
?>

<h2 class="text-center mt-5">Bem-vindo, <?php echo $_SESSION['username']; ?>!</h2>
<p class="text-center">Pagina dashboard</p>

<?php
$content = ob_get_clean();
echo renderTemplate($content);
?>