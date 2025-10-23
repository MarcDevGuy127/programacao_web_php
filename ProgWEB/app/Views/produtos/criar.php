<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="/CRUD/public/css/style.css">
</head>

<body>
    <h1>Adicionar Novo Produto</h1>
    <form action="/CRUD/produtos/criar" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao"></textarea><br><br>

        <label for="preco">Preço:</label><br>
        <input type="number" id="preco" name="preco" step="0.01" required><br><br>

        <label for="estoque">Estoque:</label><br>
        <input type="number" id="estoque" name="estoque" required><br><br>

        <button type="submit">Salvar Produto</button>
        <a href="/CRUD/produtos">Cancelar</a>
    </form>
</body>

</html>