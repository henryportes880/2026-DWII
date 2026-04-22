<?php
/**
 * ========================================================
 * ARQUIVO: 04_sessoes/login.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 */

// 1. INÍCIO DA SESSÃO E PROTEÇÃO
session_start();
require_once __DIR__ . '/includes/auth.php';
redirecionar_se_logado();

// 2. CONFIGURAÇÕES INICIAIS
$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA = 'dwii2026';
$login = '';
$erros = [];
$agora = time();

// 3. LÓGICA DE BLOQUEIO POR TENTATIVAS
if (isset($_SESSION['bloqueado_ate']) && $agora < $_SESSION['bloqueado_ate']) {
    $minutos_restantes = ceil(($_SESSION['bloqueado_ate'] - $agora) / 60);
    $erros[] = "Muitas tentativas. Sistema bloqueado. Tente novamente em instantes.";
}

// 4. PROCESSAMENTO DO FORMULÁRIO (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($erros)) {
    // trim() limpa espaços vazios indesejados
    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // VALIDAÇÕES
    if (empty($login)) {
        $erros[] = 'O campo Usuário é obrigatório.';
    }

    if (empty($senha)) {
        $erros[] = 'O campo Senha é obrigatório.';
    }

    // PROCESSAMENTO SE NÃO HOUVER ERROS DE PREENCHIMENTO
    if (empty($erros)) {
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
                $erros[] = "Tentativas esgotadas. Sistema bloqueado por 1 minuto.";
            } else {
                $erros[] = "Usuário ou senha incorretos.";
            }
        }
    }
}

// 5. VARIÁVEIS DO TEMPLATE (Para o cabeçalho)
$nome = "Henry";
$pagina_atual = 'login';
$caminho_raiz = '../';
$titulo_pagina = 'Login | Acesso Restrito';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main>
    
    <div class="inicio">
        <h1>Acesso Restrito</h1>
        <p>Informe suas credenciais para entrar no sistema. (Aula 06 - Gestão de Sessões)</p>
    </div>

    <?php if (!empty($erros)): ?>
        <div class="alert-error">
            <strong>🚫 Atenção:</strong>
            <ul style="margin-left: 1.5rem; font-size: 0.9rem; margin-top: var(--spacing-sm);">
                <?php foreach ($erros as $erro): ?>
                    <li><?php echo htmlspecialchars($erro); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <article class="card">
        <form class="form-container" action="login.php" method="post">
            
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

            <button type="submit">Entrar no Sistema →</button>
        </form>
    </article>
    
    <div style="text-align: center; margin-top: var(--spacing-2xl);">
        <a href="../index.php" class="btn">← Voltar ao Início</a>
    </div>

</main>

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

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    main {
        animation: fadeInUp 0.8s ease-out;
    }

    .alert-error {
        animation: fadeInUp 0.6s ease-out;
    }

    .card {
        animation: fadeInUp 0.8s ease-out 0.1s backwards;
    }

    @media (max-width: 768px) {
        main {
            gap: 2rem;
        }
    }
</style>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>