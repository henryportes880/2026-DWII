<?php
$nome = "Henry Rafael Ribeiro Portes";
$profissao = "Estudante de Tecnologia";
$curso = "Técnico em Informática - IFPR";
$pagina_atual = "inicio"; 

include '../includes/cabecalho.php';
?>

<main>

    <nav style="margin-bottom: 2.5rem;">
        <a href="index.php" class="<?php echo ($pagina_atual == 'inicio') ? 'ativo' : ''; ?>">Início</a>
        <a href="projetos.php" class="<?php echo ($pagina_atual == 'projetos') ? 'ativo' : ''; ?>">Projetos</a>
        <a href="sobre.php" class="<?php echo ($pagina_atual == 'sobre') ? 'ativo' : ''; ?>">Sobre</a>
    </nav>

    <section class="inicio" style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
        
        <img src="../imgs/henry.jpg" 
             alt="Foto de <?php echo $nome; ?>" 
             style="width: 160px; height: 160px; object-fit: cover; border-radius: 50%; box-shadow: var(--shadow-md); border: 4px solid var(--bg-surface);">
        
        <div style="margin-top: 0.5rem;">
            <span class="badge">Aula 00 - Estrutura e Identidade</span>
        </div>
        
        <h1 style="font-size: clamp(1.8rem, 4vw, 2.5rem); margin-bottom: 0;"><?php echo $nome; ?></h1>
        <p style="color: var(--text-heading); font-weight: 600; font-size: 1.1rem;">
            <?php echo $profissao; ?> — <?php echo $curso; ?>
        </p>
        
    </section>

    <article class="card" style="text-align: center;">
        <h2 style="margin-bottom: 1rem; font-size: 1.5rem;">Apresentação Pessoal</h2>
        <p style="font-size: 1.05rem; max-width: 800px; margin: 0 auto;">
            Bem-vindo ao meu portfólio! Aqui você encontrará um pouco mais sobre quem eu sou, minha trajetória, minhas habilidades e os projetos que venho desenvolvendo ao longo da minha jornada na área de desenvolvimento web.
        </p>
    </article>

    <div style="text-align: center; margin-top: 2.5rem;">
        <a href="../index.php" class="btn">← Voltar ao Repositório</a>
    </div>

</main>

<?php include '../includes/rodape.php'; ?>