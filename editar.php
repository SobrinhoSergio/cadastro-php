<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Aqui você precisa criar a conexão com o banco de dados e obter os dados do registro com o ID fornecido
    require_once 'conexao.php';

    try {
        $stmt = $pdo->prepare("SELECT * FROM pessoas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processar as edições e atualizar os dados no banco de dados
            $nome = $_POST['nome'];
            $idade = $_POST['idade'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $telefone = $_POST['telefone'];
            $profissao = $_POST['profissao'];

            $updateStmt = $pdo->prepare("UPDATE pessoas SET nome = :nome, idade = :idade, cidade = :cidade, estado = :estado, numero_de_telefone = :telefone, profissao = :profissao WHERE id = :id");
            $updateStmt->bindParam(':nome', $nome);
            $updateStmt->bindParam(':idade', $idade);
            $updateStmt->bindParam(':cidade', $cidade);
            $updateStmt->bindParam(':estado', $estado);
            $updateStmt->bindParam(':telefone', $telefone);
            $updateStmt->bindParam(':profissao', $profissao);
            $updateStmt->bindParam(':id', $id);

            if ($updateStmt->execute()) {
                $successMessage = 'Edições salvas com sucesso!';
                header("refresh:3;url=dados.php"); // Redirecionar para dados.php após 3 segundos
            } else {
    $errorMessage = 'Erro ao salvar as edições.';
}
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Registro</h2>
        <?php
            if (isset($successMessage)) {
                echo '<div class="alert alert-success">' . $successMessage . '</div>';
            } elseif (isset($errorMessage)) {
                echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
            }
        ?>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $registro['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" class="form-control" id="idade" name="idade" value="<?php echo $registro['idade']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $registro['cidade']; ?>" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $registro['estado']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Número de Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $registro['numero_de_telefone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="profissao">Profissão:</label>
                <input type="text" class="form-control" id="profissao" name="profissao" value="<?php echo $registro['profissao']; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Campo oculto para enviar o ID -->
            <button type="submit" class="btn btn-primary">Salvar Edições</button>
        </form>
    </div>
</body>
</html>
