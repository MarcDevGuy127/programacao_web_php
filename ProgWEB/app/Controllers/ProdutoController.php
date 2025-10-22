<?php
namespace App\Controllers;

use App\Models\Produto; // Importa a classe Produto

class ProdutoController {
    private $produtoModel;

    public function __construct() {
        $this->produtoModel = new Produto(); // Instancia o Model Produto
    }

    // Exibe a lista de produtos (Operação Read All)
    public function index() {
        $produtos = $this->produtoModel->getAll();
        $title = 'Lista de Produtos';
        // Inclui o layout e a view específica
        require_once __DIR__ . '/../Views/layout.php';
    }

    // Exibe o formulário para criar um novo produto (Operação Create)
    public function create() {
        $title = 'Adicionar Produto';
        require_once __DIR__ . '/../Views/layout.php';
    }

    // Processa o formulário de criação e salva o produto (Operação Create)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = htmlspecialchars(trim($_POST['nome']));
            $descricao = htmlspecialchars(trim($_POST['descricao']));
            $preco = filter_var($_POST['preco'], FILTER_VALIDATE_FLOAT);

            if (empty($nome) || $preco === false || $preco <= 0) {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Nome e preço válido são obrigatórios.'];
            } else {
                if ($this->produtoModel->create($nome, $descricao, $preco)) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Produto criado com sucesso!'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro ao criar produto.'];
                }
            }
            header('Location: /CRUD/produtos'); // Redireciona para a lista
            exit();
        }
        header('Location: /CRUD/produtos/criar'); // Se não for POST, redireciona para o formulário
        exit();
    }

    // Exibe o formulário de edição para um produto específico (Operação Update)
    public function edit($id) {
        $produto = $this->produtoModel->getById($id);
        if (!$produto) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Produto não encontrado.'];
            header('Location: /CRUD/produtos');
            exit();
        }
        $title = 'Editar Produto';
        require_once __DIR__ . '/../Views/layout.php';
    }

    // Processa o formulário de edição e atualiza o produto (Operação Update)
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            $nome = htmlspecialchars(trim($_POST['nome']));
            $descricao = htmlspecialchars(trim($_POST['descricao']));
            $preco = filter_var($_POST['preco'], FILTER_VALIDATE_FLOAT);

            if (empty($nome) || $preco === false || $preco <= 0 || $id === false) {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Dados inválidos para atualização.'];
            } else {
                if ($this->produtoModel->update($id, $nome, $descricao, $preco)) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Produto atualizado com sucesso!'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro ao atualizar produto.'];
                }
            }
            header('Location: /CRUD/produtos');
            exit();
        }
        header('Location: /CRUD/produtos'); // Redireciona para a lista se não for POST
        exit();
    }

    // Exclui um produto (Operação Delete)
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

            if ($id === false) {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'ID de produto inválido para exclusão.'];
            } else {
                if ($this->produtoModel->delete($id)) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Produto excluído com sucesso!'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro ao excluir produto.'];
                }
            }
            header('Location: /CRUD/produtos');
            exit();
        }
        header('Location: /CRUD/produtos'); // Redireciona para a lista se não for POST
        exit();
    }
}
