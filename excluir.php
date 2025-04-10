<?php
include 'conexao.php';

$id = $_GET['id'];
$conn->query("DELETE FROM tarefas WHERE id=$id");
header("Location: index.php");
