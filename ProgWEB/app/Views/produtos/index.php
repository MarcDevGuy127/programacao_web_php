<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="/CRUD/public/css/style.css"> <!-- Exemplo de CSS -->
</head>

<body>
    <h1>Produtos Cadastrados</h1>
    <a href="/CRUD/produtos/criar">Adicionar Novo Produto</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($produtos)): // $produtos virá do Controller ?>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produto['id']); ?></td>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td><?php echo htmlspecialchars($produto['preco']); ?></td>
                        <td><?php echo htmlspecialchars($produto['estoque']); ?></td>
                        <td>
                            <a href="/CRUD/produtos/ver/<?php echo $produto['id']; ?>">Ver</a> |
                            <a href="/CRUD/produtos/editar/<?php echo $produto['id']; ?>">Editar</a> |
                            <a href="/CRUD/produtos/deletar/<?php echo $produto['id']; ?>"
                                onclick="return confirm('Tem certeza?');">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum produto cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>