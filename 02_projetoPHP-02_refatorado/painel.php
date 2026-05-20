<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Arquivo : painel.php (raiz)
 * Descrição : Área restrita fundida com funcionalidades de contador e mensagens flash.
 */

require_once __DIR__ . '/includes/auth.php';
requer_login(); // Proteção de acesso

// 1. Contador de Visitas (Lógica do código antigo)
if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}
$_SESSION['visitas']++;

// 2. Variáveis de Template (Baseadas nas imagens, com títulos do antigo)
$pagina_atual = 'painel';
$titulo_pagina = 'Painel | Área Restrita';
$caminho_raiz = './';

require_once __DIR__ . '/includes/cabecalho.php';
?>

<main>

    <!-- Alert Flash de Sucesso -->
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert-success mb-4">
            <span>✨</span>
            <div>
                <strong>Sucesso!</strong>
                <p><?php echo htmlspecialchars($_SESSION['flash']); ?></p>
            </div>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- Seção de Boas-vindas -->
    <div class="inicio mb-6">
        <h1>Painel de Controle</h1>
        <p>Olá, <strong><?= htmlspecialchars(usuario_atual()) ?></strong>! Bem-vindo à sua área restrita.</p>
    </div>

    <!-- Grid de Cards -->
    <div class="cards-grid mb-6">
        
        <!-- Card 1: Status da Sessão -->
        <article class="card">
            <div class="flex-between mb-3">
                <h3 style="margin: 0; color: var(--neutral-900);">👤 Status da Sessão</h3>
            </div>

            <div class="mb-4">
                <div class="px-3 py-3 mb-3" style="background: var(--neutral-50); border-radius: var(--radius-lg); border-left: 4px solid var(--primary);">
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em;">
                        Usuário Logado
                    </p>
                    <p class="text-primary" style="margin: 0; font-weight: 600; font-size: 1.1rem;">
                        <?= htmlspecialchars(usuario_atual()) ?>
                    </p>
                </div>

                <div class="px-3 py-3" style="background: var(--neutral-50); border-radius: var(--radius-lg); border-left: 4px solid var(--accent-gold);">
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: var(--spacing-xs); text-transform: uppercase; letter-spacing: 0.05em;">
                        Visitas nesta Sessão
                    </p>
                    <p style="margin: 0; font-weight: 600; font-size: 1.1rem;">
                        <span class="badge badge-gold">
                            🔄 <?php echo $_SESSION['visitas']; ?>
                        </span>
                    </p>
                </div>
            </div>

            <div class="px-3 py-3" style="background: rgba(21, 101, 192, 0.05); border-radius: var(--radius-lg); border-left: 4px solid var(--info);">
                <p class="text-muted" style="font-size: 0.8rem; margin: 0; line-height: 1.6;">
                    💡 <strong>Dica:</strong> O contador aumenta a cada F5 porque a sessão persiste no servidor.
                </p>
            </div>
        </article>

        <!-- Card 2: Ações Rápidas -->
        <article class="card flex-col">
            <h3 style="margin: 0 0 var(--spacing-lg) 0; color: var(--neutral-900);">📊 Ações Rápidas</h3>
            <p class="text-muted mb-4" style="flex-grow: 1;">
                Acesse rapidamente as principais funcionalidades do sistema.
            </p>

            <div class="flex-col gap-2">
                <a href="admin.php" class="btn btn-primary btn-block" style="background: var(--gradient-primary);">
                    📂 Gerenciar Projetos
                </a>
                <a href="perfil.php" class="btn btn-secondary btn-block">
                    ⚙️ Meu Perfil
                </a>
            </div>
        </article>

    </div>

    <!-- Seção de Informações Adicionais -->
    <article class="card mb-6">
        <h3 class="text-primary mb-4">📈 Resumo da Sessão</h3>
        
        <div class="grid-2" style="gap: var(--spacing-2xl);">
            
            <div>
                <h4 class="text-primary mb-2" style="font-size: 1rem;">Acesso Seguro</h4>
                <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                    Sua sessão está protegida por autenticação segura. Todos os dados são criptografados e validados no servidor.
                </p>
            </div>

            <div>
                <h4 class="text-primary mb-2" style="font-size: 1rem;">Funcionalidades</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li class="text-muted mb-2">✓ Gerenciamento de projetos</li>
                    <li class="text-muted mb-2">✓ Edição de perfil</li>
                    <li class="text-muted">✓ Histórico de atividades</li>
                </ul>
            </div>

        </div>
    </article>
<div style="display: flex; gap: 1rem; justify-content: center; margin-top: var(--spacing-2xl); flex-wrap: wrap;">
    <a href="index.php" class="btn-voltar">
        ← Voltar ao Início
    </a>
    <a href="logout.php" class="btn btn-error">
        🚪 Encerrar Sessão
    </a>
</div>

<p class="text-muted" style="font-size: 0.9rem; margin-top: var(--spacing-md); text-align: center;">
    Você será desconectado e redirecionado para a página inicial.
</p>


</main>
<?php require_once __DIR__ . '/includes/rodape.php'; ?>
