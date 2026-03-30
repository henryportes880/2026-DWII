<?php
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();
$stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
$projetos = $stmt->fetchAll();

$cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';
$titulo_pagina = 'Meus Projetos';
$caminho_raiz  = '../';
include __DIR__ . '/../includes/cabecalho.php';
?>

<div class="container">
    <div class="header-flex">
        <h1 class="titulo-secao">📂 Meus Projetos</h1>
        <a href="cadastrar.php" class="btn">➕ Novo Projeto</a>
    </div>

    <?php if ($cadastroOk): ?>
        <div class="alerta-sucesso">✅ Projeto cadastrado com sucesso!</div>
    <?php endif; ?>

    <?php if (empty($projetos)): ?>
        <div class="card card-vazio">
            <span class="icone-vazio">🔌</span>
            <p>Nenhum projeto encontrado.</p>
            <a href="cadastrar.php" class="btn btn-outline">Começar agora</a>
        </div>
    <?php else: ?>
        <div class="grid-projetos-crud">
            <?php foreach ($projetos as $projeto): ?>
                <div class="card card-projeto-lista">
                    <div class="projeto-header">
                        <h3><?= htmlspecialchars($projeto['nome']) ?></h3>
                        <span class="badge-ano"><?= htmlspecialchars($projeto['ano']) ?></span>
                    </div>
                    
                    <p class="projeto-desc"><?= htmlspecialchars($projeto['descricao']) ?></p>
                    
                    <div class="projeto-meta">
                        <small>🛠️ <?= htmlspecialchars($projeto['tecnologias']) ?></small>
                    </div>

                    <?php if ($projeto['link_github']): ?>
                        <div class="projeto-footer">
                            <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" class="btn-github">
                                🔗 GitHub
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <footer class="footer-listagem">
        <a href="<?= $caminho_raiz ?>index.php" class="link-voltar">🏠 Voltar ao repositório</a>
        <span class="contador"><?= count($projetos) ?> projeto(s)</span>
    </footer>
</div>

<?php include __DIR__ . '/../includes/rodape.php'; ?>