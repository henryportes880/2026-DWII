<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login(); 

require_once __DIR__ . '/includes/conexao.php';
$pdo = conectar();

$id = $_GET['id'] ?? null;
$projeto = null;
$erros = [];

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$projeto) { die('Projeto não encontrado'); }
} else {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $tecnologias = trim($_POST['tecnologias'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $ano = trim($_POST['ano'] ?? '');
    $link_github = trim($_POST['link_github'] ?? '');
    $link_deploy = trim($_POST['link_deploy'] ?? ''); // Esta coluna você vai criar com o comando ALTER acima

    if (empty($nome)) $erros[] = 'Campo nome é obrigatório';

    if (empty($erros)) {
        $sql = "UPDATE projetos SET 
                    nome = :nome, 
                    tecnologias = :tecnologias,
                    descricao = :descricao, 
                    ano = :ano, 
                    link_github = :link_github,
                    link_deploy = :link_deploy 
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':tecnologias', $tecnologias);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':ano', $ano);
        $stmt->bindValue(':link_github', $link_github);
        $stmt->bindValue(':link_deploy', $link_deploy);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Location: index.php?msg=editado');
            exit;
        } else {
            $erros[] = 'Erro ao atualizar no banco.';
        }
    }
}

$titulo_pagina = 'Editar Projeto';
include __DIR__ . '/../includes/cabecalho.php';
?>

<body class="hub-page">
    <div class="container" style="margin-top: 20px;">
        <a href="index.php" style="color: #3b82f6; text-decoration: none;">← Voltar ao Gerenciador</a>
    </div>

    <main class="container" style="margin-top: 30px;">
        <form action="editar.php?id=<?= $id ?>" method="POST" style="background: #1e293b; padding: 20px; border-radius: 10px; color: white;">
            <input type="hidden" name="id" value="<?= $projeto['id'] ?>">
            
            <label>Nome:</label><br>
            <input type="text" name="nome" value="<?= htmlspecialchars($projeto['nome']) ?>" style="width: 100%; margin-bottom: 15px; background: #334155; border: 1px solid #475569; color: white; padding: 8px;">

            <label>Tecnologias:</label><br>
            <input type="text" name="tecnologias" value="<?= htmlspecialchars($projeto['tecnologias']) ?>" style="width: 100%; margin-bottom: 15px; background: #334155; border: 1px solid #475569; color: white; padding: 8px;">

            <label>Descrição:</label><br>
            <textarea name="descricao" style="width: 100%; margin-bottom: 15px; background: #334155; border: 1px solid #475569; color: white; padding: 8px;"><?= htmlspecialchars($projeto['descricao']) ?></textarea>

            <label>Ano:</label><br>
            <input type="number" name="ano" value="<?= htmlspecialchars($projeto['ano']) ?>" style="width: 100%; margin-bottom: 15px; background: #334155; border: 1px solid #475569; color: white; padding: 8px;">

            <label>GitHub Link:</label><br>
            <input type="url" name="link_github" value="<?= htmlspecialchars($projeto['link_github'] ?? '') ?>" style="width: 100%; margin-bottom: 15px; background: #334155; border: 1px solid #475569; color: white; padding: 8px;">

            <label>Deploy Link:</label><br>
            <input type="url" name="link_deploy" value="<?= htmlspecialchars($projeto['link_deploy'] ?? '') ?>" style="width: 100%; margin-bottom: 15px; background: #334155; border: 1px solid #475569; color: white; padding: 8px;">

            <button type="submit" style="background: #3b82f6; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Salvar Alterações</button>
            <a href="index.php" style="color: #94a3b8; margin-left: 15px; text-decoration: none;">Cancelar</a>
        </form>
    </main>
</body>