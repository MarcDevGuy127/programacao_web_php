<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $informacao = $_POST['informacao'];
    $avaliacao = $_POST['avaliacao'];
    $gostou = $_POST['gostou'];
    $sugestao = $_POST['sugestao'];

    if (empty($nome)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: Escreva um nome obrigatório.</h1>";
        echo "<a href='../pesquisa.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: informe um e-mail válido.</h1>";
        echo "<a href='../pesquisa.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($informacao)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: a seleção de como soube do evento é obrigatório.</h1>";
        echo "<a href='../pesquisa.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($avaliacao)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: a avaliação é obrigatório.</h1>";
        echo "<a href='../pesquisa.html'>Retorne para a página principal</a>";
        exit;
    }


    if (empty($gostou)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: selecionar o que gostou é obrigatório.</h1>";
        echo "<a href='../pesquisa.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($sugestao)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: a escrita de uma sugestão é obrigatória.</h1>";
        echo "<a href='../pesquisa.html'>Retorne para a página principal</a>";
        exit;
    }

    echo "<body style='background-color: cornflowerblue;'>";
    echo "<h1 style='color: green; background-color: white;'>Envio bem-sucedido!</h1>";
    echo '<textarea rows="16" cols="40"wid readonly>';
    echo "Nome: " . htmlspecialchars($nome) . "\n";
    echo "Informação: " . htmlspecialchars($informacao) . "\n";
    echo "Avaliação: " . htmlspecialchars($avaliacao) . "\n";
    echo "O que mais gostou? " . htmlspecialchars($gostou) . "\n";
    echo "Sugestões: \n" . htmlspecialchars($sugestao) . "\n";
    echo "</textarea>";
    echo "</body>";
}
?>