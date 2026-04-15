<?php
/**
 * ========================================================
 * ARQUIVO: 05_crud/index.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 07 - CRUD: Listagem Geral (Read)
 * Descrição: Tela principal que lista todos os projetos.
 * Autor: Henry
 * =========================================================
 */

// 1. Proteção e Conexão
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();

// 2. Busca projetos (Os mais recentes aparecem primeiro)
try {
    $stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
    $projetos = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Erro na listagem: " . $e->getMessage());
    $projetos = [];
}

// 3. Sistema de Mensagens (Feedback via GET)
$mensagem = '';
$tipo_alerta = 'info';

if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok') {
    $mensagem = "✅ Projeto cadastrado com sucesso!";
    $tipo_alerta = 'success';
} elseif (isset($_GET['editado']) && $_GET['editado'] === 'ok') {
    $mensagem = "✏️ Alterações salvas com sucesso!";
    $tipo_alerta = 'info';
} elseif (isset($_GET['excluido']) && $_GET['excluido'] === 'ok') {
    $mensagem = "🗑️ O projeto foi removido do portfólio.";
    $tipo_alerta = 'warning';
}

// 4. Configurações de Template
$titulo_pagina = 'Meus Projetos | Gerenciador';
$caminho_raiz  = '../';
$pagina_atual  = 'crud';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main>
    
    <!-- Header com Título e Botão -->
    <header class="flex-between" style="flex-wrap: wrap; gap: 2rem; margin-bottom: 3rem; border-bottom: 1px solid var(--neutral-200); padding-bottom: 2rem;">
        <div>
            <h1 style="margin: 0; font-size: 2.2rem;">Gerenciador de Projetos</h1>
            <p style="color: var(--neutral-500); margin: 0.5rem 0 0 0;">Controle total do seu portfólio acadêmico</p>
        </div>
        <a href="cadastrar.php" class="btn btn-large">
            ➕ Novo Projeto
        </a>
    </header>

    <!-- Alerta de Mensagem -->
    <?php if ($mensagem): ?>
        <div class="alert-<?= $tipo_alerta ?>" style="margin-bottom: 2rem;">
            <p style="margin: 0;"><?= $mensagem ?></p>
        </div>
    <?php endif; ?>

    <!-- Badge com Total -->
    <div style="margin-bottom: 2rem;">
        <span class="badge badge-gold">
            📊 Total: <strong><?= count($projetos) ?></strong> projeto(s)
        </span>
    </div>

    <!-- Seção Vazia -->
    <?php if (empty($projetos)): ?>
        <section style="text-align: center; padding: 5rem 2rem; background: var(--neutral-50); border-radius: var(--radius-lg); border: 2px dashed var(--neutral-300);">
            <div style="font-size: 4rem; margin-bottom: 1.5rem;">📂</div>
            <h2>Nenhum projeto encontrado</h2>
            <p style="color: var(--neutral-500); max-width: 400px; margin: 0 auto 2rem;">
                Sua base de dados ainda está vazia. Comece adicionando seu primeiro trabalho acadêmico!
            </p>
            <a href="cadastrar.php" class="btn btn-gold">
                🚀 Criar Primeiro Projeto
            </a>
        </section>

    <!-- Grid de Projetos -->
    <?php else: ?>
        <section class="cards-grid">
            <?php foreach ($projetos as $projeto): ?>
                <article class="card">
    
    <!-- Header do Card com Ícones de Ação -->
    <header style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
        <span class="badge" style="background: var(--primary-light); color: var(--primary); border: none;">
            📅 <?= htmlspecialchars((string)$projeto['ano']) ?>
        </span>
        <div style="display: flex; gap: 0.5rem;">
            <a href="detalhe.php?id=<?= $projeto['id'] ?>" style="font-size: 1.2rem; opacity: 0.6; transition: 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.6'">👁️</a>
            <?php if (!empty($projeto['link_github'])): ?>
                <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" rel="noopener noreferrer" style="font-size: 1.2rem; opacity: 0.6; transition: 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.6'">🔗</a>
            <?php endif; ?>
            <a href="editar.php?id=<?= $projeto['id'] ?>" style="font-size: 1.2rem; opacity: 0.6; transition: 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.6'">✏️</a>
            <a href="excluir.php?id=<?= $projeto['id'] ?>" style="font-size: 1.2rem; opacity: 0.6; transition: 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.6'">🗑️</a>
        </div>
    </header>
    
    <!-- Conteúdo -->
    <div style="flex-grow: 1; margin-bottom: 1.5rem;">
        <h3 style="margin: 0 0 0.75rem 0; font-size: 1.3rem;">
            <?= htmlspecialchars($projeto['nome']) ?>
        </h3>
        <p style="color: var(--neutral-600); font-size: 0.95rem; line-height: 1.5; margin-bottom: 1.5rem;">
            <?= mb_strimwidth(htmlspecialchars($projeto['descricao']), 0, 100, "...") ?>
        </p>
        
        <!-- Tags -->
        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
            <?php 
            $tecs = explode(',', $projeto['tecnologias']);
            foreach($tecs as $tec): 
                if(trim($tec) == "") continue; 
            ?>
                <span style="font-size: 0.75rem; background: var(--neutral-100); color: var(--neutral-600); padding: 0.35rem 0.75rem; border-radius: var(--radius-sm); border: 1px solid var(--neutral-300); font-weight: 500;">
                    <?= trim(htmlspecialchars($tec)) ?>
                </span>
            <?php endforeach; ?>
        </div>
    </div>
</article>

            <?php endforeach; ?>
        </section>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
