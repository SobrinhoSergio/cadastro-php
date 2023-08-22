<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Aqui você pode criar a conexão com o banco de dados e implementar a lógica de exclusão do registro com o ID fornecido
    require_once 'conexao.php';

    try {

        // Deletar o registro com o ID fornecido
        $stmt = $pdo->prepare("DELETE FROM pessoas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redirecionar de volta para a página de exibição de dados
        header("Location: dados.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
