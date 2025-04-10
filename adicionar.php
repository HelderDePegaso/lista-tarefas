<?php
session_start();
include 'conexao.php';

$descricao = $_POST['descricao'];
$usuario_id = $_SESSION['usuario_id'];


$conn->query("INSERT INTO tarefas (descricao, usuario_id) VALUES ('$descricao', $usuario_id)");
header("Location: index.php");
