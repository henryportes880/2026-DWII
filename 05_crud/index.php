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

<body class="hub-page">
<a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>
<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Gerenciador de Projetos</h1>
        <p class="tagline">Aula 07 - Listagem Dinâmica (Read)</p>
    </div>
</header>

<main class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div class="stats">
            <span class="badge-aula"><?= count($projetos) ?> projeto(s) encontrado(s)</span>
        </div>
        <a href="cadastrar.php" class="btn">➕ Novo Projeto</a>
    </div>

    <?php if ($cadastroOk): ?>
        <div class="alerta-sucesso" style="margin-bottom: 30px; padding: 15px; border-radius: 12px; background: rgba(34, 197, 94, 0.1); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.2); text-align: center;">
            ✅ Projeto cadastrado com sucesso!
        </div>
    <?php endif; ?>

    <?php if (empty($projetos)): ?>
        <div class="card card-apresentacao" style="text-align: center; padding: 60px;">
            <span style="font-size: 3rem; display: block; margin-bottom: 20px;">🔌</span>
            <h2 class="titulo-sessao">Nenhum projeto encontrado</h2>
            <p class="texto-destaque" style="margin-bottom: 25px;">Sua base de dados está vazia. Comece cadastrando seu primeiro trabalho!</p>
            <a href="cadastrar.php" class="btn">Cadastrar Agora</a>
        </div>
    <?php else: ?>
        <div class="grid-hub">
            <?php foreach ($projetos as $projeto): ?>
                <article class="card card-hub">
                    <div class="card-topo">
                        <span class="icone-projeto">📝</span>
                        <span class="badge-categoria"><?= htmlspecialchars($projeto['ano']) ?></span>
                    </div>
                    
                    <div class="card-corpo">
                        <h3><?= htmlspecialchars($projeto['nome']) ?></h3>
                        <p class="desc-hub">
                            <?= mb_strimwidth(htmlspecialchars($projeto['descricao']), 0, 120, "...") ?>
                        </p>
                    </div>
                    
                    <div class="tags" style="margin-top: 10px;">
                        <?php 
                        $tecs = explode(',', $projeto['tecnologias']);
                        foreach($tecs as $tec): ?>
                            <span class="tag"><?= trim(htmlspecialchars($tec)) ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="card-footer" style="margin-top: auto; padding-top: 20px; display: flex; flex-direction: column; gap: 10px;">
                        
                        <div style="display: flex; gap: 10px;">
                            <?php if ($projeto['link_github']): ?>
                                <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem; background: rgba(255,255,255,0.05);">
                                    🔗 GitHub
                                </a>
                            <?php endif; ?>
                            <a href="detalhes.php?id=<?= $projeto['id'] ?>" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem;">
                                Ver mais
                            </a>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <a href="editar.php?id=<?= $projeto['id'] ?>" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem; background-color: #3b82f6; border-color: #3b82f6; color: white;">
                                ✏️ Editar
                            </a>
                            <a href="excluir.php?id=<?= $projeto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este projeto? Esta ação não pode ser desfeita.');" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem; background-color: #ef4444; border-color: #ef4444; color: white;">
                                🗑️ Excluir
                            </a>
                        </div>
                        
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<footer class="main-footer" style="margin-top: 80px;">
    <div class="container">
        <p>Henry Rafael Ribeiro Portes © 2026 | Sistema CRUD de Projetos</p>
    </div>
</footer>

<?php include __DIR__ . '/../includes/rodape.php'; ?>
</body>