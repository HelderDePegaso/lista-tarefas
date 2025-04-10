<?php
session_start();
if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

$nome = $_SESSION['nome'];


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Lista de Tarefas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body style="flex-direction: column">
    <div class="main-container">
        <div class="header">
            <h1>Minha Lista de Tarefas</h1>
            <div class="user-info">
                <span>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</span>
                <a href="logout.php">Sair</a>
            </div>
        </div>
        <form class="task-form" method="POST" action="adicionar.php">
            <input type="text" name="descricao" placeholder="Digite uma nova tarefa" required>
            <button type="submit">Adicionar</button>
        </form>
        
    </div>

    <div class="listagem">
        <ul>
            <?php
                $usuario_id = $_SESSION['usuario_id'];
                $result = $conn->query("SELECT * FROM tarefas WHERE usuario_id = $usuario_id");
                while ($tarefa = $result->fetch_assoc()):
                ?>
                    <li>
                        <span style="<?= $tarefa['concluida'] ? 'text-decoration: line-through;' : '' ?>">
                            <?= htmlspecialchars($tarefa['descricao']) ?>
                        </span>
                        <?php if (!$tarefa['concluida']): ?>
                            <a href="concluir.php?id=<?= $tarefa['id'] ?>">✔</a>
                        <?php endif; ?>
                        <a href="excluir.php?id=<?= $tarefa['id'] ?>">🗑</a>
                    </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
