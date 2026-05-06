<?php
/**
 * ===============================================================
 * Arquivo: projetos.php 
 * Descrição: Listagem pública filtrando apenas projetos 'publicado'.
 * ===============================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurações de página
$pagina_atual = "projetos"; 
$caminho_raiz = "./"; 
$titulo_pagina = "Projetos - Henry";

// 1. Conexão com o Banco de Dados
require_once __DIR__ . '/includes/conexao.php';
$pdo = conectar();

// 2. Busca apenas os projetos PUBLICADOS
// Removemos rascunhos e arquivados da vista do usuário final.
$stmt = $pdo->query(
    "SELECT * FROM projetos 
     WHERE status = 'publicado' 
     ORDER BY criado_em DESC"
);
$projetos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>

    <main>
        <div class="inicio">
            <h1>Meus Projetos</h1>
            <p>Exibindo apenas projetos finalizados e publicados.</p>
        </div>

        <?php if (empty($projetos)): ?>
            <div class="card" style="text-align: center;">
                <p>Nenhum projeto publicado no momento. Volte em breve!</p>
            </div>
        <?php else: ?>
            
            <?php foreach ($projetos as $index => $projeto): ?>
                <article class="card" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <div style="margin-bottom: 0.75rem;">
                        <span class="badge"><?php echo htmlspecialchars($projeto['tecnologias']); ?></span>
                    </div>
                    
                    <h2><?php echo htmlspecialchars($projeto['nome']); ?></h2>
                    
                    <p><?php echo htmlspecialchars($projeto['descricao']); ?></p>
                    
                    <div style="margin-top: 1rem; font-size: 0.8rem; color: #666;">
                        <span>📅 Ano: <?php echo (int)$projeto['ano']; ?></span>
                        <?php if ($projeto['atualizado_em']): ?>
                            <span style="margin-left: 10px;">• Atualizado em: <?php echo date('d/m/Y', strtotime($projeto['atualizado_em'])); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($projeto['link_github'])): ?>
                        <div style="margin-top: 1rem;">
                            <a href="<?php echo htmlspecialchars($projeto['link_github']); ?>" target="_blank" class="btn" style="padding: 5px 10px; font-size: 0.8rem;">
                                Ver no GitHub
                            </a>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>

        <?php endif; ?>

        <div style="text-align: center; margin-top: 2.5rem;">
            <a href="index.php" class="btn">← Voltar ao início</a>
        </div>
    </main>  

    <?php include __DIR__ . '/includes/rodape.php'; ?>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        main { animation: fadeInUp 0.8s ease-out; }
        .card { 
            animation: fadeInUp 0.8s ease-out backwards; 
            margin-bottom: 1.5rem; 
        }
        .badge {
            background: #e0e0e0;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: bold;
        }
    </style>
</body>
</html>