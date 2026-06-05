<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../sistema/login.php"); exit(); }
include('../sistema/conexao.php');

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $data_tarefa = mysqli_real_escape_string($conn, $_POST['data_tarefa']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $update = "UPDATE tarefas SET titulo='$titulo', descricao='$descricao', data_tarefa='$data_tarefa', status='$status' WHERE id=$id";
    mysqli_query($conn, $update);
    header("Location: listar.php");
    exit();
}

$busca = mysqli_query($conn, "SELECT * FROM tarefas WHERE id = $id");
$task = mysqli_fetch_assoc($busca);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>TechSolutions - Editar Tarefa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'DM Sans', sans-serif; background: #0a0f1a; color: #f1f5f9; }</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-xl bg-[#1a2332] border border-[#1e293b] rounded-2xl p-6 shadow-2xl">
        <h3 class="font-semibold text-lg mb-4 text-[#10b981] font-['Space_Grotesk']">Modificar Cadastro de Tarefa</h3>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST" class="space-y-4">
            <div>
                <label class="block mb-1.5 text-xs font-medium text-gray-400">Título</label>
                <input type="text" name="titulo" value="<?php echo $task['titulo']; ?>" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
            </div>
            <div>
                <label class="block mb-1.5 text-xs font-medium text-gray-400">Descrição</label>
                <textarea name="descricao" rows="3" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981] resize-none"><?php echo $task['descricao']; ?></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1.5 text-xs font-medium text-gray-400">Data de Execução</label>
                    <input type="date" name="data_tarefa" value="<?php echo $task['data_tarefa']; ?>" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
                </div>
                <div>
                    <label class="block mb-1.5 text-xs font-medium text-gray-400">Status</label>
                    <select name="status" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
                        <option value="Pendente" <?php echo $task['status'] == 'Pendente' ? 'selected' : ''; ?>>Pendente</option>
                        <option value="Em andamento" <?php echo $task['status'] == 'Em andamento' ? 'selected' : ''; ?>>Em andamento</option>
                        <option value="Concluído" <?php echo $task['status'] == 'Concluído' ? 'selected' : ''; ?>>Concluído</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <a href="listar.php" class="px-5 py-2.5 bg-transparent border border-[#1e293b] text-gray-400 rounded-xl font-medium hover:text-white transition-colors">Cancelar</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#10b981] to-[#059669] text-white font-semibold rounded-xl">Atualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
