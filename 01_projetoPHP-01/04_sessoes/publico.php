<?php
session_start();
$logado = isset($_SESSION['usuario']);
$titulo_pagina = 'Página Pública';
$caminho_raiz  = '../';
$pagina_atual  = 'publico';
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
        <h1>Página Pública</h1>
        <p class="tagline">Aula 06 - Visibilidade de Conteúdo e Sessões</p>
    </div>
</header>

<main class="container">
    <div class="card card-apresentacao" style="text-align: center; padding: 40px;">
        <div style="font-size: 3rem; margin-bottom: 20px;">🌐</div>
        
        <h2 class="titulo-sessao" style="margin-bottom: 15px;">Bem-vindo ao Conteúdo Público</h2>
        
        <p class="texto-destaque" style="margin-bottom: 30px; color: var(--text-sec);">
            Esta seção do sistema está disponível para todos os usuários, independentemente de autenticação. 
            É o local ideal para informações gerais e landing pages.
        </p>

        <div class="card-footer" style="display: flex; justify-content: center; gap: 15px;">
            <?php if ($logado): ?>
                <div style="background: rgba(34, 211, 238, 0.05); padding: 20px; border-radius: 12px; border: 1px dashed var(--border);">
                    <p style="margin-bottom: 15px;">Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>! Você já está autenticado.</p>
                    <a href="painel.php" class="btn">Ir ao Painel Administrativo</a>
                </div>
            <?php else: ?>
                <div style="background: rgba(255, 255, 255, 0.02); padding: 20px; border-radius: 12px; border: 1px dashed var(--border);">
                    <p style="margin-bottom: 15px; color: var(--text-sec);">Você não está logado no momento.</p>
                    <a href="login.php" class="btn">🔐 Acessar Área Restrita</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>