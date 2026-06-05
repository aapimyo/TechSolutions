<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    $query = "SELECT id, nome, senha FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conn, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        // Verifica se a senha confere (compatível com plain text ou password_verify)
        if ($senha === $usuario['senha'] || password_verify($senha, $usuario['senha'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: dashboard.php");
            exit();
        }
    }
    header("Location: login.php?erro=1");
    exit();
}
?>
