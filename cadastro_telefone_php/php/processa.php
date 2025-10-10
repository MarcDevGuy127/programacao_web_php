 <?php
    // Conexão com o banco usando PDO
    $dsn = "mysql:host=localhost;dbname=meubanco2;charset=utf8";
    $usuario = "root";
    $senha = ""; // ajuste conforme o seu ambiente
    try {
        $pdo = new PDO($dsn, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Receber dados do formulário
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
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