<?php
$dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pega o ID pela URL
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuarioData) {
        echo "<p>Usuário não encontrado.</p>";
        exit;
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial;
            margin: 40px;
        }

        form {
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #342397ff;
            color: white;
            border: none;
            border-radius: 4px;
            margin: 2px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkblue;
        }
    </style>
</head>

<body>

    <h2>Editar Usuário</h2>

    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?= $usuarioData['id'] ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($usuarioData['nome']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($usuarioData['email']) ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>

    <button type="button" onclick="window.location.href='listar.php'">Voltar</button>

</body>

</html>