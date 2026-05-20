<?php
/**
 * ========================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal – versão refatorada
 * Arquivo    : detalheProjeto.php
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * Descrição  : Detalhe de um projeto. Acessado via GET ?id=N.
 * Usa prepared statement para prevenir SQL Injection.
 * Só exibe registros com status = 'publicado'.
 * =========================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pagina_atual = 'projetos';
$titulo_pagina = 'Detalhe do Projeto | Portfólio DWII';
$caminho_raiz = './';

require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/cabecalho.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    header('Location: projetos.php');
    exit;
}

$pdo = conectar();

$stmt = $pdo->prepare(
    "SELECT * FROM projetos
    WHERE id = :id
    AND status = 'publicado'
    LIMIT 1"
);

$stmt->execute([':id' => $id]);

$projeto = $stmt->fetch();

if (!$projeto) {
    header('Location: projetos.php');
    exit;
}

$titulo_pagina = htmlspecialchars($projeto['nome']) . ' | Portfólio DWII';
?>

<main>

    <div class="inicio">
        <h1><?php echo "Projeto-" . htmlspecialchars($projeto['nome']); ?></h1>

        
    </div>

    <article class="card">

        <!-- HEADER -->
        <div 
            class="flex-between mb-4" 
            style="align-items: center;"
        >
            <h2 
                class="text-primary" 
                style="margin: 0;"
            >
                Detalhes do Projeto
            </h2>

            <span class="badge badge-gold">
                <?php echo htmlspecialchars($projeto['tecnologias']); ?>
            </span>
        </div>

        <!-- DESCRIÇÃO -->
        <div class="mb-6">

            <h3 class="text-primary mb-2">
                Descrição
            </h3>

            <p 
                class="text-muted" 
                style="
                    line-height: 1.8; 
                    font-size: 1.05rem;
                "
            >
                <?php echo htmlspecialchars($projeto['descricao']); ?>
            </p>

        </div>

        <!-- INFORMAÇÕES -->
        <div 
            class="grid-2" 
            style="
                gap: var(--spacing-2xl); 
                margin-bottom: var(--spacing-2xl);
            "
        >

            <!-- TECNOLOGIAS -->
            <div 
                class="px-3 py-3" 
                style="
                    background: var(--neutral-50); 
                    border-radius: var(--radius-lg); 
                    border-left: 4px solid var(--accent-gold);
                "
            >

                <p 
                    class="text-muted" 
                    style="
                        font-size: 0.85rem; 
                        margin-bottom: var(--spacing-xs); 
                        text-transform: uppercase; 
                        letter-spacing: 0.05em;
                    "
                >
                    Tecnologias
                </p>

                <p 
                    class="text-primary" 
                    style="
                        margin: 0; 
                        font-weight: 600; 
                        font-size: 1.1rem;
                    "
                >
                    <?php echo htmlspecialchars($projeto['tecnologias']); ?>
                </p>

            </div>

            <!-- ANO -->
            <div 
                class="px-3 py-3" 
                style="
                    background: var(--neutral-50); 
                    border-radius: var(--radius-lg); 
                    border-left: 4px solid var(--success);
                "
            >

                <p 
                    class="text-muted" 
                    style="
                        font-size: 0.85rem; 
                        margin-bottom: var(--spacing-xs); 
                        text-transform: uppercase; 
                        letter-spacing: 0.05em;
                    "
                >
                    Ano
                </p>

                <p 
                    class="text-primary" 
                    style="
                        margin: 0; 
                        font-weight: 600; 
                        font-size: 1.1rem;
                    "
                >
                    <?php echo (int)$projeto['ano']; ?>
                </p>

            </div>

        </div>

        <!-- STATUS -->
        <div 
            class="px-3 py-3" 
            style="
                background: linear-gradient(
                    135deg, 
                    rgba(21, 101, 192, 0.05) 0%, 
                    rgba(212, 175, 55, 0.05) 100%
                ); 
                border-radius: var(--radius-lg); 
                border-left: 4px solid var(--primary);
                margin-bottom: 1.5rem;
            "
        >

            <p 
                class="text-muted" 
                style="
                    font-size: 0.85rem; 
                    margin-bottom: var(--spacing-xs); 
                    text-transform: uppercase; 
                    letter-spacing: 0.05em;
                "
            >
                Status
            </p>

            <p style="margin: 0;">
                <span class="badge badge-success">
                    ✓ Publicado
                </span>
            </p>

        </div>

        <!-- GITHUB -->
        <?php if (!empty($projeto['link_github'])): ?>

        <?php endif; ?>

        <!-- DATA -->
<div class="px-3 py-3" style="background: var(--neutral-50); border-radius: var(--radius-lg); border-left: 4px solid var(--accent-gold);">

    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em;">
        📅 Data de Cadastro
    </p>

    <p class="text-primary" style="margin: 0; font-weight: 600;">
        <?php echo date('d/m/Y H:i', strtotime($projeto['criado_em'])); ?>
    </p>

</div>


    </article>

    <!-- BOTÃO VOLTAR -->
    <div 
        style="
            text-align: center; 
            margin-top: var(--spacing-2xl);
        "
    >

        <a href="projetos.php" class="btn-voltar">
            ← Voltar aos Projetos
        </a>

    </div>

</main>

<?php require_once __DIR__ . '/includes/rodape.php'; ?>