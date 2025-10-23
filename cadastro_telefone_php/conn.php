<?php
// conn.php — centraliza a conexão com o banco de dados

$dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
$usuario = "root";
$senha = "";

// caminho do arquivo de log
$arquivoLog = __DIR__ . '/erros.log';

try {
    // criando conexão ao PDO
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // registrando o erro em arquivo
    $mensagemErro = "[" . date('Y-m-d H:i:s') . "] ERRO DE CONEXÃO: " . $e->getMessage() . PHP_EOL;
    file_put_contents($arquivoLog, $mensagemErro, FILE_APPEND);

    // mensagem simples para o usuário
    echo "<p style='color:red; font-family: Arial;'>Não foi possível conectar ao banco de dados. Tente novamente mais tarde.</p>";
    exit;
}
?>
