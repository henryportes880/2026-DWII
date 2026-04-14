<?php
/**
 * ========================================================
 * ARQUIVO: 03_pdo/detalhes.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 05 - PHP + MariaDB: persistência de dados via PDO
 * Autor: Henry
 * =========================================================
 */

// 1. Configurações Iniciais
$caminho_raiz = '../';
require_once 'includes/conexao.php';

// 2. Validação do ID e Categoria
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$categoria_voltar = trim($_GET['categoria'] ?? '');

if (!$id) {
    include '404.php'; // Ou header('Location: index.php');
    exit;
}

// 3. Consulta Segura (Prepared Statement)
$stmt = $pdo->prepare('SELECT * FROM tecnologias WHERE id = :id');
$stmt->execute(['id' => $id]);
$tec = $stmt->fetch();

if (!$tec) {
    include '404.php';
    exit;
}

// 4. Variáveis para o Cabeçalho Global
$titulo_pagina = htmlspecialchars($tec['nome']) . " | Detalhes";
$pagina_atual = "catalogo";

include 'includes/cab_pdo.php'; 
?>

<main>
    
    <div style="margin-bottom: 2rem;">
        <a href="index.php<?php echo $categoria_voltar ? '?categoria=' . urlencode($categoria_voltar) : ''; ?>" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none; display: inline-block;">
            ← Voltar ao catálogo
        </a>
    </div>

    <section class="inicio" style="display: flex; flex-direction: column; align-items: flex-start; gap: 1rem; text-align: left;">
        
        <div>
            <span class="badge"><?php echo htmlspecialchars($tec['categoria']); ?></span>
        </div>
        
        <h1 style="font-size: clamp(2rem, 4vw, 2.5rem); margin-bottom: 0.5rem; color: var(--text-heading);">
            <?php echo htmlspecialchars($tec['nome']); ?>
        </h1>
        
        <p style="font-size: 1.1rem; line-height: 1.7; color: var(--text-body); max-width: 800px;">
            <?php echo nl2br(htmlspecialchars($tec['descricao'])); ?>
        </p>
        
    </section>

    <h2 style="font-size: 1.25rem; color: var(--text-heading); margin: 2rem 0 1.5rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border-light);">
        Informações Técnicas
    </h2>

    <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
        
        <article class="card" style="margin-bottom: 0; padding: 1.5rem; text-align: center;">
            <p style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                ID do Registro
            </p>
            <p style="font-size: 1.75rem; font-weight: 700; color: var(--primary);">
                #<?php echo $tec['id']; ?>
            </p>
        </article>

        <article class="card" style="margin-bottom: 0; padding: 1.5rem; text-align: center;">
            <p style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                Ano de Lançamento
            </p>
            <p style="font-size: 1.75rem; font-weight: 700; color: var(--text-heading);">
                <?php echo $tec['ano_criacao']; ?>
            </p>
        </article>

        <article class="card" style="margin-bottom: 0; padding: 1.5rem; text-align: center;">
            <p style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                Data de Cadastro
            </p>
            <p style="font-size: 1.25rem; font-weight: 600; color: var(--text-heading); margin-top: 0.4rem;">
                <?php echo date('d/m/Y', strtotime($tec['criado_em'])); ?>
            </p>
            <p style="font-size: 0.85rem; color: var(--text-muted);">
                às <?php echo date('H:i', strtotime($tec['criado_em'])); ?>
            </p>
        </article>

    </section>

</main>

<?php include 'includes/rod_pdo.php'; ?>