<?php


//Exercicio 1
$alunos = [
    ["nome" => "Maria", "idade" => 14, "nota" => 8, "curso" => 'Engenharia'],
    ["nome" => "João", "idade" => 21, "nota" => 6, "curso" => 'Administração'],
    ["nome" => "Ana", "idade" => 22, "nota" => 9, "curso" => 'Psicologia']
];

//Tabela Exercicio 1
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $idade = htmlspecialchars($_POST['idade']);
    $nota = htmlspecialchars($_POST['nota']);
    $curso = htmlspecialchars($_POST['curso']);

    echo "<!DOCTYPE html>";
    echo "<html><head><title>Tabela de Alunos</title></head><body>";
    echo "<h1>Tabela de Alunos Recebidos</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Nome</th><th>Idade</th><th>Curso</th><th>Nota</th></tr>";
    foreach ($alunos as $aluno) {
        echo "<tr>";
        echo "<td>{$aluno['nome']}</td>";
        echo "<td>{$aluno['idade']}</td>";
        echo "<td>{$aluno['curso']}</td>";
        echo "<td>{$aluno['nota']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</body></html>";
}

//Exercicio 2

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $idade = $_POST['idade'];
    $nota = $_POST['nota'];

    $dados[] = [
        'nome' => $nome,
        'curso' => $curso,
        'idade' => $idade,
        'nota' => $nota
    ];

    echo "<h1>Dados Cadastrados</h1>";
    echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>Curso</th>
                <th>Idade</th>
                <th>Nota</th>
            </tr>";

    foreach ($dados as $dado) {
        echo "<tr>
                <td>{$dado['nome']}</td>
                <td>{$dado['curso']}</td>
                <td>{$dado['idade']}</td>
                <td>{$dado['nota']}</td>
              </tr>";
    }

    echo "</table>";
}
?>