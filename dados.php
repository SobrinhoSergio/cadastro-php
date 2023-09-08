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
                <a href="#" class="btn btn-danger delete-btn" data-id="' . $row['id'] . '"><i class="bi bi-archive"></i></a>
              </td>';
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este usuário?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="#" id="deleteUserLink" class="btn btn-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Adicionar manipuladores de evento para os botões de exclusão
    $('.delete-btn').click(function () {
        var userId = $(this).data('id');
        // Definir o link de exclusão com base no ID do usuário
        $('#deleteUserLink').attr('href', 'dados.php?id=' + userId);
        // Mostrar o modal de confirmação de exclusão
        $('#confirmDeleteModal').modal('show');
    });
</script>

</body>
</html>
