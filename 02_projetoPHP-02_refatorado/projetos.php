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
$stmt = $pdo->query(
    "SELECT * FROM projetos 
     WHERE status = 'publicado' 
     ORDER BY criado_em DESC"
);

$projetos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

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

            <article 
                class="card" 
                style="animation-delay: <?php echo $index * 0.1; ?>s;"
            >

                <div style="margin-bottom: 0.75rem;">
                    <span class="badge">
                        <?php echo htmlspecialchars($projeto['tecnologias']); ?>
                    </span>
                </div>

                <h2>
                    <?php echo htmlspecialchars($projeto['nome']); ?>
                </h2>

                <p>
                    <?php echo htmlspecialchars($projeto['descricao']); ?>
                </p>

                <div 
                    style="
                        margin-top: 1rem; 
                        font-size: 0.8rem; 
                        color: #666;
                    "
                >
                    <span>
                        📅 Ano: <?php echo (int)$projeto['ano']; ?>
                    </span>

                    <?php if ($projeto['atualizado_em']): ?>
                        <span style="margin-left: 10px;">
                            • Atualizado em: 
                            <?php echo date('d/m/Y', strtotime($projeto['atualizado_em'])); ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- BOTÕES -->
                <div 
                    style="
                        margin-top: 1rem; 
                        display: flex; 
                        gap: 10px; 
                        flex-wrap: wrap;
                    "
                >

                    <!-- BOTÃO DETALHES -->
                    <a 
                        href="visualizar.php?id=<?php echo $projeto['id']; ?>" 
                        class="btn"
                        style="
                            padding: 5px 10px; 
                            font-size: 0.8rem;
                        "
                    >
                        Ver Detalhes
                    </a>

                    <!-- BOTÃO GITHUB -->
                    <?php if (!empty($projeto['link_github'])): ?>

                        <a 
                            href="<?php echo htmlspecialchars($projeto['link_github']); ?>" 
                            target="_blank" 
                            class="btn"
                            style="
                                padding: 5px 10px; 
                                font-size: 0.8rem;
                            "
                        >
                            Ver no GitHub
                        </a>

                    <?php endif; ?>

                </div>

            </article>

        <?php endforeach; ?>

    <?php endif; ?>

    <div 
        style="
            text-align: center; 
            margin-top: var(--spacing-2xl);
        "
    >
        <a href="index.php" class="btn-voltar">
            ← Voltar ao Início
        </a>
    </div>

</main>

<?php include __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>