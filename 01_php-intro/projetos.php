<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "projetos";

include '../includes/cabecalho.php';
include '../includes/nav.php';
?>

<section class="hero">
    
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> — <?php echo $curso; ?></p>
</section>

<main class="container">
    <h2>Meus Projetos</h2>

    <p>Ao longo da minha trajetória em desenvolvimento web, venho construindo projetos que representam minha evolução técnica e meu aprendizado contínuo.</p>

    <p>Entre eles, está a minha Página de Apresentação Pessoal, um site desenvolvido com HTML e CSS com foco na organização estrutural e uso correto de tags semânticas.</p>

    <p>Também desenvolvi um Portfólio Dinâmico em PHP, um mini-site com múltiplas páginas conectadas por meio de include e uso de variáveis PHP.</p>

    <p>Além disso, realizei diversos Exercícios de Lógica de Programação para fortalecer o raciocínio lógico e resolução de problemas.</p>

</main>

<?php include '../includes/rodape.php'; ?>