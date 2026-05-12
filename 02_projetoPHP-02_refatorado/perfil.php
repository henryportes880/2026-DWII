<?php
/**
 * ========================================================
 * ARQUIVO: 04_sessoes/perfil.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 */

// 1. Proteção: Só entra quem estiver logado
require_once __DIR__ . '/includes/auth.php';
requer_login();

// 2. Variáveis de Template
$titulo_pagina = 'Perfil do Usuário';
$caminho_raiz  = './';
$pagina_atual  = 'painel';

// 3. Inclusão do Cabeçalho Global
require_once __DIR__ . '/includes/cabecalho.php';

// 4. Foto de perfil do usuário
$usuario = htmlspecialchars($_SESSION['usuario']);
$foto_url = $caminho_raiz . 'includes/imgs/henry.jpg';
?>

<main>
    
    <!-- Seção de Introdução -->
    <div class="inicio mb-6">
        <h1>Meu Perfil</h1>
        <p>Gerencie suas informações de conta e sessão.</p>
    </div>

    <!-- Grid com 2 Colunas -->
    <div class="grid-2" style="gap: var(--spacing-2xl); margin-bottom: var(--spacing-4xl);">
        
        <!-- COLUNA 1: FOTO E DADOS BÁSICOS -->
        <article class="card">
            <div class="text-center mb-6">
                <img src="<?= $foto_url ?>" 
                     alt="Foto de <?= $usuario ?>" 
                     style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; box-shadow: var(--shadow-lg); border: 4px solid var(--accent-gold);">
                
                <h2 style="margin: var(--spacing-lg) 0 var(--spacing-sm); color: var(--neutral-900);">
                    <?= $usuario ?>
                </h2>
                <p class="text-success" style="margin: 0; font-weight: 600;">
                    ✅ Conectado
                </p>
            </div>

            <hr style="border: none; border-top: 1px solid var(--neutral-200); margin: var(--spacing-lg) 0;">

            <div class="flex-col gap-3">
                <div>
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">
                        Tipo de Acesso
                    </p>
                    <p class="text-primary" style="margin: 0; font-weight: 600;">
                        Usuário Autenticado
                    </p>
                </div>

                <div>
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">
                        Status
                    </p>
                    <span class="badge badge-success">Ativo</span>
                </div>
            </div>
        </article>

        <!-- COLUNA 2: INFORMAÇÕES DA SESSÃO -->
        <article class="card">
            <h3 class="text-primary mb-4" style="margin-top: 0;">Informações da Sessão</h3>

            <div class="flex-col gap-3">
                
                <div class="px-3 py-3" style="background: var(--neutral-50); border-radius: var(--radius-lg);">
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">
                        👤 Usuário
                    </p>
                    <p class="text-primary" style="margin: 0; font-weight: 600;">
                        <?= $usuario ?>
                    </p>
                </div>

                <div class="px-3 py-3" style="background: var(--neutral-50); border-radius: var(--radius-lg);">
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">
                        🕐 Login em
                    </p>
                    <p style="margin: 0; font-weight: 500; color: var(--neutral-700);">
                        <?= htmlspecialchars($_SESSION['logado_em'] ?? 'Agora') ?>
                    </p>
                </div>

                <div class="px-3 py-3" style="background: var(--neutral-50); border-radius: var(--radius-lg);">
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">
                        🔄 Visitas
                    </p>
                    <p style="margin: 0;">
                        <span class="badge badge-gold">
                            <?= $_SESSION['visitas'] ?? 0 ?>
                        </span>
                    </p>
                </div>

            </div>
        </article>

    </div>

    <!-- ID DA SESSÃO -->
    <article class="card mb-6">
        <h3 class="text-primary mb-3" style="margin-top: 0;">🔐 Identificador da Sessão</h3>
        <code style="background: var(--neutral-50); padding: var(--spacing-lg); border-radius: var(--radius-lg); border: 1px solid var(--neutral-300); display: block; word-break: break-all; color: var(--primary); font-family: 'Courier New', monospace; font-size: 0.8rem; line-height: 1.8;">
            <?= session_id() ?>
        </code>
    </article>

    <!-- BOTÕES DE AÇÃO -->
    <div style="display: flex; gap: 1rem; justify-content: center; margin-top: var(--spacing-2xl); flex-wrap: wrap;">
    <a href="index.php" class="btn-voltar">
        ← Voltar ao Início
    </a>
        <a href="logout.php" class="btn btn-error">
            🚪 Sair da Conta
        </a>
    </div>

</div>

</main>
<?php require_once __DIR__ . '/includes/rodape.php'; ?>
