<?php
// Desabilita a exibição de erros no navegador por segurança em ambiente de produção
// Para testes locais, você pode comentar as duas linhas abaixo para ver erros caso aconteçam.
error_reporting(E_ALL); // Liga todos os tipos de erro
ini_set('display_errors', 1); // Exibe os erros no navegador

// ... o restante do seu código PHP

// --- 1. Configurações do Banco de Dados ---
// Estas são as credenciais padrão do MySQL no XAMPP
$servername = "localhost"; // Geralmente é 'localhost' para o MySQL do XAMPP
$username = "root";        // Usuário padrão do MySQL no XAMPP
$password = "";            // Senha padrão do MySQL no XAMPP (quase sempre vazia por padrão)
$dbname = "phishing_logs"; // Nome do banco de dados que você criou no Passo 1

// --- 2. Cria a Conexão com o Banco de Dados ---
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    // MUDE ESTA LINHA:
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// --- 3. Obter o Endereço IP do Visitante ---
// Tenta pegar o IP real do usuário, considerando cenários com proxies
$ip_origem = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_origem = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_origem = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

// --- 4. Obter o Tipo de Interação ---
// A interação será passada para este script via um parâmetro 'acao' na URL (GET)
// Se nenhum parâmetro 'acao' for fornecido, assume 'abertura_direta'
$tipo_interacao = isset($_GET['acao']) ? $conn->real_escape_string($_GET['acao']) : 'abertura_direta';

// --- 5. Obter o Timestamp Atual ---
// Pega a data e hora exatas do momento da interação
$timestamp_log = date('Y-m-d H:i:s');

// --- 6. Preparar e Executar a Inserção no Banco de Dados ---
// Usamos 'prepared statements' para maior segurança (prevenindo SQL Injection)
$stmt = $conn->prepare("INSERT INTO interacoes (ip_origem, tipo_interacao, timestamp_log) VALUES (?, ?, ?)");

// 'bind_param("sss", ...)' informa que esperamos 3 strings (s)
$stmt->bind_param("sss", $ip_origem, $tipo_interacao, $timestamp_log);

// Tenta executar a inserção
if ($stmt->execute()) {
    // Sucesso na gravação do log. Não retornamos nada visual para o usuário.
} else {
    // Erro na gravação do log. Apenas para depuração se precisar.
    // echo "Erro ao registrar log: " . $stmt->error;
}

// --- 7. Fechar a Conexão ---
$stmt->close();
$conn->close();

// Este script não precisa exibir nada no navegador, apenas processar o log.
?>