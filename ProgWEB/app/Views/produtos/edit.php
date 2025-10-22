<?php ob_start(); ?>

<h1>Editar Produto</h1>

<?php if (isset($produto)): ?>
    <form action="/CRUD/produtos/atualizar" method="POST" class="product-form">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['Id']); ?>">
        <div>
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['Nome']); ?>" required>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"
                rows="4"><?php echo htmlspecialchars($produto['Descricao']); ?></textarea>
        </div>
        <div>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0.01"
                value="<?php echo htmlspecialchars($produto['Preco']); ?>" required>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Atualizar Produto</button>
            <a href="/CRUD/produtos" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
<?php else: ?>
    <p>Produto não encontrado para edição.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
$title = 'Editar Produto';
require_once __DIR__ . '/../layout.php';
?>