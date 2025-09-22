<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data = $_POST['data'];
    $sexo = $_POST['sexo'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    $novidade = $_POST['novidade'];
    $mensagem = $_POST['mensagem'];
    $termos = $_POST['termos'];

    if ($senha !== $confirma_senha) {
        echo "<h1 id='erro'>As senhas não coincidem. Tente novamente.</h1>";
        echo "<a href='../index.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h1 id='erro'>Erro: informe um E-mail válido.</h1>";
        echo "<a href='../index.html'>Retorne para a página principal</a>";
        exit;
    }

    if (empty($data)) {
        echo "<h1 id='erro'>Erro: a Data de Nascimento é obrigatória.</h1>";
        echo "<a href='../index.html'>Retorne para a página principal</a>";
        exit;
    }

    if ($termos === "nao") {
        echo "<h1 id='erro'>Erro: você deve aceitar os Termos de Uso.</h1>";
        echo "<a href='../index.html'>Retorne para a página principal</a>";        
        exit;
    }

    echo "<h1 id='correto'>Cadastro bem-sucedido!</h1>";
    echo '<textarea rows="16" cols="40">';
    echo "Nome: " . htmlspecialchars($nome) . "\n";
    echo "E-mail: " . htmlspecialchars($email) . "\n";
    echo "Telefone: " . htmlspecialchars($telefone) . "\n";
    echo "Data de Nascimento: " . htmlspecialchars($data) . "\n";
    echo "Sexo: " . htmlspecialchars($sexo) . "\n";
    echo "Novidades: " . htmlspecialchars($novidade) . "\n";
    echo "Mensagem: " . htmlspecialchars($mensagem) . "\n";
    echo "Termos: " . htmlspecialchars($termos) . "\n";
    echo "</textarea>";
}
?>