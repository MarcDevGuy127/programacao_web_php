<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_tarefa = $_POST['titulo_tarefa'];
    $descricao = $_POST['descricao'];
    $prioridade = $_POST['prioridade'];
    $responsavel = $_POST['responsavel'];
    $prazo = $_POST['prazo'];

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

    echo "<body style='background-color: cornflowerblue;'>";
    echo "<h1 style='color: green; background-color: white;'>Tarefa cadastrada com sucesso!</h1>";
    echo '<textarea rows="16" cols="40" readonly>';
    echo "Título da Tarefa: " . htmlspecialchars($titulo_tarefa) . "\n";
    echo "Descrição: " . htmlspecialchars($descricao) . "\n";
    echo "Prazo: " . htmlspecialchars($prazo) . "\n";
    echo "Prioridade: " . htmlspecialchars($prioridade) . "\n";
    echo "Responsável: " . htmlspecialchars($responsavel) . "\n";
    echo "</textarea>";
    echo "</body>";
}
?>
