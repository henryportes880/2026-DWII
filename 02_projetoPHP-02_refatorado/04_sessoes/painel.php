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
    
    <!-- Botão Voltar -->
    <div class="mb-4">
        <a href="../index.php" class="btn btn-secondary">
            ← Voltar ao Repositório
        </a>
    </div>

    <!-- Flash Message -->
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert-success" style="margin-bottom: var(--spacing-2xl);">
            <span>✨</span>
            <p style="margin: 0;"><?php echo htmlspecialchars($_SESSION['flash']); ?></p>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- Seção Introdutória -->
    <section class="inicio mb-5">
        <h1>Painel de Controle</h1>
        <p>Bem-vindo à área restrita do sistema. Gerencie seus dados e acessos por aqui.</p>
    </section>

    <!-- Grid de Cards -->
    <section class="cards-grid mb-5">
        
        <!-- Card: Status da Sessão -->
        <article class="card">
            <h3 style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-lg); color: var(--neutral-900); border-bottom: 1px solid var(--neutral-200); padding-bottom: var(--spacing-md); margin-top: 0;">
                <span>👤</span> Status da Sessão
            </h3>
            
            <ul style="list-style: none; padding: 0; margin: 0 0 var(--spacing-lg) 0; display: flex; flex-direction: column; gap: var(--spacing-md);">
                <li style="display: flex; justify-content: space-between; align-items: center; padding-bottom: var(--spacing-sm); border-bottom: 1px dashed var(--neutral-200);">
                    <strong class="text-muted">Usuário:</strong> 
                    <span style="color: var(--neutral-900); font-weight: 600;">
                        <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                    </span>
                </li>
                <li style="display: flex; justify-content: space-between; align-items: center; padding-bottom: var(--spacing-sm); border-bottom: 1px dashed var(--neutral-200);">
                    <strong class="text-muted">Acesso em:</strong> 
                    <span style="color: var(--neutral-900); font-weight: 500;">
                        <?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?>
                    </span>
                </li>
                <li style="display: flex; justify-content: space-between; align-items: center;">
                    <strong class="text-muted">Visitas:</strong> 
                    <span class="badge"><?php echo $_SESSION['visitas']; ?></span>
                </li>
            </ul>
            
            <div style="background: var(--neutral-100); padding: var(--spacing-lg); border-radius: var(--radius-md); font-size: 0.85rem; color: var(--neutral-500); display: flex; gap: var(--spacing-sm); align-items: flex-start;">
                <span>💡</span>
                <p style="margin: 0; line-height: 1.6;">
                    O contador aumenta a cada atualização (F5) porque a sessão persiste no servidor.
                </p>
            </div>
        </article>

        <!-- Card: Gerenciamento -->
        <article class="card" style="display: flex; flex-direction: column;">
            <h3 style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-lg); color: var(--neutral-900); border-bottom: 1px solid var(--neutral-200); padding-bottom: var(--spacing-md); margin-top: 0;">
                <span>📊</span> Gerenciamento
            </h3>
            
            <p style="color: var(--neutral-600); margin-bottom: var(--spacing-lg); line-height: 1.6;">
                O conteúdo abaixo é restrito. Utilize os módulos para gerenciar os dados do sistema com segurança.
            </p>
            
            <div style="display: flex; flex-direction: column; gap: var(--spacing-lg); margin-top: auto;">
                <a href="../05_crud/index.php" class="btn btn-large btn-block">
                    📂 Gerenciar Projetos
                </a>
                <a href="perfil.php" class="btn btn-secondary btn-large btn-block">
                    ⚙️ Meu Perfil
                </a>
            </div>
        </article>

    </section>

    <!-- Botão Logout -->
    <div class="text-center pt-4" style="border-top: 1px solid var(--neutral-200);">
        <a href="logout.php" class="btn" style="background: rgba(239, 68, 68, 0.1); color: var(--error); border: 1px solid var(--error); box-shadow: none;">
            🚪 Encerrar Sessão
        </a>
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

    .alert-success {
        animation: fadeInUp 0.6s ease-out;
    }

    @media (max-width: 768px) {
        main {
            gap: 2rem;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
