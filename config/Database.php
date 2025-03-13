<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Carregar as variáveis do arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configurações de conexão com o banco de dados
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];

try {
    // Criando a conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configuração do PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opcional: definir o charset para UTF-8 para evitar problemas de codificação
    $pdo->exec("SET NAMES 'utf8'");
    
} catch (PDOException $e) {
    // Caso haja erro na conexão, exibe uma mensagem de erro
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Não use return, apenas deixe a variável $pdo disponível
