<?php
$dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Captura o termo da busca
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($busca) {
        // Pesquisa por nome ou email (usando LIKE)
        $stmt = $pdo->prepare("SELECT * FROM usuarios 
                               WHERE nome LIKE :busca OR email LIKE :busca
                               ORDER BY id DESC");
        $termo = "%$busca%";
        $stmt->bindParam(':busca', $termo);
        $stmt->execute();
    } else {
        // Lista todos se não houver busca
        $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
    }

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial;
            margin: 40px;
        }

        table {
            border-collapse: collapse;
            width: 70%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }

        .excluir {
            color: red;
        }

        .busca-box {
            margin-bottom: 15px;
        }

        input[type="text"] {
            padding: 6px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 6px 10px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este usuário?")) {
                window.location.href = 'excluir.php?id=' + id;
            }
        }
    </script>
</head>

<body>

    <h2>Usuários Cadastrados</h2>

    <!-- 🔍 Campo de Busca -->
    <form method="GET" action="listar.php" class="busca-box">
        <input type="text" name="busca" placeholder="Buscar por nome ou email"
            value="<?= htmlspecialchars($busca ?? '') ?>">
        <button type="submit">Buscar</button>
        <?php if (!empty($busca)): ?>
            <a href="listar.php" style="margin-left:10px;">Limpar</a>
        <?php endif; ?>
    </form>

    <!-- 📋 Tabela de Usuários -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>

        <?php if (count($usuarios) > 0): ?>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nome']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['telefone']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $u['id'] ?>">Editar</a> |
                        <a href="#" class="excluir" onclick="confirmarExclusao(<?= $u['id'] ?>)">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">Nenhum usuário encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>

    <p><a href="index.html">← Voltar ao cadastro</a></p>

</body>

</html>