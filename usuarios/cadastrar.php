<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../sistema/login.php"); exit(); }
include('../sistema/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $insert = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    mysqli_query($conn, $insert);
    header("Location: cadastrar.php");
    exit();
}

$usuarios = mysqli_query($conn, "SELECT id, nome, email FROM usuarios ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>TechSolutions - Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #0a0f1a; --bg-elevated: #111827; --bg-card: #1a2332; --fg: #f1f5f9; --fg-muted: #94a3b8; --accent: #10b981; --border: #1e293b; --danger: #ef4444;}
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
            <a href="cadastrar.php" class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-500/10 text-[#10b981] border-l-3 border-[#10b981] font-medium">Usuários</a>
            <a href="../tarefas/listar.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-emerald-500/5 hover:text-[#10b981] transition-all">Tarefas</a>
        </nav>
        <a href="../sistema/logout.php" class="flex items-center gap-3 p-3.5 rounded-xl text-gray-400 hover:bg-red-500/10 hover:text-red-400 transition-all mt-auto">Sair</a>
    </aside>

    <main class="flex-1 ml-[280px] p-8 space-y-8">
        <div>
            <h1 class="text-2xl font-bold">Gerenciar Usuários</h1>
            <p class="text-sm text-gray-500">Cadastre e gerencie os acessos do sistema</p>
        </div>

        <div class="bg-[#1a2332] border border-[#1e293b] rounded-2xl p-6 max-w-xl">
            <h3 class="font-semibold text-lg mb-4 text-[#10b981]">Novo Usuário</h3>
            <form action="cadastrar.php" method="POST" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1.5 text-xs font-medium text-gray-400">Nome Completo</label>
                        <input type="text" name="nome" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
                    </div>
                    <div>
                        <label class="block mb-1.5 text-xs font-medium text-gray-400">Email</label>
                        <input type="email" name="email" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
                    </div>
                </div>
                <div>
                    <label class="block mb-1.5 text-xs font-medium text-gray-400">Senha</label>
                    <input type="password" name="senha" required class="w-full p-2.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
                </div>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#10b981] to-[#059669] text-white font-semibold rounded-xl hover:translate-y-[-1px] transition-all shadow-md shadow-emerald-500/10">Salvar Usuário</button>
            </form>
        </div>

        <div class="bg-[#1a2332] border border-[#1e293b] rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm">
                    <thead>
                        <tr class="bg-[#111827] text-gray-400 font-semibold uppercase text-xs border-b border-[#1e293b]">
                            <th class="p-4 pl-6">ID</th>
                            <th class="p-4">Nome</th>
                            <th class="p-4">Email</th>
                            <th class="p-4 pr-6 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1e293b]">
                        <?php while($user = mysqli_fetch_assoc($usuarios)): ?>
                        <tr class="hover:bg-emerald-500/[0.02] transition-colors">
                            <td class="p-4 pl-6 font-mono text-gray-500">#<?php echo $user['id']; ?></td>
                            <td class="p-4 font-medium"><?php echo $user['nome']; ?></td>
                            <td class="p-4 text-gray-400"><?php echo $user['email']; ?></td>
                            <td class="p-4 pr-6 text-right space-x-2">
                                <a href="editar.php?id=<?php echo $user['id']; ?>" class="inline-flex w-8 h-8 rounded-lg border border-[#1e293b] items-center justify-center text-gray-400 hover:text-[#10b981] hover:border-[#10b981] transition-colors">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <a href="excluir.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Excluir este usuário permanentemente?')" class="inline-flex w-8 h-8 rounded-lg border border-[#1e293b] items-center justify-center text-gray-400 hover:text-red-400 hover:border-red-500/30 hover:bg-red-500/10 transition-colors">
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
