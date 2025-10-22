<?php
    // Conexão com o banco usando PDO
    $dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
    $usuario = "root";
    $senha = ""; // ajuste conforme o seu ambiente
    try {
        $pdo = new PDO($dsn, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Receber dados do formulário
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);
        
        // Verificar se o e-mail já está cadastrado
        $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $verifica->bindParam(':email', $email);
        $verifica->execute();

        if ($verifica->rowCount() > 0) {
            echo "<script>
                alert('Este e-mail já está cadastrado! Use outro.');
                window.location.href = 'index.html';
            </script>";
            exit; // encerra a execução
        }
        // Inserir dados usando prepared statement
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone) VALUES (:nome, :email, :telefone)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!<br>";
            echo '<a href="listar.php">Ver lista de usuários</a>';
        } else {
            echo "Erro ao cadastrar";
        }

    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
?>