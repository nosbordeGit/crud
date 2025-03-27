<?php
//admin/register.php
session_start();
include '../templates/template.php';

$title = "Cadastro";
ob_start();

$_SESSION['username'] = 'admin';
?>

<div class="container mt-5">
    <h2 class="mb-4">Cadastro de usuário</h2>
    <form action="create_user.php" method="POST" enctype="multipart/form-data">
        <!-- Nome -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required>
        </div>

        <!-- E-mail -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required>
        </div>

        <!-- Senha e Foto (tamanho reduzido) -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
            </div>
        </div>

        <!-- Botão de Cadastro -->
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
<?php
$content = ob_get_clean();
echo renderTemplate($content);
?>