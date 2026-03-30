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
<body>
<div class="container text-center">
    <header class="header-pagina">
        <h1 class="titulo-secao">🌐 Página Pública</h1>
        <p>Conteúdo acessível a todos os visitantes.</p>
    </header>

    <div class="card">
        <?php if ($logado): ?>
            <p>Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>! Você já está autenticado.</p>
            <a href="painel.php" class="btn">Ir ao Painel Administrativo</a>
        <?php else: ?>
            <p>Você não está logado no momento.</p>
            <a href="login.php" class="btn">🔐 Acessar Área Restrita</a>
        <?php endif; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>