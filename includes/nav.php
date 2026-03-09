<?php
$cor_inicio = ($pagina_atual === "inicio") ? "color: #f0b341; font-weight: bold;" : "color: #333;";
$cor_sobre = ($pagina_atual === "sobre") ? "color: #f0b341; font-weight: bold;" : "color: #333;";
$cor_projetos = ($pagina_atual === "projetos") ? "color: #f0b341; font-weight: bold;" : "color: #333;";
?>

<nav>
  <a href="index.php" style="<?php echo $cor_inicio; ?>">Início</a>
  <a href="sobre.php" style="<?php echo $cor_sobre; ?>">Sobre</a>
  <a href="projetos.php" style="<?php echo $cor_projetos; ?>">Projetos</a>
</nav>