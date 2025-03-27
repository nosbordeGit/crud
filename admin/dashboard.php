<?php
// admin/dashboard.php
session_start();
include '../config/config.php';
include '../templates/template.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$title = "Dashboard";
ob_start();

$conn = dbConnect();
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

// Busca os usuários cadastrados
$query = "SELECT id, nome, email, tipo FROM usuarios";
$result = $conn->query($query);
?>

<h2 class="text-center mt-5">Bem-vindo, <?php echo $_SESSION['username']; ?>!</h2>
<p class="text-center">Lista de usuários cadastrados</p>

<div class="container mt-4">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['nome']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo ucfirst($user['tipo']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
$content = ob_get_clean();
echo renderTemplate($content);
?>
