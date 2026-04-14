<?php
// Caminho relativo da subpasta 03 pdo até a raiz
$caminho_raiz = '../';

// Conexão
require_once 'includes/conexao.php';

// Validar ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

// Consulta segura
$stmt = $pdo->prepare('SELECT * FROM tecnologias WHERE id = :id');
$stmt->execute(['id' => $id]);
$tec = $stmt->fetch();

if (!$tec) {
    header('Location: index.php');
    exit;
}

// Variáveis globais
$titulo_pagina = htmlspecialchars($tec['nome']) . " | Catálogo";
$pagina_atual = "catalogo";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'includes/cab_pdo.php'; ?>
</head>

<body class="hub-page">
<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Detalhes do Item</h1>
        <p class="tagline">Aula 05 - Consulta de Dados com PDO</p>
    </div>
</header>

<div class="container">
    <div class="header-acoes" style="margin-top: 20px;">
        <a href="index.php" class="btn-voltar">
            ← Voltar ao catálogo
        </a>
    </div>

    <div class="card card-detalhe">
        <div class="card-header-flex">
            <h1 class="titulo-detalhe">
                <?php echo htmlspecialchars($tec['nome']); ?>
            </h1>
            <span class="badge-categoria">
                <?php echo htmlspecialchars($tec['categoria']); ?>
            </span>
        </div>

        <p class="descricao-detalhe">
            <?php echo htmlspecialchars($tec['descricao']); ?>
        </p>

        <div class="tabela-container">
            <table class="tabela-dados">
                <tr>
                    <th>ID</th>
                    <td><?php echo $tec['id']; ?></td>
                </tr>
                <tr>
                    <th>Ano de criação</th>
                    <td><?php echo $tec['ano_criacao']; ?></td>
                </tr>
                <tr>
                    <th>Cadastrado em</th>
                    <td><?php echo date('d/m/Y \à\s H:i', strtotime($tec['criado_em'])); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/rod_pdo.php'; ?>

</body>
</html>