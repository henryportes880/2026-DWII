<?php
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

$erro = '';
$form = [
    'nome' => '', 'descricao' => '', 'tecnologias' => '', 
    'link_github' => '', 'ano' => date('Y'),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['nome']        = trim($_POST['nome'] ?? '');
    $form['descricao']   = trim($_POST['descricao'] ?? '');
    $form['tecnologias'] = trim($_POST['tecnologias'] ?? '');
    $form['link_github'] = trim($_POST['link_github'] ?? '');
    $form['ano']         = (int) ($_POST['ano'] ?? date('Y'));

    if ($form['nome'] === '') {
        $erro = 'O nome do projeto é obrigatório.';
    } elseif ($form['descricao'] === '') {
        $erro = 'A descrição é obrigatória.';
    }

    if ($erro === '') {
        $pdo = conectar();
        $sql = 'INSERT INTO projetos (nome, descricao, tecnologias, link_github, ano)
                VALUES (:nome, :descricao, :tecnologias, :link_github, :ano)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'        => $form['nome'],
            ':descricao'   => $form['descricao'],
            ':tecnologias' => $form['tecnologias'],
            ':link_github' => $form['link_github'] !== '' ? $form['link_github'] : null,
            ':ano'         => $form['ano'],
        ]);
        header('Location: index.php?cadastro=ok');
        exit;
    }
}

$titulo_pagina = 'Cadastrar Projeto';
$caminho_raiz  = '../';
include __DIR__ . '/../includes/cabecalho.php';
?>

<body class="hub-page">
<a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>
<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Novo Projeto</h1>
        <p class="tagline">Aula 07 - Operação de Inserção (Create)</p>
    </div>
</header>

<main class="container">
    <div style="margin-bottom: 25px;">
        <a href="index.php" class="btn-voltar">← Voltar para a lista de projetos</a>
    </div>

    <div class="form-wrapper">
        <form action="cadastrar.php" method="post" class="form-container">
            <?php if ($erro): ?>
                <div class="alerta-erro" style="margin-bottom: 20px; padding: 12px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2);">
                    🚫 <?php echo htmlspecialchars($erro); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nome">Nome do Projeto <span style="color: var(--accent);">*</span></label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($form['nome']) ?>" placeholder="Ex: E-commerce em PHP">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição <span style="color: var(--accent);">*</span></label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva brevemente o projeto..."><?= htmlspecialchars($form['descricao']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="tecnologias">Tecnologias <span style="color: var(--accent);">*</span></label>
                <input type="text" id="tecnologias" name="tecnologias" value="<?= htmlspecialchars($form['tecnologias']) ?>" placeholder="PHP, MySQL, CSS...">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="link_github">GitHub (opcional)</label>
                    <input type="url" id="link_github" name="link_github" value="<?= htmlspecialchars($form['link_github']) ?>" placeholder="https://github.com/...">
                </div>
                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input type="number" id="ano" name="ano" value="<?= htmlspecialchars($form['ano']) ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-block" style="width: 100%; margin-top: 20px;">💾 Salvar Projeto</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../includes/rodape.php'; ?>
</body>