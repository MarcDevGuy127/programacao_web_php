<?php
namespace App\Models;

use PDO;
use PDOException;

class Database {
    private static $pdo;

    public static function getConnection() {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/app.php'; // Carrega as configurações

            $host = $config['database']['host'];
            $dbName = $config['database']['database_name'];
            $user = $config['database']['user'];
            $password = $config['database']['password'];

            // DSN para SQL Server (PDO_SQLSRV)
            $dsn = "sqlsrv:Server=$host;Database=$dbName";

            try {
                self::$pdo = new PDO($dsn, $user, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Retorna array associativo por padrão

                // print "Conexão com SQL Server estabelecida com sucesso!\n"; // Para teste

            } catch (PDOException $e) {
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}