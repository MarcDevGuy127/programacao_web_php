<?php
$alunos = [
  ["nome" => "Maria", "nota" => 8],
  ["nome" => "João", "nota" => 6],
  ["nome" => "Ana", "nota" => 9]
 ];
O código PHP para montar a tabela seria:
 echo "<table border='1'>";
 echo 
"<tr><th>Nome</th><th>Nota</th></tr>";
 foreach ($alunos as $aluno) {
    echo "<tr>";
    echo "<td>{$aluno['nome']}</td>";
    echo "<td>{$aluno['nota']}</td>";
    echo "</tr>";
 }
 echo "</table>";
?>