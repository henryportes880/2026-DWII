<?php
$titulo_pagina = 'Acesso Negado';
$caminho_raiz  = '../';
include __DIR__ . '/../includes/cabecalho.php';
?>
<body class="hub-page">
    <main class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh; text-align: center;">
        <div class="card-painel" style="max-width: 500px; padding: 40px; border: 1px solid #ef4444;">
            <span style="font-size: 4rem; display: block; margin-bottom: 20px;">🚫</span>
            <h1 style="color: #f87171; margin-bottom: 15px;">Acesso Restrito</h1>
            <p style="color: var(--text-sec); line-height: 1.6; margin-bottom: 30px;">
                Desculpe, você não tem permissão para acessar esta página. 
                É necessário estar autenticado no sistema para visualizar o CRUD de projetos.
            </p>
            
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="../04_sessoes/login.php" class="btn-primario" style="background: #3b82f6;">
                    🔐 Ir para Login
                </a>
                <a href="../index.php" class="btn" style="background: rgba(255,255,255,0.1); color: white; text-decoration: none; padding: 12px 20px; border-radius: 8px;">
                    🏠 Início
                </a>
            </div>
        </div>
    </main>
<?php include __DIR__ . '/../includes/rodape.php'; ?>
</body>