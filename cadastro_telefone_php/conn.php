<?php
// escolha do banco: MySQL ou SQLite
$banco = 'sqlite'; // 'mysql' ou 'sqlite'

// caminho do arquivo de log
$arquivoLog = __DIR__ . '/erros.log';

try {
    if ($banco === 'mysql') {
        $dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
        $usuario = "root";
        $senha = "";
        $pdo = new PDO($dsn, $usuario, $senha);
    } elseif ($banco === 'sqlite') {
        // SQLite no arquivo 'exemplo_sqlite.db' dentro da pasta do projeto
        $arquivoDB = __DIR__ . '/exemplo_sqlite.db';
        $pdo = new PDO("sqlite:" . $arquivoDB);
    } else {
        throw new Exception("Banco não suportado");
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    // grava no log
    $mensagemErro = "[" . date('Y-m-d H:i:s') . "] ERRO DE CONEXÃO: " . $e->getMessage() . PHP_EOL;
    file_put_contents($arquivoLog, $mensagemErro, FILE_APPEND);

    // mensagem
    echo "<p style='color:red; font-family: Arial;'>Não foi possível conectar ao banco. Tente novamente mais tarde.</p>";
    exit;
}
?>