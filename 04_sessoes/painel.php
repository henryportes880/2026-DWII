<?php
require_once __DIR__ . '/includes/auth.php';
requer_login();

$titulo_pagina = 'Painel – Área Restrita';
$caminho_raiz  = '../';
$pagina_atual  = 'painel';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body class="hub-page">
<a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>
<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Painel de Controle</h1>
        <p class="tagline">Aula 06 - Sessões Ativas e Autenticação</p>
    </div>
</header>

<main class="container">
    <div class="alerta-sucesso" style="margin-bottom: 25px; padding: 15px; border-radius: 12px; background: rgba(34, 197, 94, 0.1); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.2);">
        <h3 style="margin-bottom: 5px;">✅ Bem-vindo ao Sistema</h3>
        <p style="font-size: 0.9rem; opacity: 0.9;">Sua autenticação foi confirmada com sucesso.</p>
    </div>

    <div class="card card-painel">
        <div class="painel-info" style="display: grid; gap: 10px; margin-bottom: 20px;">
            <p><strong>Status:</strong> <span class="badge" style="background: var(--accent); color: var(--bg); padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">Online</span></p>
            <p><strong>Usuário:</strong> <span style="color: var(--text);"><?php echo htmlspecialchars($_SESSION['usuario']); ?></span></p>
            <p><strong>Sessão iniciada em:</strong> <span style="color: var(--text-sec);"><?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?></span></p>
        </div>
        
        <hr class="divisor" style="border: 0; border-top: 1px solid var(--border); margin: 20px 0;">
        
        <h3 style="margin-bottom: 10px;">📊 Gerenciamento</h3>
        <p class="texto-secundario" style="color: var(--text-sec); line-height: 1.6; margin-bottom: 20px;">
            Utilize o botão abaixo para acessar o módulo de cadastro de projetos desenvolvido na Aula 08.
        </p>

        <a href="../05_crud/index.php" class="btn-primario" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            📂 Gerenciar Projetos
        </a>
    </div>

    <div class="acoes-painel" style="margin-top: 30px; display: flex; justify-content: flex-end;">
        <a href="logout.php" class="btn" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); text-decoration: none; padding: 10px 20px; border-radius: 8px;">
            🚪 Encerrar Sessão
        </a>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>