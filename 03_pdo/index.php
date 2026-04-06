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

<body class="hub-page">

<a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>

<header class="hub-header">
    <div class="container">
        <h1>Catálogo de Tecnologias</h1>
        <p class="tagline">Aula 05 - Listagem de Dados com PDO</p>
    </div>
</header>

<main class="container">
    <div style="margin-bottom: 30px;">
        <p class="contador-stats">
            <span class="badge-aula"><?php echo count($tecnologias); ?> tecnologia(s) cadastrada(s)</span>
        </p>
    </div>

    <div class="grid-hub">
        <?php foreach ($tecnologias as $tec): ?>
            <article class="card card-hub">
                <div class="card-topo">
                    <span class="icone-projeto">💻</span>
                    <span class="badge-categoria">
                        <?php echo htmlspecialchars($tec['categoria']); ?>
                    </span>
                </div>

                <div class="card-corpo">
                    <h3><?php echo htmlspecialchars($tec['nome']); ?></h3>
                    <p class="desc-hub">
                        <?php 
                            // Limita a descrição para não quebrar o layout do card
                            $desc = htmlspecialchars($tec['descricao']);
                            echo (strlen($desc) > 100) ? substr($desc, 0, 100) . '...' : $desc; 
                        ?>
                    </p>
                </div>

                <div class="card-footer" style="margin-top: auto;">
                    <a href="detalhe.php?id=<?php echo $tec['id']; ?>" class="btn btn-block">
                        Ver detalhes →
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'includes/rod_pdo.php'; ?>

</body>
</html>