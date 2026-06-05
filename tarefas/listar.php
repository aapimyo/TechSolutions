<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../sistema/login.php"); exit(); }
include('../sistema/conexao.php');

$search = "";
if (isset($_GET['busca'])) {
    $search = mysqli_real_escape_string($conn, $_GET['busca']);
    $query = "SELECT * FROM tarefas WHERE titulo LIKE '%$search%' OR descricao LIKE '%$search%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM tarefas ORDER BY id DESC";
}

$tarefas = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>TechSolutions - Tarefas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #0a0f1a; --bg-elevated: #111827; --bg-card: #1a2332; --fg: #f1f5f9; --fg-muted: #94a3b8; --accent: #10b981; --border: #1e293b; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--fg); }
        h1, h2, h3 { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex">
    <aside class="w-[280px] bg-gradient-to-b from-[#111827] to-[#1a2332] border-r border-[#1e293b] p-6 flex flex-col fixed h-full">
        <div class="flex items-center gap-3 pb-6 mb-8 border-b border-[#1e293b]">
            <div class="w-10 h-10 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div>
            <div><h2 class="font-bold text-lg leading-tight">TechSolutions</h2><p class="text-xs text-gray-500">Sistema Interno</p></div>
        </div>
        <nav class="space-y-2 flex-1">
            <a href="../sistema/dashboard.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-emerald-500/5 hover:text-[#10b981] transition-all">Dashboard</a>
            <a href="../usuarios/cadastrar.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-emerald-500/5 hover:text-[#10b981] transition-all">Usuários</a>
            <a href="listar.php" class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-500/10 text-[#10b981] border-l-3 border-[#10b981] font-medium">Tarefas</a>
        </nav>
        <a href="../sistema/logout.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-red-500/10 hover:text-red-400 transition-all mt-auto">Sair</a>
    </aside>

    <main class="flex-1 ml-[280px] p-8 space-y-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-bold">Gerenciar Tarefas</h1>
                <p class="text-sm text-gray-500">Acompanhe e configure a execução das demandas</p>
            </div>
            <a href="cadastrar.php" class="px-5 py-2.5 bg-gradient-to-r from-[#10b981] to-[#059669] text-white font-semibold rounded-xl text-sm shadow-lg shadow-emerald-500/10 flex items-center gap-2">
                Nova Tarefa
            </a>
        </div>

        <div class="bg-[#1a2332] border border-[#1e293b] p-4 rounded-xl max-w-md">
            <form action="listar.php" method="GET" class="flex gap-2">
                <input type="text" name="busca" value="<?php echo htmlspecialchars($search); ?>" placeholder="Buscar tarefas..." class="flex-1 p-2 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-sm text-white focus:outline-none focus:border-[#10b981]">
                <button type="submit" class="px-4 py-2 bg-[#111827] border border-[#1e293b] rounded-xl text-sm font-medium hover:text-[#10b981] transition-colors">Filtrar</button>
            </form>
        </div>

        <div class="bg-[#1a2332] border border-[#1e293b] rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm">
                    <thead>
                        <tr class="bg-[#111827] text-gray-400 font-semibold uppercase text-xs border-b border-[#1e293b]">
                            <th class="p-4 pl-6">ID</th>
                            <th class="p-4">Título</th>
                            <th class="p-4">Descrição</th>
                            <th class="p-4">Data</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 pr-6 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1e293b]">
                        <?php while($task = mysqli_fetch_assoc($tarefas)): ?>
                        <tr class="hover:bg-emerald-500/[0.02] transition-colors">
                            <td class="p-4 pl-6 font-mono text-gray-500">#<?php echo $task['id']; ?></td>
                            <td class="p-4 font-medium"><?php echo $task['titulo']; ?></td>
                            <td class="p-4 text-gray-400 max-w-xs truncate"><?php echo $task['descricao']; ?></td>
                            <td class="p-4 text-gray-400"><?php echo date('d/m/Y', strtotime($task['data_tarefa'])); ?></td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo $task['status'] == 'Concluído' ? 'bg-emerald-500/15 text-[#10b981]' : ($task['status'] == 'Em andamento' ? 'bg-blue-500/15 text-blue-400' : 'bg-amber-500/15 text-amber-400'); ?>">
                                    <?php echo $task['status']; ?>
                                </span>
                            </td>
                            <td class="p-4 pr-6 text-right space-x-2">
                                <a href="editar.php?id=<?php echo $task['id']; ?>" class="inline-flex w-8 h-8 rounded-lg border border-[#1e293b] items-center justify-center text-gray-400 hover:text-[#10b981] hover:border-[#10b981] transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <a href="excluir.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Excluir esta tarefa definitivamente?')" class="inline-flex w-8 h-8 rounded-lg border border-[#1e293b] items-center justify-center text-gray-400 hover:text-red-400 hover:border-red-500/30 hover:bg-red-500/10 transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>