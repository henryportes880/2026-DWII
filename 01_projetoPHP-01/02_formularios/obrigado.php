<?php
/**
 * ARQUIVO : 02_formularios/obrigado.php
 */

$nome = "Henry Rafael Ribeiro Portes";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Obrigado";

$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'visitante');

include '../includes/cabecalho.php'; 
?>

<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Confirmação</h1>
        <p class="tagline">Aula 04 - Feedback de Formulário</p>
    </div>
</header>
<a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>

<div class="container container-centro">
    <div class="card card-confirmacao">
        <div class="confirmacao-icone">✅</div>
        
        <h2 class="confirmacao-titulo">Mensagem enviada!</h2>
        
        <p class="confirmacao-texto">
            Obrigado, <strong><?= $nome_visitante ?></strong> 🎉<br>
            Sua mensagem foi recebida com sucesso. Retornarei em breve no seu e-mail.
        </p>

        <div class="grid-botoes">
            <a href="../index.php" class="btn">🏠 Painel PHP</a>
            <a href="contato.php" class="btn btn-outline">📮 Nova Mensagem</a>
        </div>
    </div>
</div>

<?php include '../includes/rodape.php'; ?>