<?php

//admin/create_user.php
session_start();
include '../config/config.php'; // Inclui conexão com o banco de dados 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = dbConnect();
    if (!$conn) {
        die("Erro ao conectar ao banco de dados");
    }

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = 'usuario';

    // Diretório onde as fotos serão salvas
    $uploadDir = '../public/img/';

    // Criar a pasta se não existir
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Função para limpar o nome do arquivo
    function limparNomeArquivo($nome)
    {
        return preg_replace('/[^a-zA-Z0-9._-]/', '_', $nome);
    }

    // Tratamento da foto
    $fotoNome = null;
    if (!empty($_FILES['foto']['name'])) {
        if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            die("Erro no upload da foto.");
        }

        $fotoNome = time() . '_' . limparNomeArquivo($_FILES['foto']['name']);
        $fotoCaminho = $uploadDir . $fotoNome;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $fotoCaminho)) {
            die("Erro ao mover arquivo. Verifique permissões da pasta.");
        }
    }

    // Inserindo no banco de dados
    $stm = $conn->prepare("INSERT INTO usuarios (nome, email, senha, foto, tipo) VALUES (?, ?, ?, ?, ?)");
    $stm->bind_param("sssss", $nome, $email, $senha, $fotoNome, $tipo);

    if ($stm->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = '../public/'</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuário.'); window.history.back();</script>";
    }

    // Fechamento da conexão
    $stm->close();
    $conn->close();
}
