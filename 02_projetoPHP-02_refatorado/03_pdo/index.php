<?php
/**
 * ========================================================
 * ARQUIVO: 03_pdo/index.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 05 - PHP + MariaDB: persistência de dados via PDO
 * Autor: Henry
 * =========================================================
 */

// 1. Configurações Iniciais
$titulo_pagina = "Catálogo de Tecnologias";
$pagina_atual = "catalogo";
$caminho_raiz = '../';

require_once 'includes/conexao.php';

// 2. Capturar Filtros (Busca e Categoria)
$busca     = trim($_GET['busca'] ?? '');
$categoria = trim($_GET['categoria'] ?? '');

// 3. Buscar Categorias Únicas
$stmtCat = $pdo->query('SELECT DISTINCT categoria FROM tecnologias ORDER BY categoria');
$categorias = $stmtCat->fetchAll();

// 4. Lógica de Consulta (SELECT dinâmico)
if ($busca) {
    $stmt = $pdo->prepare('SELECT * FROM tecnologias WHERE nome LIKE :t1 OR descricao LIKE :t2 ORDER BY nome');
    $stmt->execute(['t1' => "%$busca%", 't2' => "%$busca%"]);
} elseif ($categoria) {
    $stmt = $pdo->prepare('SELECT * FROM tecnologias WHERE categoria = :cat ORDER BY nome');
    $stmt->execute(['cat' => $categoria]);
} else {
    $stmt = $pdo->query('SELECT * FROM tecnologias ORDER BY nome');
}

$tecnologias = $stmt->fetchAll();
?>

<?php include 'includes/cab_pdo.php'; ?>

<main>
    <section class="inicio">
        <h1>Catálogo de Tecnologias</h1>
        <p>Exploração de stack e ferramentas desenvolvidas por Henry no IFPR.</p>
    </section>

    <!-- SEÇÃO DE BUSCA E FILTROS -->
    <section style="margin-bottom: var(--spacing-2xl);">
        <article class="card">
            
            <form method="get" class="flex gap-2" style="margin-bottom: var(--spacing-lg);">
                <input type="text" name="busca" placeholder="O que você procura?" 
                       value="<?php echo htmlspecialchars($busca); ?>"
                       style="flex: 1;">
                <button type="submit" class="btn" style="width: auto;">Buscar</button>
            </form>

            <!-- Filtros por Categoria -->
            <nav class="flex gap-2" style="flex-wrap: wrap; align-items: center;">
                <span class="text-muted" style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin-right: var(--spacing-sm);">
                    Filtrar:
                </span>
                
                <a href="index.php" class="<?php echo !$categoria ? 'ativo' : ''; ?>" style="padding: var(--spacing-sm) var(--spacing-lg); border-radius: var(--radius-full); transition: var(--transition-fast); text-decoration: none; color: var(--neutral-600); font-weight: 500;">
                    Todos
                </a>
                
                <?php foreach ($categorias as $cat): ?>
                    <a href="index.php?categoria=<?php echo urlencode($cat['categoria']); ?>" 
                       class="<?php echo $categoria === $cat['categoria'] ? 'ativo' : ''; ?>"
                       style="padding: var(--spacing-sm) var(--spacing-lg); border-radius: var(--radius-full); transition: var(--transition-fast); text-decoration: none; color: var(--neutral-600); font-weight: 500;">
                        <?php echo htmlspecialchars($cat['categoria']); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </article>
    </section>

    <!-- CONTADOR DE RESULTADOS -->
    <p class="text-muted" style="margin-bottom: var(--spacing-lg); font-size: 0.9rem;">
        Encontramos <strong><?php echo count($tecnologias); ?></strong> item(s) para sua seleção.
    </p>

    <!-- GRID DE TECNOLOGIAS -->
    <section class="cards-grid mb-5">
        
        <?php if (empty($tecnologias)): ?>
            <article class="card text-center" style="grid-column: 1 / -1; padding: var(--spacing-4xl) var(--spacing-2xl);">
                <p style="font-size: 1.2rem; color: var(--neutral-500); margin-bottom: var(--spacing-lg);">
                    Nenhuma tecnologia encontrada para essa busca. 🔍
                </p>
                <a href="index.php" class="btn">Limpar Filtros</a>
            </article>
        <?php endif; ?>

        <?php foreach ($tecnologias as $tec): ?>
            <article class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div class="mb-3">
                        <span class="badge"><?php echo htmlspecialchars($tec['categoria']); ?></span>
                    </div>
                    
                    <h3 style="margin-bottom: var(--spacing-md); color: var(--neutral-900); margin-top: 0;">
                        <?php echo htmlspecialchars($tec['nome']); ?>
                    </h3>
                    
                    <p style="font-size: 0.95rem; line-height: 1.6; color: var(--neutral-600);">
                        <?php 
                            $desc = htmlspecialchars($tec['descricao']);
                            echo (strlen($desc) > 130) ? substr($desc, 0, 130) . '...' : $desc; 
                        ?>
                    </p>
                </div>

                <div style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: 1px solid var(--neutral-200);">
                    <a href="detalhes.php?id=<?php echo $tec['id']; ?>&categoria=<?php echo urlencode($categoria); ?>" 
                       class="btn btn-block">Ver detalhes →</a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
    
    <!-- BOTÃO VOLTAR -->
    <div class="text-center mt-5">
        <a href="../index.php" class="btn btn-secondary">← Voltar ao Repositório</a>
    </div>
</main>

<!-- ANIMAÇÕES CSS -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    main {
        animation: fadeInUp 0.8s ease-out;
    }

    .card {
        animation: fadeInUp 0.8s ease-out backwards;
    }

    .cards-grid .card:nth-child(1) { animation-delay: 0.1s; }
    .cards-grid .card:nth-child(2) { animation-delay: 0.2s; }
    .cards-grid .card:nth-child(3) { animation-delay: 0.3s; }
    .cards-grid .card:nth-child(4) { animation-delay: 0.4s; }
    .cards-grid .card:nth-child(5) { animation-delay: 0.5s; }
    .cards-grid .card:nth-child(6) { animation-delay: 0.6s; }

    @media (max-width: 768px) {
        main {
            gap: 2rem;
        }
    }
</style>

<?php include 'includes/rod_pdo.php'; ?>
