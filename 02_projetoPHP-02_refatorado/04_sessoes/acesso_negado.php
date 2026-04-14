<?php
/**
 * ========================================================
 * ARQUIVO: 04_sessoes/acesso_negado.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 */

$titulo_pagina = 'Acesso Negado';
$caminho_raiz  = '../';
$pagina_atual  = ''; // Nenhuma página ativa no menu

// Utilizando require_once para garantir a segurança da estrutura
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main>
    
    <article class="card" style="text-align: center; padding: 4rem 2rem; max-width: 600px; margin: 0 auto;">
        
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; border-radius: var(--radius-pill); background: #fef2f2; color: #dc2626; font-size: 2.2rem; margin-bottom: 1.5rem; border: 4px solid #fee2e2; box-shadow: var(--shadow-sm);">
            🔒
        </div>
        
        <h1 style="font-size: clamp(2rem, 5vw, 2.5rem); margin-bottom: 0.5rem; color: var(--text-heading);">
            Acesso Restrito
        </h1>
        
        <div style="margin-bottom: 1.5rem;">
            <span class="badge" style="background: var(--bg-surface-hover); color: var(--text-heading); border: 1px solid var(--border-light);">
                Autenticação Obrigatória
            </span>
        </div>
        
        <p style="font-size: 1.1rem; color: var(--text-body); margin-bottom: 2.5rem; line-height: 1.6;">
            Parece que você tentou acessar uma área protegida. Por motivos de segurança, é necessário estar logado no sistema para continuar.
        </p>

        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            
            <a href="../index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none;">
                🏠 Voltar ao Início
            </a>
            
            <a href="login.php" class="btn">
                Fazer Login →
            </a>
            
        </div>
        
    </article>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>