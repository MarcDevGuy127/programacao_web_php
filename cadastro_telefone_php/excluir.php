<?php
$dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recebe o ID pela URL
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!$id) {
        echo "<script>
            alert('ID inválido!');
            window.location.href = 'listar.php';
        </script>";
        exit;
    }

    // Verifica se o usuário existe
    $check = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $check->bindParam(':id', $id);
    $check->execute();

    if ($check->rowCount() === 0) {
        echo "<script>
            alert('Usuário não encontrado!');
            window.location.href = 'listar.php';
        </script>";
        exit;
    }

    // Exclui o usuário
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Usuário excluído com sucesso!');
            window.location.href = 'listar.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao excluir usuário.');
            window.location.href = 'listar.php';
        </script>";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
