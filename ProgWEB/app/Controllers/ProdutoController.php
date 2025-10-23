<?php
// app/Controller/ProdutoController.php - Lógica para manipular requisições relacionadas a produtos
namespace App\Controller;

use App\Model\ProdutoModel; // Importa o nosso Model de Produtos

class ProdutoController
{
    private $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
    }

    // Método para exibir a lista de produtos (R - Read All)
    public function index()
    {
        $produtos = $this->produtoModel->getTodosProdutos();

        // Renderiza a View de listagem de produtos, passando os dados
        // **IMPORTANTE**: Ajuste o caminho da view conforme sua estrutura
        $viewPath = __DIR__ . '/../Views/produtos/index.php';
        if (file_exists($viewPath)) {
            // Se você usa um layout, pode incluí-lo aqui ou dentro da view 'index.php'
            // require_once __DIR__ . '/../Views/layout.php'; // Exemplo de layout
            include $viewPath; // Inclui a view que vai usar a variável $produtos
        } else {
            echo "Erro: View de listagem de produtos não encontrada.";
        }
    }

    // Método para exibir o formulário de criação de produto (GET) e processar a submissão (POST)
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // C - Create (Processar submissão do formulário)
            $data = [
                'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
                'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING),
                'preco' => filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT),
                'estoque' => filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT)
            ];

            // Basic validation
            if (!$data['nome'] || $data['preco'] === false || $data['estoque'] === false) {
                // Erro de validação, redirecionar de volta ao formulário ou exibir mensagem
                echo "Dados inválidos para criar produto.";
                return;
            }

            $produtoId = $this->produtoModel->criarProduto($data);
            if ($produtoId) {
                // Sucesso: redireciona para a lista de produtos ou página do novo produto
                header('Location: /CRUD/produtos'); // Assumindo que /CRUD/produtos lista os produtos
                exit();
            } else {
                echo "Erro ao criar produto no banco de dados.";
            }
        } else {
            // Exibir formulário de criação (GET)
            $viewPath = __DIR__ . '/../Views/produtos/criar.php';
            if (file_exists($viewPath)) {
                include $viewPath;
            } else {
                echo "Erro: View de criação de produto não encontrada.";
            }
        }
    }

    // Método para exibir formulário de edição (GET) e processar a submissão (POST)
    // Ex: /CRUD/produtos/editar/1
    public function editar($id)
    {
        $produto = $this->produtoModel->getProdutoById($id);

        if (!$produto) {
            echo "Produto não encontrado.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // U - Update (Processar submissão do formulário)
            $data = [
                'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
                'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING),
                'preco' => filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT),
                'estoque' => filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT)
            ];

            if ($this->produtoModel->atualizarProduto($id, $data)) {
                header('Location: /CRUD/produtos');
                exit();
            } else {
                echo "Erro ao atualizar produto.";
            }
        } else {
            // Exibir formulário de edição (GET), preenchido com os dados do produto
            $viewPath = __DIR__ . '/../Views/produtos/editar.php';
            if (file_exists($viewPath)) {
                include $viewPath; // A view 'editar.php' precisará da variável $produto
            } else {
                echo "Erro: View de edição de produto não encontrada.";
            }
        }
    }

    // Método para deletar um produto (D - Delete)
    // Ex: /CRUD/produtos/deletar/1 (geralmente via POST para segurança, ou link com confirmação)
    public function deletar($id)
    {
        // Para uma operação de deleção, é boa prática usar um método POST ou solicitar confirmação.
        // Aqui, para simplicidade, estamos assumindo que o ID vem da URL e a ação de deletar é direta.
        // Em uma aplicação real, você confirmaria via formulário POST ou JS.

        if ($this->produtoModel->deletarProduto($id)) {
            header('Location: /CRUD/produtos');
            exit();
        } else {
            echo "Erro ao deletar produto.";
        }
    }

    // Método para exibir detalhes de um produto (R - Read One)
    // Ex: /CRUD/produtos/ver/1
    public function ver($id)
    {
        $produto = $this->produtoModel->getProdutoById($id);

        if (!$produto) {
            echo "Produto não encontrado.";
            return;
        }

        $viewPath = __DIR__ . '/../Views/produtos/ver.php';
        if (file_exists($viewPath)) {
            include $viewPath; // A view 'ver.php' precisará da variável $produto
        } else {
            echo "Erro: View de detalhes do produto não encontrada.";
        }
    }
}