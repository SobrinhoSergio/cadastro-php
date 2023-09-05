<?php
require_once 'conexao.php'; // Certifique-se de incluir a conexão aqui

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Aqui você pode implementar a lógica de exclusão do registro com o ID fornecido
        $stmt = $pdo->prepare("DELETE FROM pessoas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Mensagem de sucesso após a exclusão
        $successMessage = "Registro excluído com sucesso.";

        header("refresh:5;url=dados.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>


<div class="container mt-5">
        <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i></a>
        <h2>Dados Cadastrados</h2>
        <?php
            if (!empty($successMessage)) {
                echo '<div class="alert alert-success">' . $successMessage . '</div>';
            }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Número de Telefone</th>
                    <th>Profissão</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                require_once 'conexao.php';
                
                $stmt = $pdo->prepare("SELECT * FROM pessoas");
                $stmt->execute();
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['idade'] . "</td>";
                    echo "<td>" . $row['cidade'] . "</td>";
                    echo "<td>" . $row['estado'] . "</td>";
                    echo "<td>" . $row['numero_de_telefone'] . "</td>";
                    echo "<td>" . $row['profissao'] . "</td>";
                    echo '<td>
                            <a href="editar.php?id=' . $row['id'] . '" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                          </td>';
                          echo '<td>
                            <a href="dados.php?id=' . $row['id'] . '" class="btn btn-danger"><i class="bi bi-archive"></i></a>
                          </td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>