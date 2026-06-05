<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../sistema/login.php"); exit(); }
include('../sistema/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $data_tarefa = mysqli_real_escape_string($conn, $_POST['data_tarefa']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $insert = "INSERT INTO tarefas (titulo, descricao, data_tarefa, status) VALUES ('$titulo', '$descricao', '$data_tarefa', '$status')";
    mysqli_query($conn, $insert);
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>TechSolutions - Nova Tarefa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'DM Sans', sans-serif; background: #0a0f1a; color: #f1f5f9; }</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-xl bg-[#1a2332] border border-[#1e293b] rounded-2xl p-6 shadow-2xl">
        <h3 class="font-semibold text-lg mb-4 text-[#10b981] font-['Space_Grotesk']">Nova Tarefa de Serviço</h3>
        <form action="cadastrar.php" method="POST" class="space-y-4">
            <div>
                <label class="block mb-1.5 text-xs font-medium text-gray-400">Título do Serviço</label>
                <input type="text" name="titulo" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
            </div>
            <div>
                <label class="block mb-1.5 text-xs font-medium text-gray-400">Descrição Detalhada</label>
                <textarea name="descricao" rows="3" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981] resize-none"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1.5 text-xs font-medium text-gray-400">Data de Execução</label>
                    <input type="date" name="data_tarefa" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
                </div>
                <div>
                    <label class="block mb-1.5 text-xs font-medium text-gray-400">Status Inicial</label>
                    <select name="status" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
                        <option value="Pendente">Pendente</option>
                        <option value="Em andamento">Em andamento</option>
                        <option value="Concluído">Concluído</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <a href="listar.php" class="px-5 py-2.5 bg-transparent border border-[#1e293b] text-gray-400 rounded-xl font-medium hover:text-white transition-colors">Voltar</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#10b981] to-[#059669] text-white font-semibold rounded-xl shadow-md">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>
