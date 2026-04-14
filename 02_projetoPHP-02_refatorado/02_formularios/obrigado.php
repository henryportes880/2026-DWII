<?php
/**
 * ==================================================================
 * ARQUIVO: 02_formularios/obrigado.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Henry
 * =====================================================================
 */

// 1. VARIÁVEIS DO TEMPLATE
$nome = "Henry";
$pagina_atual = "contato"; // Mantém o item de contato ativo no menu
$caminho_raiz = "../"; 
$titulo_pagina = "Obrigado - {$nome}";

// 2. RECEBIMENTO DE DADOS VIA GET
// htmlspecialchars evita ataques de scripts via URL
$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'Visitante');
$assunto = htmlspecialchars($_GET['assunto'] ?? 'Geral');

include '../includes/cabecalho.php'; 
?>

<main>
    
    <article class="card" style="text-align: center; padding: 4rem 2rem; max-width: 600px; margin: 0 auto;">
        
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; border-radius: var(--radius-pill); background: var(--success-bg); color: var(--success-text); font-size: 2.5rem; margin-bottom: 1.5rem; border: 4px solid var(--success-border); box-shadow: var(--shadow-sm);">
            ✓
        </div>
        
        <h1 style="font-size: clamp(1.8rem, 4vw, 2.2rem); margin-bottom: 0.5rem;">
            Obrigado, <?php echo $nome_visitante; ?>!
        </h1>
        
        <div style="margin-bottom: 1.5rem;">
            <span class="badge" style="background: var(--bg-surface-hover); color: var(--text-heading); border: 1px solid var(--border-light);">
                Assunto: <?php echo $assunto; ?>
            </span>
        </div>
        
        <p style="font-size: 1.1rem; color: var(--text-body); margin-bottom: 2.5rem;">
            Sua mensagem foi recebida com sucesso. Fique de olho no seu e-mail, responderei em breve!
        </p>

        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            
            <a href="../index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none;">
                Voltar ao Início
            </a>
            
            <a href="contato.php" class="btn">
                Nova Mensagem
            </a>
            
        </div>
        
    </article>

</main>

<?php include '../includes/rodape.php'; ?>