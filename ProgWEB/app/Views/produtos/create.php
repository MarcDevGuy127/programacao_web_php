<?php ob_start(); ?>

<h1>Adicionar Novo Produto</h1>

<form action="/CRUD/produtos/salvar" method="POST" class="product-form">
    <div>
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required>
    </div>
    <div>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4"></textarea>
    </div>
    <div>
        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" min="0.01" required>
    </div>
    <div>
        <button type="submit" class="btn btn-success">Salvar Produto</button>
        <a href="/CRUD/produtos" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php
$content = ob_get_clean();
$title = 'Adicionar Produto';
require_once __DIR__ . '/../layout.php';
?>