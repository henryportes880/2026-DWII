<?php
/**
 * ========================================================
 * ARQUIVO: 04_sessoes/painel.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 */

// 1. Proteção de Acesso
require_once __DIR__ . '/includes/auth.php';
requer_login(); // Se não houver sessão, o usuário é expulso para o login.php

// 2. Contador de Visitas (Persistência de Sessão)
if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}
$_SESSION['visitas']++;

// 3. Variáveis de Template
$titulo_pagina = 'Painel | Área Restrita';
$caminho_raiz  = '../';
$pagina_atual  = 'painel';

// 4. Inclusão do Cabeçalho Global
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main>
    <div style="margin-bottom: 2rem;">
        <a href="../index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none; display: inline-block;">
            ← Voltar ao Repositório
        </a>
    </div>

    <?php if (isset($_SESSION['flash'])): ?>
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 1rem 1.5rem; border-radius: var(--radius-md); margin-bottom: 2.5rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: var(--shadow-sm);">
            <span style="font-size: 1.2rem;">✨</span>
            <p style="margin: 0; font-weight: 500; font-size: 0.95rem;"><?php echo htmlspecialchars($_SESSION['flash']); ?></p>
        </div>
        <?php unset($_SESSION['flash']); // Limpa a mensagem para não aparecer de novo no F5 ?>
    <?php endif; ?>

    <section class="inicio" style="margin-bottom: 2.5rem;">
        <h1>Painel de Controle</h1>
        <p>Bem-vindo à área restrita do sistema. Gerencie seus dados e acessos por aqui.</p>
    </section>

    <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        
        <article class="card" style="margin-bottom: 0;">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-heading); border-bottom: 1px solid var(--border-light); padding-bottom: 0.75rem;">
                <span>👤</span> Status da Sessão
            </h3>
            
            <ul style="list-style: none; padding: 0; margin: 0 0 1.5rem 0; display: flex; flex-direction: column; gap: 0.75rem;">
                <li style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.5rem; border-bottom: 1px dashed var(--border-light);">
                    <strong style="color: var(--text-muted);">Usuário:</strong> 
                    <span style="color: var(--text-heading); font-weight: 600;"><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                </li>
                <li style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.5rem; border-bottom: 1px dashed var(--border-light);">
                    <strong style="color: var(--text-muted);">Acesso em:</strong> 
                    <span style="color: var(--text-heading); font-weight: 500;"><?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?></span>
                </li>
                <li style="display: flex; justify-content: space-between; align-items: center;">
                    <strong style="color: var(--text-muted);">Visitas:</strong> 
                    <span class="badge" style="font-size: 0.9rem;"><?php echo $_SESSION['visitas']; ?></span>
                </li>
            </ul>
            
            <div style="background: var(--bg-surface-hover); padding: 1rem; border-radius: var(--radius-sm); font-size: 0.85rem; color: var(--text-muted); display: flex; gap: 0.5rem; align-items: flex-start;">
                <span>💡</span>
                <p style="margin: 0; line-height: 1.5;">O contador aumenta a cada atualização (F5) porque a sessão persiste no servidor.</p>
            </div>
        </article>

        <article class="card" style="margin-bottom: 0; display: flex; flex-direction: column;">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; color: var(--text-heading); border-bottom: 1px solid var(--border-light); padding-bottom: 0.75rem;">
                <span>📊</span> Gerenciamento
            </h3>
            
            <p style="color: var(--text-body); margin-bottom: 2rem; line-height: 1.6;">
                O conteúdo abaixo é restrito. Utilize os módulos para gerenciar os dados do sistema com segurança.
            </p>
            
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: auto;">
                <a href="../05_crud/index.php" class="btn" style="text-align: center; justify-content: center;">
                    📂 Gerenciar Projetos
                </a>
                <a href="perfil.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none; text-align: center; justify-content: center;">
                    ⚙️ Meu Perfil
                </a>
            </div>
        </article>

    </section>

    <div style="text-align: center; padding-top: 2rem; border-top: 1px solid var(--border-light);">
        <a href="logout.php" class="btn" style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; box-shadow: none; padding: 0.75rem 2rem;">
            🚪 Encerrar Sessão
        </a>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>