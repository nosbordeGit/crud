<?php
//config/config.php
// Configurações do Banco de Dados (MySQLi)
define('DB_HOST', 'mysql');  // Nome do serviço do Docker Compose
define('DB_NAME', 'cadsystem');
define('DB_USER', 'root');
define('DB_PASS', 'password');  // Certifique-se de que está correto

// Função para Conectar ao Banco de Dados usando MySQLi
function dbConnect()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Verificar Conexão
    if (!$conn) {
        die("❌ Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    return $conn;
}

dbConnect();