<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: painel.php');
    exit;
}

$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA = 'dwii2026';

$erro = '';
$login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = $login;
        $_SESSION['logado_em'] = date('d/m/Y H:i:s');
        header('Location: painel.php');
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema de Sessões</title>
    <link rel="stylesheet" href="../includes/style.css">
</head>
<body class="hub-page">
    <a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>
<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Acesso Restrito</h1>
        <p class="tagline">Aula 06 - Gerenciamento de Sessões e Segurança</p>
    </div>
</header>

<main class="container container-centro" style="margin-top: 50px;">
    <div class="card card-login" style="max-width: 400px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 25px;">
            <span style="font-size: 3rem;">🔒</span>
            <h2 style="margin-top: 10px;">Login</h2>
        </div>
        
        <?php if ($erro): ?>
            <div class="alerta-erro" style="margin-bottom: 20px; padding: 10px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); text-align: center;">
                <?= $erro ?>
            </div>
        <?php endif; ?>

        <form method="post" class="form-container">
            <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="usuario" placeholder="Digite seu usuário" value="<?= htmlspecialchars($login) ?>" required>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="••••••••" required>
            </div>

            <button class="btn btn-block" style="width: 100%; margin-top: 10px;">Entrar no Sistema</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="esqueci.php" class="btn-link" style="font-size: 0.85rem; opacity: 0.7;">Esqueceu a senha?</a>
        </div>
    </div>
</main>

<footer class="main-footer" style="margin-top: 80px; text-align: center; padding: 20px; color: var(--text-sec);">
    <div class="container">
        <p>Henry Rafael Ribeiro Portes © 2026</p>
    </div>
</footer>

</body>
</html>