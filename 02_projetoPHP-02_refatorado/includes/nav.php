<?php
/**
 * ===============================================================
 * ARQUIVO: includes/nav.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - Menu Dinâmico e Sessões
 * Autor: Henry
 * ===============================================================
 */

// 1. Fallbacks defensivos (Garante que as variáveis existam)
if (!isset($pagina_atual)) $pagina_atual = '';
if (!isset($caminho_raiz))  $caminho_raiz  = './';

/**
 * Função menu_class: 
 * Retorna a classe CSS 'ativo' se o item for a página atual.
 */
if (!function_exists('menu_class')) {
    function menu_class(string $item, string $atual): string {
        return ($item === $atual) ? 'class="ativo"' : '';
    }
}

// 2. Estado de Autenticação
// Verifica se existe uma sessão ativa para mudar os botões do menu
$logado = isset($_SESSION['usuario']);
?>

<nav class="menu-principal">
    <a href="<?php echo $caminho_raiz; ?>./index.php" 
       <?php echo menu_class('inicio', $pagina_atual); ?>>
       👋 Início
    </a>
    
    <a href="<?php echo $caminho_raiz; ?>01_php-intro/sobre.php" 
       <?php echo menu_class('sobre', $pagina_atual); ?>>
       🎱 Sobre
    </a>
    
    <a href="<?php echo $caminho_raiz; ?>01_php-intro/projetos.php" 
       <?php echo menu_class('projetos', $pagina_atual); ?>>
       💡 Projetos
    </a>

    <a href="<?php echo $caminho_raiz; ?>02_formularios/contato.php" 
       <?php echo menu_class('contato', $pagina_atual); ?>>
       📞 Contato
    </a>

    <a href="<?php echo $caminho_raiz; ?>03_pdo/index.php" 
       <?php echo menu_class('catalogo', $pagina_atual); ?>>
       📁 Catálogo
    </a>

    <?php if ($logado): ?>
        <a href="<?php echo $caminho_raiz; ?>04_sessoes/painel.php" 
           <?php echo menu_class('login', $pagina_atual); ?>>
           🔐 Painel
        </a>
        <a href="<?php echo $caminho_raiz; ?>04_sessoes/logout.php" class="link-sair">
           📤 Sair
        </a>
    <?php else: ?>
        <a href="<?php echo $caminho_raiz; ?>04_sessoes/login.php" 
           <?php echo menu_class('login', $pagina_atual); ?>>
           🔑 Login
        </a>
    <?php endif; ?>
</nav>