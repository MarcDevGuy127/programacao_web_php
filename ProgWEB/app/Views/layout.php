<?php
// Inicia o buffer de saída para capturar o conteúdo da view específica
ob_start();
$viewPath = ''; // Inicializa para evitar undefined variable
$title = $title ?? 'Meu CRUD MVC'; // Título padrão, se não definido pelo controller

// Inclui a view específica baseada na rota ou ação
// Por exemplo: if ($route == '/produtos') $viewPath = 'produtos/index.php';
// Este exemplo simples assume que a view é passada diretamente pelo controller
// $viewPath é definida no Controller antes de incluir layout.php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="/CRUD/public/css/style.css">
</head>

<body>
    <header>
        <nav>
            <a href="/CRUD/produtos">CRUD de Produtos</a>
        </nav>
    </header>

    <main class="container">
        <?php
        // Exibe mensagens de feedback (sucesso/erro)
        if (isset($_SESSION['message'])) {
            $messageType = $_SESSION['message']['type'] == 'success' ? 'success' : 'error';
            echo '<div class="message ' . $messageType . '">' . htmlspecialchars($_SESSION['message']['text']) . '</div>';
            unset($_SESSION['message']); // Limpa a mensagem após exibir
        }
        ?>
        <?php
        // A variável $content será definida nas views específicas
        // Ela contém o HTML específico da página (listagem, formulário, etc.)
        echo $content;
        ?>
    </main>

    <footer>
        <p>&copy;<?php echo date('Y'); ?> Seu Nome. Todos os direitos reservados.</p>
    </footer>
    <script src="/CRUD/public/js/script.js"></script>
</body>

</html>