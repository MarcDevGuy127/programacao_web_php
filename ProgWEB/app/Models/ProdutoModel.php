<?php
// app/Model/ProdutoModel.php - Gerencia a persistência de dados de Produtos
namespace App\Model;

use App\Core\Database;
use PDO;
use PDOException;

class ProdutoModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * C - Create (Inserir um novo produto)
     * @param array $data Um array associativo com os dados do produto (nome, descricao, preco, estoque)
     * @return int|false O ID do produto inserido em caso de sucesso, ou false em caso de falha.
     */
    public function criarProduto($data)
    {
        $sql = "INSERT INTO Produtos (nome, descricao, preco, estoque) VALUES (:nome, :descricao, :preco, :estoque)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome', $data['nome']);
            $stmt->bindParam(':descricao', $data['descricao']);
            $stmt->bindParam(':preco', $data['preco']);
            $stmt->bindParam(':estoque', $data['estoque']);
            $stmt->execute();

            // Retorna o ID do último registro inserido
            // Para SQL Server, getLastInsertId pode não funcionar diretamente sem um nome de sequência.
            // Uma abordagem comum é usar OUTPUT INSERTED.id no SQL, mas para simplicidade, vamos usar o retorno da execução.
            // Se precisar do ID, uma consulta SELECT SCOPE_IDENTITY() ou @@IDENTITY após o INSERT é comum.
            // Para PDO_SQLSRV, lastInsertId() geralmente retorna o último ID gerado automaticamente.
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Em ambiente de produção, logar o erro em vez de exibi-lo
            error_log("Erro ao criar produto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * R - Read (Ler todos os produtos)
     * @return array Um array de arrays associativos com todos os produtos.
     */
    public function getTodosProdutos()
    {
        $sql = "SELECT id, nome, descricao, preco, estoque FROM Produtos";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter todos os produtos: " . $e->getMessage());
            return [];
        }
    }

    /**
     * R - Read (Ler um produto por ID)
     * @param int $id O ID do produto a ser buscado.
     * @return array|false Um array associativo com os dados do produto, ou false se não encontrado.
     */
    public function getProdutoById($id)
    {
        $sql = "SELECT id, nome, descricao, preco, estoque FROM Produtos WHERE id = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter produto por ID: " . $e->getMessage());
            return false;
        }
    }

    /**
     * U - Update (Atualizar um produto existente)
     * @param int $id O ID do produto a ser atualizado.
     * @param array $data Um array associativo com os novos dados do produto.
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function atualizarProduto($id, $data)
    {
        $sql = "UPDATE Produtos SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque WHERE id = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome', $data['nome']);
            $stmt->bindParam(':descricao', $data['descricao']);
            $stmt->bindParam(':preco', $data['preco']);
            $stmt->bindParam(':estoque', $data['estoque']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute(); // Retorna true em caso de sucesso
        } catch (PDOException $e) {
            error_log("Erro ao atualizar produto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * D - Delete (Deletar um produto)
     * @param int $id O ID do produto a ser deletado.
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function deletarProduto($id)
    {
        $sql = "DELETE FROM Produtos WHERE id = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute(); // Retorna true em caso de sucesso
        } catch (PDOException $e) {
            error_log("Erro ao deletar produto: " . $e->getMessage());
            return false;
        }
    }
}
