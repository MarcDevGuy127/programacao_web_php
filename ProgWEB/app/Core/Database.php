<?php
// app/Core/Database.php - Classe para gerenciar a conexão com o banco de dados
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $conn;

    private $serverName = "localhost"; // Ou o nome/IP do servidor SQL Server
    private $connectionOptions = [
        "Database" => "MeuSistemaWeb", // Nome do seu banco de dados
        "Uid" => "sa",                 // Usuário do SQL Server
        "PWD" => "sua_senha_segura",   // Senha do SQL Server (altere!)
        "CharacterSet" => "UTF-8"
    ];

    private function __construct()
    {
        try {
            // A string de conexão para SQL Server com PDO_SQLSRV
            $dsn = "sqlsrv:Server=" . $this->serverName . ";Database=" . $this->connectionOptions["Database"];
            $this->conn = new PDO($dsn, $this->connectionOptions["Uid"], $this->connectionOptions["PWD"]);

            // Define o modo de erro para lançar exceções
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Define o modo de fetch padrão para associativo
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
