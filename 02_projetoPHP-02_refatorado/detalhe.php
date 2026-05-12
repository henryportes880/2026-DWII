<?php
/**
 * ========================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal – versão refatorada
 * Arquivo    : detalhe.php (migrado de 03_pdo/detalhe.php)
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * Descrição  : Detalhe de uma tecnologia. Acessada via GET ?id=N.
 * Usa prepared statement para prevenir SQL Injection.
 * Só exibe registros com status = 'ativo'.
 * =========================================================
 */

if (session_status() === PHP_SESSION_NONE) session_start();

$pagina_atual = 'catalogo';
$titulo_pagina = 'Detalhe | Portfólio DWII';
$caminho_raiz = './';

require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/cabecalho.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    header('Location: catalogo.php');
    exit;
}

$pdo = conectar();

$stmt = $pdo->prepare(
    "SELECT * FROM tecnologias 
    WHERE id = :id 
    AND status = 'ativo' 
    LIMIT 1"
);
$stmt->execute([':id' => $id]);
$tec = $stmt->fetch();

if (!$tec) {
    header('Location: catalogo.php');
    exit;
}

$titulo_pagina = htmlspecialchars($tec['nome']) . ' | Portfólio DWII';
?>

<main>
    
    <div class="inicio">
        <h1><?php echo htmlspecialchars($tec['nome']); ?></h1>
        <p><?php echo htmlspecialchars($tec['descricao']); ?></p>
    </div>

    <article class="card">
        
        <!-- Header com Badge -->
        <div class="flex-between mb-4" style="align-items: center;">
            <h2 class="text-primary" style="margin: 0;">Detalhes da Tecnologia</h2>
            <span class="badge badge-gold">
                <?php echo htmlspecialchars($tec['categoria']); ?>
            </span>
        </div>

        <!-- Conteúdo Principal -->
        <div class="mb-6">
            <h3 class="text-primary mb-2">Descrição</h3>
            <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                <?php echo htmlspecialchars($tec['descricao']); ?>
            </p>
        </div>

        <!-- Informações em Linha -->
        <div class="grid-2" style="gap: var(--spacing-2xl); margin-bottom: var(--spacing-2xl);">
            
            <div class="px-3 py-3" style="background: var(--neutral-50); border-radius: var(--radius-lg); border-left: 4px solid var(--accent-gold);">
                <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em;">
                    Categoria
                </p>
                <p class="text-primary" style="margin: 0; font-weight: 600; font-size: 1.1rem;">
                    <?php echo htmlspecialchars($tec['categoria']); ?>
                </p>
            </div>

            <div class="px-3 py-3" style="background: var(--neutral-50); border-radius: var(--radius-lg); border-left: 4px solid var(--success);">
                <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em;">
                    Status
                </p>
                <p style="margin: 0; font-weight: 600; font-size: 1.1rem;">
                    <span class="badge badge-success">✓ Ativo</span>
                </p>
            </div>

        </div>

        <!-- Data de Cadastro -->
        <div class="px-3 py-3" style="background: linear-gradient(135deg, rgba(21, 101, 192, 0.05) 0%, rgba(212, 175, 55, 0.05) 100%); border-radius: var(--radius-lg); border-left: 4px solid var(--primary);">
            <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em;">
                📅 Data de Cadastro
            </p>
            <p class="text-primary" style="margin: 0; font-weight: 600;">
                <?php echo date('d de F de Y', strtotime($tec['criado_em'])); ?>
            </p>
        </div>

    </article>

    

    <div style="text-align: center; margin-top: var(--spacing-2xl);">
    <a href="catalogo.php" class="btn-voltar">
        ← Voltar ao Catálogo
    </a>
</div>


</main>
<?php require_once __DIR__ . '/includes/rodape.php'; ?>
