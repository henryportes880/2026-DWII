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

<div class="container">
    <header class="header-pagina">
        <h1 class="titulo-secao">➕ Novo Projeto</h1>
        <a href="index.php" class="btn-voltar">← Voltar para a lista</a>
    </header>

    <div class="form-wrapper">
        <form action="cadastrar.php" method="post" class="form-container">
            <?php if ($erro): ?>
                <div class="alerta-erro-simples">🚫 <?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nome">Nome do Projeto <span class="obrigatorio">*</span></label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($form['nome']) ?>" placeholder="Ex: E-commerce em PHP">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição <span class="obrigatorio">*</span></label>
                <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($form['descricao']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="tecnologias">Tecnologias <span class="obrigatorio">*</span></label>
                <input type="text" id="tecnologias" name="tecnologias" value="<?= htmlspecialchars($form['tecnologias']) ?>" placeholder="PHP, MySQL, CSS...">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="link_github">GitHub (opcional)</label>
                    <input type="url" id="link_github" name="link_github" value="<?= htmlspecialchars($form['link_github']) ?>">
                </div>
                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input type="number" id="ano" name="ano" value="<?= htmlspecialchars($form['ano']) ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-block">💾 Salvar Projeto</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../includes/rodape.php'; ?>