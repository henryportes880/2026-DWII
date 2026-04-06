<?php
// Exibe erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Requer autenticação
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Conexão com o banco
require_once __DIR__ . '/includes/conexao.php';
$pdo = conectar();

// Pega o ID da URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Busca os detalhes do projeto específico
    $stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se o projeto não existir no banco
    if (!$projeto) {
        die('Erro: Projeto não encontrado.');
    }
} else {
    // Se não houver ID na URL, volta para a listagem
    header('Location: index.php');
    exit;
}

$titulo_pagina = 'Detalhes do Projeto - ' . htmlspecialchars($projeto['nome']);
$caminho_raiz  = '../';
include __DIR__ . '/../includes/cabecalho.php';
?>

<body class="hub-page">
    <div class="container" style="margin-top: 20px;">
        <a href="index.php" class="btn-voltar" style="color: white; text-decoration: none; background: rgba(255,255,255,0.1); padding: 8px 15px; border-radius: 8px;">← Voltar à Listagem</a>
    </div>

    <header class="hub-header">
        <div class="container">
            <h1><?= htmlspecialchars($projeto['nome']) ?></h1>
            <p class="tagline">Publicado em: <?= htmlspecialchars($projeto['ano']) ?></p>
        </div>
    </header>

    <main class="container">
        <div class="card card-hub" style="background: #1e293b; padding: 40px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1);">
            
            <section style="margin-bottom: 30px;">
                <h3 style="color: #3b82f6; margin-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px;">📄 Descrição do Projeto</h3>
                <p style="color: #cbd5e1; line-height: 1.8; font-size: 1.1rem; white-space: pre-wrap;"><?= htmlspecialchars($projeto['descricao']) ?></p>
            </section>

            <section style="margin-bottom: 30px;">
                <h3 style="color: #3b82f6; margin-bottom: 15px;">🛠️ Tecnologias Utilizadas</h3>
                <div class="tags" style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <?php 
                    $tecs = explode(',', $projeto['tecnologias']);
                    foreach($tecs as $tec): if(trim($tec) == "") continue; ?>
                        <span class="tag" style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; padding: 5px 15px; border-radius: 6px; border: 1px solid rgba(59, 130, 246, 0.3);"><?= trim(htmlspecialchars($tec)) ?></span>
                    <?php endforeach; ?>
                </div>
            </section>

            <section style="margin-bottom: 40px;">
                <h3 style="color: #3b82f6; margin-bottom: 15px;">🔗 Links e Acessos</h3>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <?php if (!empty($projeto['link_github'])): ?>
                        <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" class="btn" style="background: #334155; color: white; text-decoration: none; padding: 12px 25px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <span>📁</span> Repositório no GitHub
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($projeto['link_deploy'])): ?>
                        <a href="<?= htmlspecialchars($projeto['link_deploy']) ?>" target="_blank" class="btn" style="background: #22c55e; color: white; text-decoration: none; padding: 12px 25px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <span>🚀</span> Visualizar Projeto Online
                        </a>
                    <?php endif; ?>
                </div>
            </section>

            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin-bottom: 30px;">

            <div style="display: flex; justify-content: flex-end; gap: 15px;">
                <a href="editar.php?id=<?= $projeto['id'] ?>" class="btn" style="background: #3b82f6; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px;">✏️ Editar Dados</a>
                <a href="excluir.php?id=<?= $projeto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn" style="background: #ef4444; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px;">🗑️ Excluir Projeto</a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/rodape.php'; ?>
</body>