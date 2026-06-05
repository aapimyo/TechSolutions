<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../sistema/login.php"); exit(); }
include('../sistema/conexao.php');

$id = intval($_GET['id']);

// Impede que o usuário logado exclua a si próprio
if ($id !== $_SESSION['id']) {
    $delete = "DELETE FROM usuarios WHERE id = $id";
    mysqli_query($conn, $delete);
}

header("Location: cadastrar.php");
exit();
?>
