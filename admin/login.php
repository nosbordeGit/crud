<?php
// login.php
session_start();
include '../config/config.php'; // Conectar ao banco de dados

$title = "Login";
ob_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber dados do formulário
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Validar se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Conectar ao banco de dados
        $conn = dbConnect();
        if (!$conn) {
            die("Erro ao conectar ao banco de dados.");
        }

        // Preparar a consulta para buscar o usuário pelo email
        $query = "SELECT id, nome, email, senha, tipo FROM usuarios WHERE email = ?";
        $stm = $conn->prepare($query);
        $stm->bind_param("s", $email);
        $stm->execute();
        $result = $stm->get_result();

        // Verificar se o usuário existe
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verificar se a senha fornecida corresponde à senha armazenada
            if (password_verify($senha, $user['senha'])) {
                // Autenticação bem-sucedida
                $_SESSION['username'] = $user['nome'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_tipo'] = $user['tipo'];

                // Redirecionar para o dashboard
                header("Location: ../admin/dashboard.php");
                exit;
            } else {
                // Senha incorreta
                $erro = "E-mail ou senha incorretos.";
            }
        } else {
            // Usuário não encontrado
            $erro = "E-mail ou senha incorretos.";
        }

        // Fechar a conexão
        $stm->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .container {
            max-width: 400px;
            margin-top: 100px;
        }
        .form-signin {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #000;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php include_once '../templates/header.php'; ?>

<div class="container">
    <h2 class="text-center mb-4">Login</h2>

    <?php if (isset($erro)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $erro; ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="form-signin">
        <!-- E-mail -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required>
        </div>

        <!-- Senha -->
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required>
        </div>

        <!-- Botão de Login -->
        <button type="submit" class="btn btn-custom w-100">Entrar</button>
    </form>

    <div class="mt-3 text-center">
        <p>Não tem uma conta? <a href="register.php">Cadastre-se aqui</a></p>
    </div>
</div>
</body>
</html>
