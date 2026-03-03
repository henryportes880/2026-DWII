<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "projetos";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos - <?php echo $nome; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php" <?php echo ($pagina_atual === "inicio") ? 'style="text-decoration: underline;"' : ''; ?>>Início</a>
    <a href="sobre.php" <?php echo ($pagina_atual === "sobre") ? 'style="text-decoration: underline;"' : ''; ?>>Sobre</a>
    <a href="projetos.php" <?php echo ($pagina_atual === "projetos") ? 'style="text-decoration: underline;"' : ''; ?>>Projetos</a>
</nav>

<section class="hero">
    <img src="imgs/henry.jpg" alt="Foto de Henry" class="foto">
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> — <?php echo $curso; ?></p>
</section>

<main class="container">
    <h2>Meus Projetos</h2>
    <p>Ao longo da minha trajetória em desenvolvimento web, venho construindo projetos que representam minha evolução técnica e meu aprendizado contínuo. Entre eles, está a minha Página de Apresentação Pessoal, um site desenvolvido com HTML e CSS com foco na organização estrutural, uso correto de tags semânticas e aplicação de estilos para criar uma identidade visual clara e organizada. Esse projeto foi fundamental para consolidar minha base na construção de páginas estáticas.</p>

    <p>Também desenvolvi um Portfólio Dinâmico em PHP, um mini-site com múltiplas páginas conectadas por meio de include e uso de variáveis PHP. Nesse projeto, trabalhei com a ideia de reaproveitamento de código, organização modular e criação de conteúdo dinâmico, tornando o site mais funcional e estruturado, aproximando-o de aplicações reais.</p>

    <p>Além disso, realizei diversos Exercícios de Lógica de Programação, voltados para o fortalecimento do raciocínio lógico e da resolução de problemas. Esses exercícios envolveram estruturas condicionais, laços de repetição e manipulação de variáveis, contribuindo diretamente para minha base como programador e para o desenvolvimento de soluções mais eficientes e organizadas.</p>
</main>

<footer>
    &copy; <?php echo date("Y"); ?> <?php echo $nome; ?>
</footer>

</body>
</html>