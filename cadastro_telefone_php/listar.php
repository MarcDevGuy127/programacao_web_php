<?php
// Configuração de conexão
$dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
$usuario = "root";
$senha = "";

// Caminho do arquivo de log
$arquivoLog = __DIR__ . '/erros.log';

try {
    // Tentativa de conexão
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // --- FILTROS DE BUSCA E ORDENAÇÃO ---
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'nome';
    $direcao = filter_input(INPUT_GET, 'direcao', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'ASC';

    // Evita SQL Injection — só permite essas colunas e direções
    $colunasPermitidas = ['nome', 'email'];
    $direcoesPermitidas = ['ASC', 'DESC'];

    if (!in_array($ordem, $colunasPermitidas))
        $ordem = 'nome';
    if (!in_array($direcao, $direcoesPermitidas))
        $direcao = 'ASC';

    // --- MONTANDO CONSULTA ---
    if ($busca) {
        $stmt = $pdo->prepare("SELECT id, nome, email, telefone FROM usuarios 
                               WHERE nome LIKE :busca OR email LIKE :busca 
                               ORDER BY $ordem $direcao");
        $stmt->bindValue(':busca', "%$busca%");
    } else {
        $stmt = $pdo->prepare("SELECT id, nome, email, telefone FROM usuarios 
                               ORDER BY $ordem $direcao");
    }

    $stmt->execute();

    // Usando FETCH_NUM (retorna um array numérico)
    $usuarios = $stmt->fetchAll(PDO::FETCH_NUM);

} catch (PDOException $e) {
    // --- REGISTRA O ERRO DETALHADO NO LOG ---
    $mensagemErro = "[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . PHP_EOL;
    file_put_contents($arquivoLog, $mensagemErro, FILE_APPEND);

    // --- MOSTRA MENSAGEM AMIGÁVEL AO USUÁRIO ---
    echo "<p style='color:red; font-family: Arial;'>Ocorreu um problema ao carregar os dados. Tente novamente mais tarde.</p>";

    // Interrompe a execução para evitar exibir conteúdo inconsistente
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Listagem de Usuários</h1>

    <form method="GET" action="">
        <input type="text" name="busca" placeholder="Buscar por nome ou email" value="<?= htmlspecialchars($busca) ?>">
        <button type="submit">Buscar</button>
    </form>

    <table>
        <tr>
            <th><a href="?ordem=nome&direcao=<?= $ordem === 'nome' && $direcao === 'ASC' ? 'DESC' : 'ASC' ?>">Nome</a>
            </th>
            <th><a
                    href="?ordem=email&direcao=<?= $ordem === 'email' && $direcao === 'ASC' ? 'DESC' : 'ASC' ?>">Email</a>
            </th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario[1]) ?></td>
                <td><?= htmlspecialchars($usuario[2]) ?></td>
                <td><?= htmlspecialchars($usuario[3]) ?></td>
                <td>
                    <a href="editar.php?id=<?= $usuario[0] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $usuario[0] ?>"
                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p>
        <a href="index.html">Sair</a>
    </p>
</body>

</html>