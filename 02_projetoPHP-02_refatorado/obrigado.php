<?php
/**
 * ==================================================================
 * ARQUIVO: 02_formularios/obrigado.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Henry
 * ==================================================================
 */

$nome = "Henry";
$pagina_atual = "contato";
$caminho_raiz = "./";
$titulo_pagina = "Obrigado - {$nome}";

$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'Visitante');
$assunto = htmlspecialchars($_GET['assunto'] ?? 'Geral');

include __DIR__ . '/includes/cabecalho.php';
?>

<main class="thanks-wrapper">

    <article class="card thanks-card">

        <div class="thanks-content">

            <div class="thanks-icon">
                ✓
            </div>

            <h1 class="thanks-title">
                Obrigado, <?php echo $nome_visitante; ?>!
            </h1>

            <div class="thanks-badge">

                <span class="badge badge-success">
                    Assunto: <?php echo $assunto; ?>
                </span>

            </div>

            <p class="thanks-message">
                Sua mensagem foi recebida com sucesso.
                Fique atento ao seu e-mail, retornarei em breve.
            </p>

            <div class="thanks-actions">

                <a href="index.php" class="btn-voltar">
                    Voltar ao Início
                </a>

                <a href="contato.php" class="btn">
                    Nova Mensagem
                </a>

            </div>

        </div>

    </article>

</main>

<?php include __DIR__ . '/includes/rodape.php'; ?>