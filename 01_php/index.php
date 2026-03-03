<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "inicio";

include 'includes/cabecalho.php';
include 'includes/nav.php';
?>

<section class="hero">
    <img src="imgs/henry.jpg" alt="Foto de Henry" class="foto" />
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> — <?php echo $curso; ?></p>
</section>

<main class="container">
    <h2>Início</h2>
    <p>Bem-vindo ao meu portfólio! Aqui você encontrará um pouco mais sobre quem eu sou, minha trajetória, minhas habilidades e os projetos que venho desenvolvendo ao longo da minha jornada na área de desenvolvimento web.</p>
    <!-- restante do conteúdo da página -->
</main>

<?php include 'includes/rodape.php'; ?>