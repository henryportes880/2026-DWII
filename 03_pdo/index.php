<?php
$titulo_pagina = "Catálogo de Tecnologias";
$pagina_atual  = "catalogo";

require_once 'includes/conexao.php';

$stmt = $pdo->query('SELECT * FROM tecnologias ORDER BY nome ASC');
$tecnologias = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php include 'includes/cab_pdo.php'; ?>
</head>

<body>

<div class="container">

<h1 class="titulo-secao">📚 Catálogo de Tecnologias</h1>

<p style="color: #6b7280; margin-bottom: 20px;">
<?php echo count($tecnologias); ?> tecnologia(s) cadastrada(s)
</p>

<?php foreach ($tecnologias as $tec): ?>

<div class="card">

<div style="display: flex; justify-content: space-between; align-items: center;">

<h3><?php echo htmlspecialchars($tec['nome']); ?></h3>

<span style="background: #f5e8e8; color: #3b579d; padding: 3px 10px; border-radius: 20px; font-size: 13px;">
<?php echo htmlspecialchars($tec['categoria']); ?>
</span>

</div>

<p><?php echo htmlspecialchars($tec['descricao']); ?></p>

<a href="/03_pdo/detalhe.php?id=<?php echo $tec['id']; ?>"
style="color: #3b579d; font-size: 14px; font-weight: bold; display: inline-block; margin-top: 10px;">
Ver detalhes →
</a>

</div>

<?php endforeach; ?>

</div>

<?php include 'includes/rod_pdo.php'; ?>

</body>
</html>