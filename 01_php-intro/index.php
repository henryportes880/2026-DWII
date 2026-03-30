<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "inicio";

include '../includes/cabecalho.php';
include '../includes/nav.php';
?>

<section class="hero">
    <div class="hero-content">
        <img src="../imgs/henry.jpg" alt="Foto de Henry" class="hero-avatar" />
        <h1><?php echo $nome; ?></h1>
        <p class="hero-subtitle"><?php echo $profissao; ?> — <?php echo $curso; ?></p>
    </div>
</section>

<main class="container">
    <div class="card card-apresentacao">
        <h2 class="titulo-sessao">Início</h2>
        <p class="texto-destaque">
            Bem-vindo ao meu portfólio! Aqui você encontrará um pouco mais sobre quem eu sou, minha trajetória, minhas habilidades e os projetos que venho desenvolvendo ao longo da minha jornada na área de desenvolvimento web.
        </p>
    </div>
</main>

<?php include '../includes/rodape.php'; ?>