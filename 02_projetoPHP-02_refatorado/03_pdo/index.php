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

    <section style="margin: -1.5rem 0 2rem 0;">
        <article class="card" style="padding: 1.5rem; margin-bottom: 0;">
            
            <form method="get" style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem;">
                <input type="text" name="busca" placeholder="O que você procura?" 
                       value="<?php echo htmlspecialchars($busca); ?>"
                       style="flex: 1; margin-bottom: 0;">
                <button type="submit" style="width: auto; padding: 0 1.5rem;">Buscar</button>
            </form>

            <nav style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; justify-content: flex-start;">
                <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-right: 0.5rem;">
                    Filtrar por:
                </span>
                
                <a href="index.php" class="<?php echo !$categoria ? 'ativo' : ''; ?>" style="text-decoration: none;">Todos</a>
                
                <?php foreach ($categorias as $cat): ?>
                    <a href="index.php?categoria=<?php echo urlencode($cat['categoria']); ?>" 
                       class="<?php echo $categoria === $cat['categoria'] ? 'ativo' : ''; ?>"
                       style="text-decoration: none;">
                        <?php echo htmlspecialchars($cat['categoria']); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </article>
    </section>

    <p style="margin-bottom: 1rem; font-size: 0.9rem; color: var(--text-muted);">
        Encontramos <strong><?php echo count($tecnologias); ?></strong> item(s) para sua seleção.
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        
        <?php if (empty($tecnologias)): ?>
            <article class="card" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                <p style="font-size: 1.2rem; color: var(--text-muted);">Nenhuma tecnologia encontrada para essa busca. 🔍</p>
                <a href="index.php" class="btn" style="margin-top: 1rem; display: inline-block;">Limpar Filtros</a>
            </article>
        <?php endif; ?>

        <?php foreach ($tecnologias as $tec): ?>
            <article class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="margin-bottom: 1rem;">
                        <span class="badge"><?php echo htmlspecialchars($tec['categoria']); ?></span>
                    </div>
                    
                    <h3 style="margin-bottom: 0.75rem; color: var(--text-heading);"><?php echo htmlspecialchars($tec['nome']); ?></h3>
                    
                    <p style="font-size: 0.95rem; line-height: 1.6; color: var(--text-body);">
                        <?php 
                            $desc = htmlspecialchars($tec['descricao']);
                            echo (strlen($desc) > 130) ? substr($desc, 0, 130) . '...' : $desc; 
                        ?>
                    </p>
                </div>

                <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-light);">
                    <a href="detalhes.php?id=<?php echo $tec['id']; ?>&categoria=<?php echo urlencode($categoria); ?>" 
                       class="btn" style="width: 100%; text-align: center;">Ver detalhes →</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    
    <div style="text-align: center; margin-top: 3rem;">
        <a href="../index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none;">
            ← Voltar ao Repositório
        </a>
    </div>
</main>

<?php include 'includes/rod_pdo.php'; ?>