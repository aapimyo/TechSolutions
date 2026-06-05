<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechSolutions - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #0a0f1a; --bg-elevated: #111827; --bg-card: #1a2332; --fg: #f1f5f9; --fg-muted: #94a3b8; --accent: #10b981; --accent-hover: #059669; --border: #1e293b; --danger: #ef4444;}
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--fg); }
        h1 { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="min-height-screen flex items-center justify-center p-4 relative">
    <div class="fixed inset-0 pointer-events-none opacity-40" style="background-image: radial-gradient(ellipse 80% 50% at 50% -20%, rgba(16, 185, 129, 0.15), transparent);"></div>
    
    <div class="bg-gradient-to-br from-[#1a2332] to-[#111827] border border-[#1e293b] rounded-[20px] p-12 w-full max-w-[420px] shadow-2xl relative z-10">
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center mx-auto mb-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <h1 class="text-2xl font-bold mb-2">TechSolutions</h1>
            <p class="text-gray-400 text-sm">Sistema de Agendamentos Internos</p>
        </div>

        <?php if (isset($_GET['erro'])): ?>
            <div class="bg-red-500/15 border border-red-500/30 text-[#ef4444] p-3 rounded-xl mb-4 text-sm text-center">
                Email ou senha inválidos!
            </div>
        <?php endif; ?>

        <form action="validar.php" method="POST" class="space-y-6">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-400">Email</label>
                <input type="email" name="email" required placeholder="seu@email.com" class="w-full p-3.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-400">Senha</label>
                <input type="password" name="senha" required placeholder="Sua senha" class="w-full p-3.5 bg-[#0a0f1a] border border-[#1e293b] rounded-xl text-white focus:outline-none focus:border-[#10b981]">
            </div>
            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#10b981] to-[#059669] text-white font-bold rounded-xl hover:translate-y-[-2px] transition-all shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2">
                Entrar
            </button>
        </form>
    </div>
</body>
</html>