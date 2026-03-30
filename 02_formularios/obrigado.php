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

<div class="container container-centro">
    <div class="card card-confirmacao">
        <div class="confirmacao-icone">✅</div>
        
        <h2 class="confirmacao-titulo">Mensagem enviada!</h2>
        
        <p class="confirmacao-texto">
            Obrigado, <strong><?= $nome_visitante ?></strong> 🎉<br>
            Sua mensagem foi recebida com sucesso. Retornarei em breve no seu e-mail.
        </p>

        <div class="grid-botoes">
            <a href="../index.php" class="btn">🏠 Início</a>
            <a href="contato.php" class="btn btn-outline">📮 Nova Mensagem</a>
        </div>
    </div>
</div>

<?php include '../includes/rodape.php'; ?>