<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Minha Lista de Tarefas</h1>

    <p>Bem-vindo, <?= $_SESSION['nome'] ?>! <a href="logout.php">Sair</a></p>

    <form action="adicionar.php" method="POST">
        <input type="text" name="descricao" placeholder="Digite uma nova tarefa" required><br>
        <button type="submit">Adicionar</button>
    </form>

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
</body>
</html>
