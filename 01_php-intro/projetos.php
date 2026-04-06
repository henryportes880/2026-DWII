<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "projetos";

include '../includes/cabecalho.php';
include '../includes/nav.php';
?>

<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Meus Projetos</h1>
        <p class="tagline">Aula 00 - Portfólio e Trajetória</p>
    </div>
</header>
<a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>

<section class="hero">
    <div class="hero-content">
        <h1><?php echo $nome; ?></h1>
        <p class="hero-subtitle"><?php echo $profissao; ?> — <?php echo $curso; ?></p>
    </div>
</section>

<main class="container">
    <h2 class="titulo-sessao">Galeria de Trabalhos</h2>

    <div class="card card-projeto">
        <h3>Página de Apresentação</h3>
        <p>Ao longo da minha trajetória em desenvolvimento web, venho construindo projetos que representam minha evolução técnica e meu aprendizado contínuo. Foco na organização estrutural e uso correto de tags semânticas.</p>
    </div>

    <div class="card card-projeto">
        <h3>Portfólio Dinâmico em PHP</h3>
        <p>Um mini-site com múltiplas páginas conectadas por meio de include e uso de variáveis PHP para tornar o conteúdo modular.</p>
    </div>

    <div class="card card-projeto">
        <h3>Lógica de Programação</h3>
        <p>Desenvolvimento de diversos exercícios para fortalecer o raciocínio lógico e a resolução de problemas reais de código.</p>
    </div>
</main>

<?php include '../includes/rodape.php'; ?>