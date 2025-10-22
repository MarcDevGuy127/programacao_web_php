<?php
// public/index.php - Front Controller

session_start(); // Inicia a sessão para mensagens de feedback

// Inclui o autoloader para carregar classes automaticamente
require_once __DIR__ . '/../app/Core/Autoloader.php';

use App\Controllers\ProdutoController; // Importa o Controller de Produto

// Obtém o caminho da requisição (ex: /produtos, /produtos/criar, /produtos/editar/1)
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseUrl = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$path = substr($requestUri, strlen($baseUrl));

// Remove barras extras e garante que começa com barra
$path = '/' . trim($path, '/');

// Mapeamento de rotas para Controllers e métodos
switch ($path) {
    case '/produtos':
        $controller = new ProdutoController();
        $controller->index();
        break;
    case '/produtos/criar':
        $controller = new ProdutoController();
        $controller->create();
        break;
    case '/produtos/salvar': // Ação para salvar um novo produto
        $controller = new ProdutoController();
        $controller->store();
        break;
    case '/produtos/atualizar': // Ação para atualizar um produto existente
        $controller = new ProdutoController();
        $controller->update();
        break;
    case '/produtos/excluir': // Ação para excluir um produto
        $controller = new ProdutoController();
        $controller->delete();
        break;
    default:
        // Gerencia rotas dinâmicas como /produtos/editar/{id}
        if (preg_match('/^\/produtos\/editar\/(\d+)$/', $path, $matches)) {
            $id = (int)$matches[1];
            $controller = new ProdutoController();
            $controller->edit($id);
        } else {
            // Rota não encontrada
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404 Not Found</h1>";
            echo "<p>A página que você está procurando não foi encontrada.</p>";
        }
        break;
}