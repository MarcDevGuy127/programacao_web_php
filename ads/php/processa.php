<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $atuacao = $_POST['atuacao'];
    $experiencia = $_POST['experiencia'];
    $interesses = $_POST['interesses'];
    $comentario = $_POST['comentario'];
    $noticias = $_POST['noticias'];

    if (empty($nome)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: Escreva um nome obrigatório.</h1>";
        echo "<a href='../inscricao.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: informe um e-mail válido.</h1>";
        echo "<a href='../inscricao.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($atuacao)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: a seleção da área de atuação é obrigatória.</h1>";
        echo "<a href='../inscricao.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($experiencia)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: o tempo de experiência é obrigatório.</h1>";
        echo "<a href='../inscricao.html'>Retorne para a página principal</a>";
        exit;
    }


    if (empty($interesses)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: selecionar o seu interesse é obrigatório.</h1>";
        echo "<a href='../inscricao.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($comentario)) {
        echo "<h1 style='color: brown;background-color: white;'>Erro: a escrita de um comentário é obrigatório.</h1>";
        echo "<a href='../inscricao.html'>Retorne para a página principal</a>";
        exit;
    }

    if ($noticias == 'sim_noticias') {
        echo "<h1 style='color: green;background-color: white;'>Sua newsletter foi habilitada!</h1>";
    }

    echo "<body style='background-color: cornflowerblue;'>";
    echo "<h1 style='color: green; background-color: white;'>Inscrição bem-sucedida!</h1>";
    echo '<textarea rows="16" cols="40"wid readonly>';
    echo "Nome: " . htmlspecialchars($nome) . "\n";
    echo "Atuação: " . htmlspecialchars($atuacao) . "\n";
    echo "Experiência: " . htmlspecialchars($experiencia) . "\n";
    echo "Interesse: " . htmlspecialchars($interesses) . "\n";
    echo "Comentário: \n" . htmlspecialchars($comentario) . "\n";
    echo "Receber notícias: \n" . htmlspecialchars($noticias) . "\n";
    echo "</textarea>";
    echo "</body>";
}
?>