<?php 
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $to = "destinatario@exemplo.com";
    $subject = "Novo contato do site";
    $body = "Nome: $nome\nEmail: $email\nMensagem:\n$mensagem";

    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "E-mail enviado com sucesso!";
    } else {
        echo "Erro ao enviar e-mail.";
    }

    $erros = [];

    if (empty($titulo_tarefa)) {
        $erros[] = "Escrever um título é obrigatório.";
    }

    if (empty($prioridade)) {
        $erros[] = "Selecionar a prioridade é obrigatório.";
    }

    if (empty($responsavel)) {
        $erros[] = "Selecionar o responsável pela tarefa é obrigatório.";
    }

    if ($prazo) {
        $dataAtual = date('Y-m-d');
        if ($prazo < $dataAtual) {
            $erros[] = "O prazo final não pode ser uma data no passado.";
        }
    }

    if (!empty($erros)) {
        echo "<h1 style='color: red;background-color: white;'>Foram encontrados os seguintes erros:</h1>";
        echo "<ul style='color: red; background-color: white;'>";
        foreach ($erros as $erro) {
            echo "<li>" . htmlspecialchars($erro) . "</li>";
        }
        echo "</ul>";
        echo "<a href='../tarefas.html'>Retorne para a página principal</a>";
        exit;
    }

?>
