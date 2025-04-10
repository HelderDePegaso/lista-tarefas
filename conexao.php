<?php
$conn = new mysqli("localhost", "root", "", "lista_tarefa");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
