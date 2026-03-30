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
    <title>Login | Sistema</title>
    <link rel="stylesheet" href="../includes/style.css">
</head>
<body class="body-login">
    <div class="container container-login">
        <div class="card card-login">
            <h2>🔒 Acesso Restrito</h2>
            
            <?php if ($erro): ?>
                <div class="alerta-erro-simples"><?= $erro ?></div>
            <?php endif; ?>

            <form method="post" class="form-login">
                <div class="form-group">
                    <label>Usuário</label>
                    <input type="text" name="usuario" placeholder="usuário" value="<?= htmlspecialchars($login) ?>" required>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="••••••••" required>
                </div>

                <button class="btn btn-block">Entrar no Sistema</button>
            </form>

            <div class="card-footer-login">
                <a href="../index.php" class="link-voltar">← Voltar ao início</a>
            </div>
        </div>
    </div>
</body>
</html>