<?php
/**
 * ========================================================
 * ARQUIVO: 04_sessoes/login.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 */

// 1. Início da Sessão (Sempre no topo)
session_start();

// 2. Proteção: Se já estiver logado, redireciona para o painel
require_once __DIR__ . '/includes/auth.php';
redirecionar_se_logado();

// 3. Configurações e Credenciais (Virão do BD futuramente)
$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA = 'dwii2026';
$erro = '';
$login = '';
$agora = time();

// 4. Lógica de Bloqueio por Tentativas
if (isset($_SESSION['bloqueado_ate']) && $agora < $_SESSION['bloqueado_ate']) {
    $minutos_restantes = ceil(($_SESSION['bloqueado_ate'] - $agora) / 60);
    $erro = "Muitas tentativas. Sistema bloqueado. Tente novamente em instantes.";
}

// 5. Processamento do Formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($erro)) {
    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA) {
        // Sucesso: Regenera ID por segurança
        session_regenerate_id(true);
        $_SESSION['usuario'] = $login;
        $_SESSION['logado_em'] = date('d/m/Y \à\s H:i');
        $_SESSION['tentativas'] = 0; // Reseta contador
        
        header('Location: painel.php');
        exit;
    } else {
        // Erro: Incrementa contador
        $_SESSION['tentativas'] = ($_SESSION['tentativas'] ?? 0) + 1;
        
        if ($_SESSION['tentativas'] >= 3) {
            $_SESSION['bloqueado_ate'] = time() + 60; // Bloqueia por 1 minuto
            $_SESSION['tentativas'] = 0;
            $erro = "Tentativas esgotadas. Sistema bloqueado por 1 minuto.";
        } else {
            $erro = "Usuário ou senha incorretos.";
        }
    }
}

// 6. Variáveis de Template
$titulo_pagina = 'Login | Acesso Restrito';
$caminho_raiz = '../';
$pagina_atual = 'login';

// 7. Renderização do Cabeçalho
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main>
    <article class="card" style="max-width: 420px; margin: 2rem auto; padding: 2.5rem 2rem; text-align: center;">
        
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; border-radius: var(--radius-pill); background: var(--bg-surface-hover); color: var(--primary); font-size: 1.8rem; margin-bottom: 1rem; border: 2px solid var(--border-light);">
            🔐
        </div>
        
        <h1 style="font-size: clamp(1.5rem, 4vw, 1.8rem); margin-bottom: 0.5rem; color: var(--text-heading);">Acesso Restrito</h1>
        
        <div style="margin-bottom: 2rem;">
            <span class="badge" style="background: var(--bg-surface); border: 1px solid var(--border-light);">Aula 06 - Gestão de Sessões</span>
        </div>

        <?php if ($erro): ?>
            <div style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; text-align: left; font-size: 0.95rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: var(--shadow-sm);">
                <span style="font-size: 1.2rem;">🚫</span>
                <span style="font-weight: 500; line-height: 1.4;"><?php echo htmlspecialchars($erro); ?></span>
            </div>
        <?php endif; ?>

        <form action="login.php" method="post" style="display: flex; flex-direction: column; gap: 1.25rem; text-align: left;">
            
            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label for="usuario" style="font-weight: 600; color: var(--text-heading); font-size: 0.95rem;">Usuário:</label>
                <input type="text" name="usuario" id="usuario" 
                       value="<?php echo htmlspecialchars($login); ?>" 
                       placeholder="Ex: admin" required autocomplete="username"
                       style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-light); border-radius: var(--radius-sm); background: var(--bg-surface); font-family: inherit; font-size: 1rem; outline: none;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label for="senha" style="font-weight: 600; color: var(--text-heading); font-size: 0.95rem;">Senha:</label>
                <input type="password" name="senha" id="senha" 
                       placeholder="••••••••" required autocomplete="current-password"
                       style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-light); border-radius: var(--radius-sm); background: var(--bg-surface); font-family: inherit; font-size: 1rem; outline: none;">
            </div>

            <button type="submit" class="btn" style="width: 100%; margin-top: 0.5rem; padding: 0.85rem; font-size: 1.05rem; justify-content: center;">
                Entrar no Sistema →
            </button>
        </form>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-light);">
            <a href="../index.php" style="color: var(--text-muted); text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: color 0.2s;">
                ← Voltar ao Início
            </a>
        </div>
        
    </article>
</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>