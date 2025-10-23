<?php
$dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Verificar se o novo e-mail já existe em outro usuário
    $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND id != :id");
    $verifica->bindParam(':email', $email);
    $verifica->bindParam(':id', $id);
    $verifica->execute();

    if ($verifica->rowCount() > 0) {
        echo "<script>
            alert('Este e-mail já está em uso por outro usuário.');
            window.location.href = 'editar.php?id=$id';
        </script>";
        exit;
    }

    $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Dados atualizados com sucesso!');
            window.location.href = 'listar.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao atualizar.');
            window.location.href = 'editar.php?id=$id';
        </script>";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
