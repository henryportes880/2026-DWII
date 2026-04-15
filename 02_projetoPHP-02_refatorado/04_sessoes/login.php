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

<main style="display: flex; align-items: center; justify-content: center; min-height: 60vh; padding: var(--spacing-2xl) 0;">
    
    <article class="card" style="width: 100%; max-width: 420px; text-align: center;">
        
        <!-- Ícone -->
        <div class="flex-center" style="width: 64px; height: 64px; border-radius: var(--radius-full); background: rgba(21, 101, 192, 0.1); color: var(--primary); font-size: 1.8rem; margin: 0 auto var(--spacing-lg);">
            🔐
        </div>
        
        <!-- Título -->
        <h1 style="font-size: clamp(1.5rem, 4vw, 1.8rem); margin-bottom: var(--spacing-sm); color: var(--neutral-900);">
            Acesso Restrito
        </h1>
        
        <!-- Badge -->
        <div class="mb-4">
            <span class="badge">Aula 06 - Gestão de Sessões</span>
        </div>

        <!-- Alerta de Erro -->
        <?php if ($erro): ?>
            <div class="alert-error" style="margin-bottom: var(--spacing-lg); text-align: left;">
                <span style="font-size: 1.2rem;">🚫</span>
                <span><?php echo htmlspecialchars($erro); ?></span>
            </div>
        <?php endif; ?>

        <!-- Formulário -->
        <form action="login.php" method="post" class="form-container">
            
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="usuario" 
                       value="<?php echo htmlspecialchars($login); ?>" 
                       placeholder="Ex: admin" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" 
                       placeholder="••••••••" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn btn-large btn-block">
                Entrar no Sistema →
            </button>
        </form>

        <!-- Link Voltar -->
        <div style="margin-top: var(--spacing-2xl); padding-top: var(--spacing-lg); border-top: 1px solid var(--neutral-200);">
            <a href="../index.php" class="text-muted" style="font-size: 0.95rem; font-weight: 500; transition: var(--transition-fast);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--neutral-500)'">
                ← Voltar ao Início
            </a>
        </div>
        
    </article>

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

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
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
        animation: slideDown 0.6s ease-out;
    }

    .alert-error {
        animation: slideDown 0.5s ease-out;
    }

    @media (max-width: 768px) {
        main {
            min-height: auto;
            padding: var(--spacing-lg) 0;
        }

        .card {
            margin: 0 var(--spacing-lg);
        }
    }
</style>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
