<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include('conexao.php');

/** @var mysqli @conn */

// Consultas de métricas
$totalUsers = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM usuarios")) ?: 0;
$totalTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tarefas")) ?: 0;
$pendingTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tarefas WHERE status = 'Pendente'")) ?: 0;
$completedTasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tarefas WHERE status = 'Concluído'")) ?: 0;

$recentesQuery = mysqli_query($conn, "SELECT titulo, data_tarefa, status FROM tarefas ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechSolutions - Dashboard</title>
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
            <div class="w-10 h-10 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <div>
                <h2 class="font-bold text-lg leading-tight">TechSolutions</h2>
                <p class="text-xs text-gray-500">Sistema Interno</p>
            </div>
        </div>
        <nav class="space-y-2 flex-1">
            <a href="dashboard.php" class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-500/10 text-[#10b981] border-l-3 border-[#10b981] font-medium">Dashboard</a>
            <a href="../usuarios/cadastrar.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-emerald-500/5 hover:text-[#10b981] transition-all">Usuários</a>
            <a href="../tarefas/listar.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-emerald-500/5 hover:text-[#10b981] transition-all">Tarefas</a>
        </nav>
        <a href="logout.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-red-500/10 hover:text-red-400 transition-all mt-auto">Sair</a>
    </aside>

    <main class="flex-1 ml-[280px] p-8">
        <div class="flex justify-between items-center pb-6 mb-8 border-b border-[#1e293b]">
            <div>
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="text-sm text-gray-500"><?php echo date('d \d\e F \d\e Y'); ?></p>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-[#10b981] to-[#3b82f6] rounded-xl flex items-center justify-center font-bold text-white"><?php echo strtoupper(substr($_SESSION['nome'], 0, 1)); ?></div>
                <div>
                    <p class="font-semibold text-sm leading-tight"><?php echo $_SESSION['nome']; ?></p>
                    <p class="text-xs text-gray-500">Administrador</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#1a2332] border border-[#1e293b] p-6 rounded-2xl hover:border-[#10b981] transition-all">
                <div class="text-2xl font-bold mb-1"><?php echo $totalUsers; ?></div>
                <p class="text-gray-500 text-sm">Usuários Cadastrados</p>
            </div>
            <div class="bg-[#1a2332] border border-[#1e293b] p-6 rounded-2xl hover:border-[#10b981] transition-all">
                <div class="text-2xl font-bold mb-1"><?php echo $totalTasks; ?></div>
                <p class="text-gray-500 text-sm">Total de Tarefas</p>
            </div>
            <div class="bg-[#1a2332] border border-[#1e293b] p-6 rounded-2xl hover:border-[#10b981] transition-all">
                <div class="text-2xl font-bold mb-1 text-amber-500"><?php echo $pendingTasks; ?></div>
                <p class="text-gray-500 text-sm">Tarefas Pendentes</p>
            </div>
            <div class="bg-[#1a2332] border border-[#1e293b] p-6 rounded-2xl hover:border-[#10b981] transition-all">
                <div class="text-2xl font-bold mb-1 text-emerald-500"><?php echo $completedTasks; ?></div>
                <p class="text-gray-500 text-sm">Tarefas Concluídas</p>
            </div>
        </div>

        <div class="bg-[#1a2332] border border-[#1e293b] rounded-2xl overflow-hidden">
            <div class="p-5 border-b border-[#1e293b]"><h3 class="font-semibold text-lg">Tarefas Recentes</h3></div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm">
                    <thead>
                        <tr class="bg-[#111827] text-gray-400 font-semibold uppercase text-xs tracking-wider border-b border-[#1e293b]">
                            <th class="p-4 pl-6">Título</th>
                            <th class="p-4">Data</th>
                            <th class="p-4 pr-6">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1e293b]">
                        <?php while($task = mysqli_fetch_assoc($recentesQuery)): ?>
                        <tr class="hover:bg-emerald-500/[0.02] transition-colors">
                            <td class="p-4 pl-6 font-medium"><?php echo $task['titulo']; ?></td>
                            <td class="p-4 text-gray-400"><?php echo date('d/m/Y', strtotime($task['data_tarefa'])); ?></td>
                            <td class="p-4 pr-6">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo $task['status'] == 'Concluído' ? 'bg-emerald-500/15 text-[#10b981]' : ($task['status'] == 'Em andamento' ? 'bg-blue-500/15 text-blue-400' : 'bg-amber-500/15 text-amber-400'); ?>">
                                    <?php echo $task['status']; ?>
                                </span>
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
 
