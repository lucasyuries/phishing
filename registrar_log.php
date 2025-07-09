<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 


$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "phishing_logs"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$ip_origem = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_origem = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_origem = $_SERVER['HTTP_X_FORWARDED_FOR'];
}



$tipo_interacao = isset($_GET['acao']) ? $conn->real_escape_string($_GET['acao']) : 'abertura_direta';


$timestamp_log = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO interacoes (ip_origem, tipo_interacao, timestamp_log) VALUES (?, ?, ?)");

$stmt->bind_param("sss", $ip_origem, $tipo_interacao, $timestamp_log);


if ($stmt->execute()) {
    // Sucesso na gravação do log. Não retornamos nada visual para o usuário.
} else {
    // Erro na gravação do log. Apenas para depuração se precisar.
    // echo "Erro ao registrar log: " . $stmt->error;
}


$stmt->close();
$conn->close();

?>