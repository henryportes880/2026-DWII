<?php
/**
 * ===============================================================
 * ARQUIVO: includes/rodape.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Projeto: Portfólio Acadêmico
 * Autor: Henry
 * Descrição: Rodapé global com ano dinâmico e fallback de autor.
 * ===============================================================
 */

// Tratamento do Autor: Prioriza a variável $nome, senão usa o padrão.
// htmlspecialchars previne que caracteres especiais quebrem o layout.
$exibir_autor = isset($nome) ? htmlspecialchars($nome) : "Portfólio Acadêmico";
?>

<footer class="rodape-global">
    <div class="container">
        <p>
            <strong><?php echo $exibir_autor; ?></strong> 
            &copy; <?php echo date("Y"); ?> 
            <span class="separador">|</span> 
            Desenvolvido com <span class="badge-php">PHP 8.3</span>
            <span class="separador">|</span> 
            <strong>IFPR - Campus Ponta Grossa</strong>
        </p>
    </div>
</footer>

</body>
</html>