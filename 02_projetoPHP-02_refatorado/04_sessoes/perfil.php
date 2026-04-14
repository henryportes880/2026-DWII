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
$caminho_raiz  = '../';
$pagina_atual  = 'login';

// 3. Inclusão do Cabeçalho Global
require_once __DIR__ . '/../includes/cabecalho.php';

// 4. Foto de perfil do Henry
$usuario = htmlspecialchars($_SESSION['usuario']);
$foto_url = $caminho_raiz . 'imgs/henry.jpg';
?>

<main>
    <section class="inicio" style="margin-bottom: 2.5rem; text-align: center;">
        <div style="margin-bottom: 0.5rem;">
            <span class="badge" style="background: var(--bg-surface-hover); color: var(--text-heading); border: 1px solid var(--border-light);">Detalhes da Sessão Ativa</span>
        </div>
        <h1>👤 Perfil do Usuário</h1>
    </section>

    <article class="card" style="max-width: 500px; margin: 0 auto; padding: 2.5rem 2rem;">
        
        <!-- FOTO DE PERFIL -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="position: relative; width: 140px; height: 140px; margin: 0 auto;">
                <!-- Fundo decorativo -->
                <div style="position: absolute; inset: -15px; background: var(--gradient-primary); border-radius: 50%; opacity: 0.1; z-index: 0;"></div>
                
                <!-- Imagem de Perfil -->
                <img src="<?= $foto_url ?>" 
                     alt="Foto de <?= $usuario ?>" 
                     style="position: relative; z-index: 1; width: 100%; height: 100%; object-fit: cover; border-radius: 50%; box-shadow: var(--shadow-lg); border: 4px solid white;">
            </div>
            
            <!-- Status Online -->
            <div style="position: absolute; bottom: 0; right: 50%; transform: translateX(50%); width: 20px; height: 20px; background: #10b981; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #10b981; margin-top: -10px;"></div>
        </div>

        <!-- NOME DO USUÁRIO -->
        <h2 style="font-size: 1.6rem; margin-bottom: 0.5rem; color: var(--text-heading); text-align: center;">
            <?= $usuario ?>
        </h2>
        
        <p style="text-align: center; color: var(--text-muted); margin-bottom: 2rem; font-size: 0.95rem;">
            ✅ Conectado agora
        </p>

        <!-- INFORMAÇÕES DA SESSÃO -->
        <div style="text-align: left; display: flex; flex-direction: column; gap: 1.25rem;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: var(--bg-surface-hover); border-radius: var(--radius-md); border-left: 4px solid var(--primary);">
                <strong style="color: var(--text-muted); font-size: 0.95rem;">👤 Usuário:</strong>
                <span style="font-weight: 600; color: var(--text-heading);"><?= $usuario ?></span>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: var(--bg-surface-hover); border-radius: var(--radius-md); border-left: 4px solid var(--accent-gold);">
                <strong style="color: var(--text-muted); font-size: 0.95rem;">🕐 Login em:</strong>
                <span style="font-weight: 500; color: var(--text-heading);"><?= htmlspecialchars($_SESSION['logado_em'] ?? '-') ?></span>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: var(--bg-surface-hover); border-radius: var(--radius-md); border-left: 4px solid var(--success);">
                <strong style="color: var(--text-muted); font-size: 0.95rem;">🔄 Interações:</strong>
                <span class="badge badge-success" style="font-size: 0.9rem;"><?= $_SESSION['visitas'] ?? 0 ?></span>
            </div>

        </div>

        <!-- ID DA SESSÃO -->
        <div style="margin-top: 2.5rem; padding: 1.5rem; background: var(--neutral-50); border-radius: var(--radius-md); border: 1px dashed var(--border-light);">
            <p style="margin-bottom: 0.75rem; color: var(--text-muted); font-size: 0.85rem; font-weight: 600;">🔐 ID da Sessão:</p>
            <code style="background: white; padding: 0.75rem; border-radius: var(--radius-sm); border: 1px solid var(--border-light); display: block; word-break: break-all; color: var(--primary); font-family: 'Courier New', monospace; font-size: 0.8rem;">
                <?= session_id() ?>
            </code>
        </div>

    </article>

    <!-- BOTÕES DE AÇÃO -->
    <div style="text-align: center; margin-top: 2.5rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="painel.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none;">
            ← Voltar ao Painel
        </a>
        <a href="logout.php" class="btn" style="background: var(--error); color: white; box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);">
            🚪 Sair da Conta
        </a>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
