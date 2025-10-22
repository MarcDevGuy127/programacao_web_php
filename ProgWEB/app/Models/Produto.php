<?php
namespace App\Models;

use PDO;
use PDOException;

class Produto {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // C - Create
    public function create($nome, $descricao, $preco) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Produtos (Nome, Descricao, Preco) VALUES (:nome, :descricao, :preco)");
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR); // Use PARAM_STR para DECIMAL
            return $stmt->execute();
        } catch (PDOException $e) {
            // Logar o erro (para produção)
            // file_put_contents('error.log', $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }
    }

    // R - Read All
    public function getAll() {
        $stmt = $this->pdo->query("SELECT Id, Nome, Descricao, Preco FROM Produtos ORDER BY Id DESC");
        return $stmt->fetchAll();
    }

    // R - Read One
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT Id, Nome, Descricao, Preco FROM Produtos WHERE Id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // U - Update
    public function update($id, $nome, $descricao, $preco) {
        try {
            $stmt = $this->pdo->prepare("UPDATE Produtos SET Nome = :nome, Descricao = :descricao, Preco = :preco WHERE Id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // D - Delete
    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Produtos WHERE Id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
