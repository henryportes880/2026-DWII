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

<body>

<div class="container">

<a href="index.php" style="color: #3b579d; font-weight: bold;">
← Voltar ao catálogo
</a>

<div class="card" style="margin-top: 20px;">

<div style="display:flex;justify-content:space-between;align-items:flex-start;">

<h1 style="color:#3b579d;margin:0 0 8px;font-size:24px;">
<?php echo htmlspecialchars($tec['nome']); ?>
</h1>

<span style="background:#e8edf5;color:#3b579d;padding:4px 12px;border-radius:20px;font-size:13px;font-weight:bold;">
<?php echo htmlspecialchars($tec['categoria']); ?>
</span>

</div>

<p style="font-size:16px;margin:16px 0;">
<?php echo htmlspecialchars($tec['descricao']); ?>
</p>

<table style="width:100%;border-collapse:collapse;margin-top:20px;font-size:14px;">

<tr style="background:#f3f4f6;">
<td style="padding:10px;border:1px solid #e5e7eb;font-weight:bold;width:160px;">ID</td>
<td style="padding:10px;border:1px solid #e5e7eb;">
<?php echo $tec['id']; ?>
</td>
</tr>

<tr>
<td style="padding:10px;border:1px solid #e5e7eb;font-weight:bold;">Ano de criação</td>
<td style="padding:10px;border:1px solid #e5e7eb;">
<?php echo $tec['ano_criacao']; ?>
</td>
</tr>

<tr style="background:#f3f4f6;">
<td style="padding:10px;border:1px solid #e5e7eb;font-weight:bold;">Cadastrado em</td>
<td style="padding:10px;border:1px solid #e5e7eb;">
<?php echo date('d/m/Y \à\s H:i', strtotime($tec['criado_em'])); ?>
</td>
</tr>

</table>

</div>
</div>

<?php include 'includes/rod_pdo.php'; ?>

</body>
</html>