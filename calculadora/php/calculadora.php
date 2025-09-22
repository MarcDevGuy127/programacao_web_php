<?php
if (isset($_POST["numero1"]) && isset($_POST["numero2"])) {
    $numero1 = floatval($_POST["numero1"]);
    $numero2 = floatval($_POST["numero2"]);

    $soma          = $numero1 + $numero2;
    $subtracao     = $numero1 - $numero2;
    $multiplicacao = $numero1 * $numero2;
    $divisao       = ($numero2 != 0) ? $numero1 / $numero2 : "Divisão por zero!";
    $resto         = ($numero2 != 0) ? $numero1 % $numero2 : "Não definido";
    $potencia      = $numero1 ** $numero2; 

    echo "
    <div class='resultado'>
        <h2>Resultados:</h2>
        <p>{$numero1} + {$numero2} = {$soma}</p>
        <p>{$numero1} - {$numero2} = {$subtracao}</p>
        <p>{$numero1} * {$numero2} = {$multiplicacao}</p>
        <p>{$numero1} / {$numero2} = {$divisao}</p>
        <p>{$numero1} % {$numero2} = {$resto}</p>
        <p>{$numero1} ** {$numero2} = {$potencia}</p>
    </div>
    ";
} else {
    echo "<p style='color:red;'>Por favor, insira dois números.</p>";
}
?>