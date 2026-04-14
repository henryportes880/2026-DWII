<?php
/**
 * ========================================================
 * ARQUIVO: 04_sessoes/publico.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 */

// 1. Inicia a sessão (necessário para checar se o usuário existe, mas sem bloquear acesso)
session_start();

// 2. Verifica o status de autenticação (retorna true ou false)
$logado = isset($_SESSION['usuario']);

// 3. Variáveis de Template
$titulo_pagina = 'Página Pública';
$caminho_raiz  = '../';
$pagina_atual  = 'publico';

// 4. Inclusão do Cabeçalho Global
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main>
    <div style="margin-bottom: 2rem;">
        <a href="../index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none; display: inline-block;">
            ← Voltar ao Repositório
        </a>
    </div>

    <section class="inicio" style="margin-bottom: 2.5rem; text-align: center;">
        <div style="margin-bottom: 0.5rem;">
            <span class="badge" style="background: var(--primary); color: white;">Visibilidade e Sessões</span>
        </div>
        <h1>🌐 Página Pública</h1>
    </section>

    <article class="card" style="max-width: 600px; margin: 0 auto; text-align: center; padding: 3rem 2rem;">
        
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 72px; height: 72px; border-radius: var(--radius-pill); background: var(--bg-surface-hover); color: var(--primary); font-size: 2rem; margin-bottom: 1.5rem; border: 2px solid var(--border-light);">
            🌍
        </div>
        
        <h2 style="font-size: 1.6rem; margin-bottom: 1rem; color: var(--text-heading);">Bem-vindo ao Conteúdo Aberto</h2>
        
        <p style="color: var(--text-body); margin-bottom: 2.5rem; line-height: 1.6; font-size: 1.05rem;">
            Esta seção do sistema está disponível para todos os visitantes. Diferente do Painel, aqui o PHP não redireciona o usuário anônimo, apenas adapta a interface conforme o seu status atual.
        </p>

        <div style="border-top: 1px solid var(--border-light); padding-top: 2rem;">
            
            <?php if ($logado): ?>
                
                <div style="background: #ecfdf5; border: 1px solid #a7f3d0; padding: 1.5rem; border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
                    <p style="color: #065f46; margin-bottom: 1.25rem; font-size: 1.1rem;">
                        Olá, <strong style="font-weight: 700;"><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>! Você já possui uma sessão ativa.
                    </p>
                    <a href="painel.php" class="btn" style="background: #10b981; border-color: #059669; justify-content: center; width: 100%; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);">
                        Ir ao Painel Administrativo →
                    </a>
                </div>

            <?php else: ?>
                
                <div style="background: var(--bg-surface-hover); border: 1px solid var(--border-light); padding: 1.5rem; border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
                    <p style="color: var(--text-heading); margin-bottom: 1.25rem; font-size: 1.05rem;">
                        Você está navegando como <strong style="color: var(--text-muted);">visitante anônimo</strong>.
                    </p>
                    <a href="login.php" class="btn" style="justify-content: center; width: 100%;">
                        🔐 Acessar Área Restrita
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </article>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>