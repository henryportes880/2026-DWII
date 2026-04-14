<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "sobre";

include '../includes/cabecalho.php';
include '../includes/nav.php';
?>

<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Sobre Mim</h1>
        <p class="tagline">Aula 00 - Perfil e Objetivos</p>
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
    <div class="card card-sobre">
        <h2 class="titulo-sessao">Minha História</h2>
        <div class="biografia">
            <p>Oi, meu nome é <strong>Henry Rafael Ribeiro Portes</strong>, tenho 17 anos e sou de Ponta Grossa, Paraná. Sou católico e tô no terceiro ano do Instituto Federal do Paraná (IFPR), no curso Técnico em Informática. Sempre curti entender como sites, sistemas e aplicativos funcionam, e minhas matérias favoritas são desenvolvimento web e educação física.</p>
            
            <p>Um dos projetos que mais me marcou foi criar um sistema de login ligado a um banco de dados SQL usando Java, no ano passado. Foi bem legal ver algo que eu mesmo fiz funcionando de verdade. No começo, confesso que entrar no mundo da informática foi meio forçado, mas com o tempo comecei a gostar mesmo.</p>
            
            <p>Meu objetivo é ser desenvolvedor <strong>full-stack</strong>, mexendo tanto no front quanto no back. Quero trabalhar com projetos embarcados ou até mesmo em algo “offshore” na área de TI, sempre criando soluções que sejam práticas e eficientes.</p>
            
            <p>Fora da informática, curto jogar videogame (Free Fire, Clash Royale, GTA 5 e FIFA). Me considero criativo e intenso, gosto de me dedicar totalmente ao que faço – é tipo 8 ou 80, tudo ou nada.</p>
        </div>
    </div>
</main>

<?php include '../includes/rodape.php'; ?>