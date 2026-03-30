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
<body>
<div class="container">
    <div class="alerta-sucesso">
        <h3>✅ Bem-vindo ao Sistema</h3>
        <p>Sua autenticação foi confirmada com sucesso.</p>
    </div>

    <div class="card card-painel">
        <div class="painel-info">
            <p><strong>Status:</strong> <span class="badge">Online</span></p>
            <p><strong>Usuário:</strong> <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
            <p><strong>Sessão iniciada em:</strong> <?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?></p>
        </div>
        
        <hr class="divisor">
        
        <h3>📊 Painel de Controle</h3>
        <p class="texto-secundario">Este conteúdo é protegido e visível apenas para administradores.</p>
    </div>

    <div class="acoes-painel">
        <a href="logout.php" class="btn btn-perigo">🚪 Encerrar Sessão</a>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>