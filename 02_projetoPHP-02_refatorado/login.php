<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Arquivo : login.php (raiz)
 * Descrição : Autenticação real contra tabela usuarios (bcrypt).
 */

require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/auth.php';

// Se já está logado, não faz sentido ver o formulário.
if (usuario_logado()) {
    header('Location: painel.php');
    exit;
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($login === '' || $senha === '') {
        $erros[] = 'Informe usuário e senha.';
    } else {
        $pdo = conectar();

        // Busca usuário ATIVO (status='ativo' evita login de conta desabilitada).
        $stmt = $pdo->prepare(
            "SELECT id, login, senha FROM usuarios
            WHERE login = :login AND status = 'ativo'
            LIMIT 1"
        );
        $stmt->execute([':login' => $login]);
        $usuario = $stmt->fetch();

        // password_verify compara o texto digitado com o hash bcrypt.
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            
            // Defesa contra session fixation: troca o ID da sessão.
            session_regenerate_id(true);
            $_SESSION['usuario'] = $usuario['login'];

            // Auditoria: registra login bem-sucedido.
            $log = $pdo->prepare(
                "INSERT INTO logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
                VALUES ('usuarios', :id, 'LOGIN', :login, 'Login bem-sucedido')"
            );
            $log->execute([
                ':id' => $usuario['id'],
                ':login' => $usuario['login'],
            ]);

            header('Location: painel.php');
            exit;

        } else {
            // Auditoria: registra tentativa falha (sem revelar se foi login ou senha).
            $log = $pdo->prepare(
                "INSERT INTO logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
                VALUES ('usuarios', 0, 'LOGIN_FAIL', :login, 'Credenciais inválidas')"
            );
            $log->execute([':login' => $login]);

            // Mensagem genérica: não dizer se o erro foi no login ou na senha.
            $erros[] = 'Usuário ou senha inválidos.';
        }
    }
}

$pagina_atual = 'login';
$titulo_pagina = 'Login - Portfólio';
$caminho_raiz = './';

require_once __DIR__ . '/includes/cabecalho.php';
?>

<main>
    
    <div class="inicio">
        <h1>Faça Login</h1>
        <p>Acesse sua conta para continuar navegando.</p>
    </div>

    <?php if (!empty($erros)): ?>
        <div class="alert-error">
            <strong>🚫 Corrija os erros abaixo:</strong>
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
                <label for="login">Usuário:</label>
                <input 
                    type="text" 
                    name="login" 
                    id="login"
                    placeholder="Digite seu usuário"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input 
                    type="password" 
                    name="senha" 
                    id="senha"
                    placeholder="Digite sua senha"
                    required
                >
            </div>

            <button type="submit">Entrar</button>
        </form>
    </article>

    <div style="text-align: center; margin-top: var(--spacing-2xl);">
        <p class="text-muted" style="font-size: 0.9rem;">
            Não tem conta? <a href="cadastro.php" class="text-primary" style="font-weight: 600;">Cadastre-se aqui</a>
        </p>
    </div>

</main>
<?php require_once __DIR__ . '/includes/rodape.php'; ?>
