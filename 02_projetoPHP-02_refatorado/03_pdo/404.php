<?php
/**
 * ========================================================
 * ARQUIVO: 03_pdo/404.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 05 - PHP + MariaDB: persistência de dados via PDO
 * Autor: Henry
 * =========================================================
 */

// 1. VARIÁVEIS DO TEMPLATE
$nome = "Henry";
$pagina_atual = "catalogo";
$caminho_raiz = "../";
$titulo_pagina = "404 - Não Encontrado";

// 2. Define o código HTTP 404 (importante para SEO e navegadores)
http_response_code(404);
?>

<?php include 'includes/cab_pdo.php'; ?>

<main>
    
    <article class="card" style="text-align: center; padding: 4rem 2rem; max-width: 600px; margin: 0 auto;">
        
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; border-radius: var(--radius-pill); background: #fee2e2; color: #ef4444; font-size: 2.5rem; margin-bottom: 1.5rem; border: 4px solid #fecaca; box-shadow: var(--shadow-sm);">
            ✕
        </div>
        
        <h1 style="font-size: clamp(2.5rem, 5vw, 3rem); margin-bottom: 0.5rem; color: var(--text-heading);">
            Erro 404
        </h1>
        
        <div style="margin-bottom: 1.5rem;">
            <span class="badge" style="background: var(--bg-surface-hover); color: var(--text-heading); border: 1px solid var(--border-light);">
                Página não encontrada
            </span>
        </div>
        
        <p style="font-size: 1.1rem; color: var(--text-body); margin-bottom: 2.5rem;">
            Opa! A tecnologia ou a página que você tentou acessar não foi encontrada ou não existe mais no nosso banco de dados.
        </p>

        <div style="display: flex; justify-content: center;">
            <a href="index.php" class="btn">
                ← Voltar ao catálogo
            </a>
        </div>
        
    </article>

</main>

<?php include 'includes/rod_pdo.php'; ?>