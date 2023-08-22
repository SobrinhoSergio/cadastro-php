<?php
// Configurações do banco de dados
require_once 'conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $telefone = $_POST['telefone'];
    $profissao = $_POST['profissao'];

    try {
        $stmt = $pdo->prepare("INSERT INTO pessoas (nome, idade, cidade, estado, numero_de_telefone, profissao)
                               VALUES (:nome, :idade, :cidade, :estado, :telefone, :profissao)");
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':profissao', $profissao);
        
        $stmt->execute();

        $mensagem = "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


    <div class="container mt-5">
        
        <a href="dados.php" class="btn btn-warning">Exibir Dados Cadastrados</a>

        <h2>Cadastro de Pessoas</h2>
        <?php if (!empty($mensagem)) : ?>
            <div class="alert <?php echo (strpos($mensagem, 'Erro') !== false) ? 'alert-danger' : 'alert-success'; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" class="form-control" id="idade" name="idade" required>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
            </div>
            <div class="form-group">
                <label for="telefone">Número de Telefone:</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" required pattern="[0-9]{10,}" title="Digite apenas números, pelo menos 10 dígitos">
            </div>
            <div class="form-group">
                <label for="profissao">Profissão:</label>
                <input type="text" class="form-control" id="profissao" name="profissao" required>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <div class="mt-3">
            
    </div>
        </form>
    </div>

  
    <script>
        // Limpar o formulário após a submissão
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').reset();
        });
    </script>
</body>
</html>
