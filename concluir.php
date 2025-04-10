<?php
include 'conexao.php';

$id = $_GET['id'];
$conn->query("UPDATE tarefas SET concluida=1 WHERE id=$id");
header("Location: index.php");
