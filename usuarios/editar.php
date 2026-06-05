<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../sistema/login.php"); exit(); }
include('../sistema/conexao.php');

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $update = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha' WHERE id=$id";
    } else {
        $update = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$id";
    }
    
    mysqli_query($conn, $update);
    header("Location: cadastrar.php");
    exit();
}

$busca = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = $id");
$user = mysqli_fetch_assoc($busca);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>TechSolutions - Editar Usuário</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #0a0f1a; color: #f1f5f9; }
        h1, h3 { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-lg bg-[#1a2332] border border-[#1e293b] rounded-2xl p-6 shadow-2xl">
        <h3 class="font-semibold text-lg mb-4 text-[#10b981]">Editar Dados do Usuário</h3>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST" class="space-y-4">
            <div>
                <label class="block mb-1.5 text-xs font-medium text-gray-400">Nome Completo</label>
                <input type="text" name="nome" value="<?php echo $user['nome']; ?>" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
            </div>
            <div>
                <label class="block mb-1.5 text-xs font-medium text-gray-400">Email</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
            </div>
            <div>
                <label class="block mb-1.5 text-xs font-medium text-gray-400">Nova Senha (Deixe vazio para manter)</label>
                <input type="password" name="senha" class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <a href="cadastrar.php" class="px-5 py-2.5 bg-transparent border border-[#1e293b] text-gray-400 rounded-xl font-medium hover:text-white transition-colors">Cancelar</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#10b981] to-[#059669] text-white font-semibold rounded-xl">Atualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
