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
                <select class="form-control" id="estado" name="estado" required>
                    <option value="">Selecione um estado</option>
                    <option value="AC" <?php if ($registro['estado'] === 'AC') echo 'selected'; ?>>Acre</option>
                    <option value="AL" <?php if ($registro['estado'] === 'AL') echo 'selected'; ?>>Alagoas</option>
                    <option value="AP" <?php if ($registro['estado'] === 'AP') echo 'selected'; ?>>Amapá</option>
                    <option value="AM" <?php if ($registro['estado'] === 'AM') echo 'selected'; ?>>Amazonas</option>
                    <option value="BA" <?php if ($registro['estado'] === 'BA') echo 'selected'; ?>>Bahia</option>
                    <option value="CE" <?php if ($registro['estado'] === 'CE') echo 'selected'; ?>>Ceará</option>
                    <option value="DF" <?php if ($registro['estado'] === 'DF') echo 'selected'; ?>>Distrito Federal</option>
                    <option value="ES" <?php if ($registro['estado'] === 'ES') echo 'selected'; ?>>Espírito Santo</option>
                    <option value="GO" <?php if ($registro['estado'] === 'GO') echo 'selected'; ?>>Goiás</option>
                    <option value="MA" <?php if ($registro['estado'] === 'MA') echo 'selected'; ?>>Maranhão</option>
                    <option value="MT" <?php if ($registro['estado'] === 'MT') echo 'selected'; ?>>Mato Grosso</option>
                    <option value="MS" <?php if ($registro['estado'] === 'MS') echo 'selected'; ?>>Mato Grosso do Sul</option>
                    <option value="MG" <?php if ($registro['estado'] === 'MG') echo 'selected'; ?>>Minas Gerais</option>
                    <option value="PA" <?php if ($registro['estado'] === 'PA') echo 'selected'; ?>>Pará</option>
                    <option value="PB" <?php if ($registro['estado'] === 'PB') echo 'selected'; ?>>Paraíba</option>
                    <option value="PR" <?php if ($registro['estado'] === 'PR') echo 'selected'; ?>>Paraná</option>
                    <option value="PE" <?php if ($registro['estado'] === 'PE') echo 'selected'; ?>>Pernambuco</option>
                    <option value="PI" <?php if ($registro['estado'] === 'PI') echo 'selected'; ?>>Piauí</option>
                    <option value="RJ" <?php if ($registro['estado'] === 'RJ') echo 'selected'; ?>>Rio de Janeiro</option>
                    <option value="RN" <?php if ($registro['estado'] === 'RN') echo 'selected'; ?>>Rio Grande do Norte</option>
                    <option value="RS" <?php if ($registro['estado'] === 'RS') echo 'selected'; ?>>Rio Grande do Sul</option>
                    <option value="RO" <?php if ($registro['estado'] === 'RO') echo 'selected'; ?>>Rondônia</option>
                    <option value="RR" <?php if ($registro['estado'] === 'RR') echo 'selected'; ?>>Roraima</option>
                    <option value="SC" <?php if ($registro['estado'] === 'SC') echo 'selected'; ?>>Santa Catarina</option>
                    <option value="SP" <?php if ($registro['estado'] === 'SP') echo 'selected'; ?>>São Paulo</option>
                    <option value="SE" <?php if ($registro['estado'] === 'SE') echo 'selected'; ?>>Sergipe</option>
                    <option value="TO" <?php if ($registro['estado'] === 'TO') echo 'selected'; ?>>Tocantins</option>
                </select>
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
