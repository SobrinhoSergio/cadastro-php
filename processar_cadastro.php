<?php
// Dados do formulário
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$telefone = $_POST['telefone'];
$profissao = $_POST['profissao'];

// Configurações do banco de dados
require_once 'conexao.php';

try {
    // Conexão PDO

    // Inserção dos dados
    $stmt = $pdo->prepare("INSERT INTO pessoas (nome, idade, cidade, estado, numero_de_telefone, profissao)
                           VALUES (:nome, :idade, :cidade, :estado, :telefone, :profissao)");
    
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':profissao', $profissao);
    
    $stmt->execute();

    echo "Cadastro realizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>