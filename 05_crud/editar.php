<?php
// Exibe erros para depuração (útil durante o desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Requer autenticação (com base no seu código anterior)
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Conexão com o banco (ajustado para o seu caminho padrão)
require_once __DIR__ . '/includes/conexao.php';
$pdo = conectar();

// Inicializa variáveis
$id = $_GET['id'] ?? null;
$projeto = null;
$erros = [];
$sucesso = false;

// Fase 1: Busca dados do projeto para preencher o formulário
if ($id) {
    // Usando prepared statement com parâmetros nomeados
    $stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se o projeto não existir, encerra a execução
    if (!$projeto) {
        die('Projeto não encontrado');
    }
} else {
    // Se não houver ID na URL, redireciona de volta para o hub
    header('Location: hub.php');
    exit;
}

// Fase 2: Processa o envio do formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe e sanitiza os dados do formulário
    $id = $_POST['id'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $tecnologias = trim($_POST['tecnologias'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $ano = trim($_POST['ano'] ?? '');
    $link_github = trim($_POST['link_github'] ?? '');
    $link_deploy = trim($_POST['link_deploy'] ?? '');

    // Validação básica de campos obrigatórios
    if (empty($nome)) {
        $erros[] = 'Campo nome é obrigatório';
    }
    if (empty($tecnologias)) {
        $erros[] = 'Campo tecnologias é obrigatório';
    }

    // Se não houver erros de validação, procede com a atualização
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

        // Executa a query de atualização
        if ($stmt->execute()) {
            $sucesso = true;
            // Redireciona de volta para o hub com uma mensagem de sucesso
            header('Location: hub.php?edit=ok');
            exit;
        } else {
            $erros[] = 'Erro ao atualizar projeto no banco de dados';
        }
    }
}

// Configurações da página (com base no seu código anterior)
$titulo_pagina = 'Editar Projeto';
$caminho_raiz = '../';
include __DIR__ . '/../includes/cabecalho.php';
?>

<body class="hub-page">
    <a href="hub.php" class="btn-voltar">← Voltar ao Gerenciador</a>
    <header class="hub-header">
        <div class="container">
            <h1>Editar Projeto</h1>
            <p class="tagline">Atualize os dados do seu trabalho</p>
        </div>
    </header>

    <main class="container">
        <?php if (!empty($erros)): ?>
            <div class="alerta-erro" style="margin-bottom: 30px; padding: 15px; border-radius: 12px; background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); text-align: center;">
                <ul style="list-style: none; margin: 0; padding: 0;">
                    <?php foreach ($erros as $erro): ?>
                        <li>❌ <?= htmlspecialchars($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="editar.php?id=<?= $id ?>" method="POST" class="card card-hub" style="padding: 30px;">
            <input type="hidden" name="id" value="<?= htmlspecialchars($projeto['id'] ?? '') ?>">

            <div class="campo" style="margin-bottom: 20px;">
                <label for="nome" style="display: block; margin-bottom: 5px;">Nome do Projeto:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($projeto['nome'] ?? '') ?>" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white;">
            </div>

            <div class="campo" style="margin-bottom: 20px;">
                <label for="tecnologias" style="display: block; margin-bottom: 5px;">Tecnologias (separadas por vírgula):</label>
                <input type="text" id="tecnologias" name="tecnologias" value="<?= htmlspecialchars($projeto['tecnologias'] ?? '') ?>" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white;">
            </div>

            <div class="campo" style="margin-bottom: 20px;">
                <label for="descricao" style="display: block; margin-bottom: 5px;">Descrição:</label>
                <textarea id="descricao" name="descricao" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white; height: 100px;"><?= htmlspecialchars($projeto['descricao'] ?? '') ?></textarea>
            </div>

            <div class="campo" style="margin-bottom: 20px;">
                <label for="ano" style="display: block; margin-bottom: 5px;">Ano:</label>
                <input type="number" id="ano" name="ano" value="<?= htmlspecialchars($projeto['ano'] ?? '') ?>" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white;">
            </div>

            <div class="campo" style="margin-bottom: 20px;">
                <label for="link_github" style="display: block; margin-bottom: 5px;">Link do GitHub:</label>
                <input type="url" id="link_github" name="link_github" value="<?= htmlspecialchars($projeto['link_github'] ?? '') ?>" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white;">
            </div>

            <div class="campo" style="margin-bottom: 30px;">
                <label for="link_deploy" style="display: block; margin-bottom: 5px;">Link do Deploy/Produção:</label>
                <input type="url" id="link_deploy" name="link_deploy" value="<?= htmlspecialchars($projeto['link_deploy'] ?? '') ?>" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white;">
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <a href="hub.php" class="btn" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); text-align: center; color: white;">Cancelar</a>
                <button type="submit" class="btn" style="background-color: #3b82f6; border-color: #3b82f6; color: white;">Salvar Alterações</button>
            </div>
        </form>
    </main>

    <?php include __DIR__ . '/../includes/rodape.php'; ?>
</body>