<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        header("Location: login.php");
        include 'conexao.php';
        session_start();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
        
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
        
            if ($usuario = $resultado->fetch_assoc()) {
                if (password_verify($senha, $usuario['senha'])) {
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];
                    header("Location: index.php");
                } else {
                    echo "Senha incorreta.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
        }
        ?>
        
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link rel="stylesheet" href="estilo.css">
        </head>
        <body>
            <div class="container">
                <h2>Login</h2>
                <form method="POST">
                    <input type="email" name="email" placeholder="Seu e-mail" required><br>
                    <input type="password" name="senha" placeholder="Senha" required><br>
                    <button type="submit">Entrar</button>
                </form>
                <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
            </div>
        </body>
        </html>
        
    <?php
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
}
?>

<h2>Cadastro</h2>
<form method="POST">
    <input type="text" name="nome" placeholder="Seu nome" required><br>
    <input type="email" name="email" placeholder="Seu e-mail" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <button type="submit">Cadastrar</button>
</form>
<p>Já tem conta? <a href="login.php">Faça login</a></p>
