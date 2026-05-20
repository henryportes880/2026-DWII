<?php
/**
 * ===============================================================
 * ARQUIVO: includes/rodape.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Projeto: Portfólio Acadêmico
 * Autor: Henry
 * ===============================================================
 */

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

<script>
const toggleBtn = document.getElementById('toggle-theme');

function aplicarTema(tema) {

    if (!toggleBtn) return;

    if (tema === 'light') {
        document.body.classList.add('light-mode');
        toggleBtn.innerHTML = '☀️ Light';
    } else {
        document.body.classList.remove('light-mode');
        toggleBtn.innerHTML = '🌙 Dark';
    }
}

const temaSalvo = localStorage.getItem('tema') || 'dark';

aplicarTema(temaSalvo);

if (toggleBtn) {

    toggleBtn.addEventListener('click', () => {

        const temaAtual = document.body.classList.contains('light-mode')
            ? 'light'
            : 'dark';

        const novoTema = temaAtual === 'dark'
            ? 'light'
            : 'dark';

        localStorage.setItem('tema', novoTema);

        aplicarTema(novoTema);
    });

}
</script>

</body>
</html>