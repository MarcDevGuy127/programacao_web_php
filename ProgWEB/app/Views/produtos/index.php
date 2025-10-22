<?php
// app/Views/produtos/index.php

// Captura o output desta view para ser inserido no layout.php
ob_start();
?>

<h1>Lista de Produtos</h1>
<a href="/CRUD/produtos/criar" class="btn btn-primary">Adicionar Novo Produto</a>

<?php if (empty($produtos)): ?>
    <p>Nenhum produto cadastrado.</p>
<?php else: ?>
    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto['Id']); ?></td>
                    <td><?php echo htmlspecialchars($produto['Nome']); ?></td>
                    <td><?php echo htmlspecialchars($produto['Descricao']); ?></td>
                    <td>R$ <?php echo number_format($produto['Preco'], 2, ',', '.'); ?></td>
                    <td class="actions">
                        <a href="/CRUD/produtos/editar/<?php echo htmlspecialchars($produto['Id']); ?>"
                            class="btn btn-info">Editar</a>
                        <form action="/CRUD/produtos/excluir" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['Id']); ?>">
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
// Termina a captura e armazena o conteúdo na variável $content
$content = ob_get_clean();

// Define o título da página para o layout
$title = 'Lista de Produtos';

// Inclui o layout principal
require_once __DIR__ . '/../layout.php';
?>