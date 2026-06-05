<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../sistema/login.php"); exit(); }
include('../sistema/conexao.php');

$id = intval($_GET['id']);
$delete = "DELETE FROM tarefas WHERE id = $id";
mysqli_query($conn, $delete);

header("Location: listar.php");
exit();
?>
