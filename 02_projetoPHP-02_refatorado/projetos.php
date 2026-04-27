<?php
/**
 * ===============================================================
 * Arquivo: 01_php-intro/projetos.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Projeto: Portfólio Pessoal - Versão Dinâmica (PDO)
 * Autor: Henry
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

// 2. Busca os projetos no banco (mesma lógica do seu CRUD)
$stmt = $pdo->query("SELECT * FROM projetos ORDER BY criado_em DESC");
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
            <p>Projetos reais recuperados dinamicamente do banco de dados através de PDO.</p>
        </div>

        <?php if (empty($projetos)): ?>
            <div class="card" style="text-align: center;">
                <p>Nenhum projeto encontrado no banco de dados.</p>
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
            margin-bottom: 1.5rem; /* Ajuste de espaçamento */
        }

        @media (max-width: 768px) {
            main { gap: 2rem; }
        }
    </style>
</body>
</html>