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
    <header>
        <h1 class="titulo-secao">📚 Catálogo de Tecnologias</h1>
        <p class="contador-stats">
            <?php echo count($tecnologias); ?> tecnologia(s) cadastrada(s)
        </p>
    </header>

    <?php foreach ($tecnologias as $tec): ?>
        <div class="card">
            <div class="card-header-flex">
                <h3><?php echo htmlspecialchars($tec['nome']); ?></h3>
                <span class="badge-categoria">
                    <?php echo htmlspecialchars($tec['categoria']); ?>
                </span>
            </div>

            <p class="card-descricao">
                <?php echo htmlspecialchars($tec['descricao']); ?>
            </p>

            <div class="card-footer">
                <a href="/03_pdo/detalhe.php?id=<?php echo $tec['id']; ?>" class="btn-link">
                    Ver detalhes →
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/rod_pdo.php'; ?>

</body>
</html>