<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "sobre";

include 'includes/cabecalho.php';
include 'includes/nav.php';
?>

<section class="hero">
    <img src="imgs/henry.jpg" alt="Foto de Henry" class="foto" />
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> — <?php echo $curso; ?></p>
</section>

<main class="container">
    <h2>Sobre mim</h2>
    <p>Oi, meu nome é Henry Rafael Ribeiro Portes, tenho 17 anos e sou de Ponta Grossa, Paraná. Sou católico e tô no terceiro ano do Instituto Federal do Paraná (IFPR), no curso Técnico em Informática. Sempre curti entender como sites, sistemas e aplicativos funcionam, e minhas matérias favoritas são desenvolvimento web e educação física. Um dos projetos que mais me marcou foi criar um sistema de login ligado a um banco de dados SQL usando Java, no ano passado. Foi bem legal ver algo que eu mesmo fiz funcionando de verdade.</p> <p>No começo, confesso que entrar no mundo da informática foi meio forçado, mas com o tempo comecei a gostar mesmo. Ainda não explorei muito outras áreas da tecnologia, tipo inteligência artificial ou segurança, mas o projeto do login em Java me deu aquele empurrão pra continuar tentando coisas novas e me desafiar mais.</p> <p>Tenho alguns códigos guardados do ano passado que uso pra revisar e aprender. Atualmente tô fazendo um curso do Lions StartUp que ensina back-end com JavaScript ou Node.js, o que tá ajudando bastante. Gosto mais de estudar em aulas presenciais, porque dá pra trocar ideia com os colegas e tirar dúvidas na hora.</p> <p>Meu objetivo é ser desenvolvedor full-stack, mexendo tanto no front quanto no back. Quero trabalhar com projetos embarcados ou até mesmo em algo “offshore” na área de TI, sempre criando soluções que sejam práticas e eficientes. Ainda não tenho uma empresa ou projeto específico em mente, mas tô sempre me preparando pra aproveitar oportunidades que apareçam.</p> <p>Fora da informática, curto jogar videogame, tipo Free Fire, Clash Royale, e também gosto de consoles como PS4, jogando GTA 5 e FIFA. Antes eu andava de skate, mas agora tô mais nos esportes como futebol e futsal de vez em quando. Me considero criativo e intenso, gosto de me dedicar totalmente ao que faço – é tipo 8 ou 80, tudo ou nada.</p>   
</main>

<?php include 'includes/rodape.php'; ?>