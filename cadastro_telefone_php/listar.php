 <?php
    $dsn = "mysql:host=localhost;dbname=exemplo_pdo;charset=utf8";
    $usuario = "root";
    $senha = "";
    try {
        $pdo = new PDO($dsn, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Consulta usando retorno como array associativo
        $stmt = $pdo->query("SELECT * FROM usuarios");
        $usuariosAssoc = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Consulta usando retorno como objeto
        $stmt2 = $pdo->query("SELECT * FROM usuarios");
        $usuariosObj = $stmt2->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
        die();
    }
    ?>
 <!DOCTYPE html>
 <html lang="pt-br">

 <head>
     <meta charset="UTF-8">
     <title>Usuários Cadastrados</title>
     <style>
         table {
             border-collapse: collapse;
             width: 60%;
             margin: auto;
             background: #fff;
         }

         th,
         td {
             border: 1px solid #ccc;
             padding: 7px 12px;
         }

         th {
             background: #2477ff;
             color: #fff;
         }

         tr:nth-child(even) {
             background: #f1f1f1;
         }

         caption {
             font-weight: bold;
             font-size: 1.2em;
             margin-bottom: 8px;
         }

         .container {
             width: 80%;
             margin: auto;
         }
     </style>
 </head>

 <body>
     <div class="container">
         <h2>Usuários (FETCH_ASSOC)</h2>
         <table>
             <caption>Exibição como Array Associativo</caption>
             <tr>
                 <th>ID</th>
                 <th>Nome</th>
                 <th>E-mail</th>
                 <th>Telefone</th>
             </tr>
             <?php foreach ($usuariosAssoc as $u): ?>
                 <tr>
                     <td><?= $u['id'] ?></td>
                     <td><?= $u['nome'] ?></td>
                     <td><?= $u['email'] ?></td>
                     <td><?= $u['telefone'] ?></td>
                 </tr>
             <?php endforeach; ?>
         </table>
         <h2 style="margin-top:40px;">Usuários (FETCH_OBJ)</h2>
         <table>
             <caption>Exibição como Objeto</caption>
             <tr>
                 <th>ID</th>
                 <th>Nome</th>
                 <th>E-mail</th>
                 <th>Telefone</th>
             </tr>
             <?php foreach ($usuariosObj as $u): ?>
                 <tr>
                     <td><?= $u->id ?></td>
                     <td><?= $u->nome ?></td>
                     <td><?= $u->email ?></td>
                     <td><?= $u->telefone ?></td>
                 </tr>
             <?php endforeach; ?>
         </table>
         <div style="text-align:center; margin-top:30px;">
             <a href="index.html">Voltar para o cadastro</a>
         </div>
     </div>
 </body>

 </html>