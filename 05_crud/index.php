<?php
// Exibe erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();
// Busca os projetos ordenando pelos mais recentes
$stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
$projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tratamento de mensagens de feedback
$mensagem = '';
$tipoAlerta = 'sucesso'; // padrão verde

if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok') {
    $mensagem = "✅ Projeto cadastrado com sucesso!";
} elseif (isset($_GET['msg']) && $_GET['msg'] === 'editado') {
    $mensagem = "✏️ Projeto atualizado com sucesso!";
} elseif (isset($_GET['msg']) && $_GET['msg'] === 'excluido') {
    $mensagem = "🗑️ Projeto removido com sucesso!";
    $tipoAlerta = 'erro'; // muda para vermelho se quiser
}

$titulo_pagina = 'Meus Projetos';
$caminho_raiz  = '../';
include __DIR__ . '/../includes/cabecalho.php';
?>

<body class="hub-page">
<div class="container" style="margin-top: 20px;">
    <a href="../index.php" class="btn-voltar" style="color: white; text-decoration: none; background: rgba(255,255,255,0.1); padding: 8px 15px; border-radius: 8px;">← Voltar ao Repositório</a>
</div>

<header class="hub-header">
    <div class="container">
        <h1>Gerenciador de Projetos</h1>
        <p class="tagline">Módulo CRUD - Update & Delete</p>
    </div>
</header>

<main class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div class="stats">
            <span class="badge-aula"><?= count($projetos) ?> projeto(s) encontrado(s)</span>
        </div>
        <a href="cadastrar.php" class="btn" style="background-color: #22c55e; border: none; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">➕ Novo Projeto</a>
    </div>

    <?php if ($mensagem): ?>
        <div class="alerta-sucesso" style="margin-bottom: 30px; padding: 15px; border-radius: 12px; 
            background: <?= $tipoAlerta === 'sucesso' ? 'rgba(34, 197, 94, 0.1)' : 'rgba(239, 68, 68, 0.1)' ?>; 
            color: <?= $tipoAlerta === 'sucesso' ? '#4ade80' : '#ef4444' ?>; 
            border: 1px solid <?= $tipoAlerta === 'sucesso' ? 'rgba(34, 197, 94, 0.2)' : 'rgba(239, 68, 68, 0.2)' ?>; 
            text-align: center;">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>

    <?php if (empty($projetos)): ?>
        <div class="card card-apresentacao" style="text-align: center; padding: 60px; background: #1e293b; border-radius: 15px;">
            <span style="font-size: 3rem; display: block; margin-bottom: 20px;">🔌</span>
            <h2 style="color: white;">Nenhum projeto encontrado</h2>
            <p style="color: #94a3b8; margin-bottom: 25px;">Sua base de dados está vazia. Comece cadastrando seu primeiro trabalho!</p>
            <a href="cadastrar.php" class="btn">Cadastrar Agora</a>
        </div>
    <?php else: ?>
        <div class="grid-hub" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <?php foreach ($projetos as $projeto): ?>
                <article class="card card-hub" style="background: #1e293b; padding: 20px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1); display: flex; flex-direction: column;">
                    <div class="card-topo" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <span class="icone-projeto" style="font-size: 1.5rem;">📝</span>
                        <span class="badge-categoria" style="background: rgba(59, 130, 246, 0.2); color: #3b82f6; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem;"><?= htmlspecialchars($projeto['ano']) ?></span>
                    </div>
                    
                    <div class="card-corpo">
                        <h3 style="color: white; margin-bottom: 10px;"><?= htmlspecialchars($projeto['nome']) ?></h3>
                        <p class="desc-hub" style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5;">
                            <?= mb_strimwidth(htmlspecialchars($projeto['descricao']), 0, 100, "...") ?>
                        </p>
                    </div>
                    
                    <div class="tags" style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 5px;">
                        <?php 
                        $tecs = explode(',', $projeto['tecnologias']);
                        foreach($tecs as $tec): if(trim($tec) == "") continue; ?>
                            <span class="tag" style="background: rgba(255,255,255,0.05); color: #cbd5e1; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; border: 1px solid rgba(255,255,255,0.1);"><?= trim(htmlspecialchars($tec)) ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="card-footer" style="margin-top: auto; padding-top: 20px; display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; gap: 10px;">
                            <?php if (!empty($projeto['link_github'])): ?>
                                <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem; background: rgba(255,255,255,0.05); text-decoration: none; color: white; padding: 8px; border-radius: 6px;">🔗 GitHub</a>
                            <?php endif; ?>
                            <a href="detalhes.php?id=<?= $projeto['id'] ?>" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem; text-decoration: none; color: white; background: rgba(255,255,255,0.1); padding: 8px; border-radius: 6px;">Ver mais</a>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <a href="editar.php?id=<?= $projeto['id'] ?>" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem; background-color: #3b82f6; color: white; text-decoration: none; padding: 8px; border-radius: 6px;">✏️ Editar</a>
                            <a href="excluir.php?id=<?= $projeto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este projeto?');" class="btn" style="flex: 1; text-align: center; font-size: 0.8rem; background-color: #ef4444; color: white; text-decoration: none; padding: 8px; border-radius: 6px;">🗑️ Excluir</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/../includes/rodape.php'; ?>
</body>