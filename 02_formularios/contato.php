<?php
/**
 * -------------------------------------------------------------
 * ARQUIVO : 02_formularios/contato.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula : 04 – PHP para Web: Formulários, GET e POST
 * Autor : Henry Rafael Ribeiro Portes
 * Conceitos : $_SERVER, REQUEST_METHOD, trim(), empty(), strlen()
 * -------------------------------------------------------------
 */

// — VARIÁVEIS DO TEMPLATE
$nome = "Henry Rafael Ribeiro Portes";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Contato";


// — ESTADO INICIAL
$nome_visitante = '';
$email = '';
$mensagem = '';
$erros = [];


// — PROCESSAR SOMENTE SE VEIO POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$nome_visitante = trim($_POST['nome_visitante'] ?? '');
$email = trim($_POST['email'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');


// VALIDAÇÃO
if ($nome_visitante === '') {
$erros[] = "O nome é obrigatório.";
}

if ($email === '') {
$erros[] = "O e-mail é obrigatório.";
}

if ($mensagem === '') {
$erros[] = "A mensagem é obrigatória.";
}
elseif (strlen($mensagem) < 10) {
$erros[] = "A mensagem deve ter pelo menos 10 caracteres.";
}


// REDIRECIONAMENTO (PRG)
if (empty($erros)) {

header('Location: obrigado.php?nome=' . urlencode($nome_visitante));
exit;

}

}
?>

<?php include '../includes/cabecalho.php'; ?>

<div class="container">

<h1 class="titulo-secao">📬 Entre em Contato</h1>

<form class="form-container" action="contato.php" method="post">

<label>Nome *</label>
<input type="text" name="nome_visitante" value="<?= htmlspecialchars($nome_visitante) ?>">

<label>E-mail *</label>
<input type="email" name="email" value="<?= htmlspecialchars($email) ?>">

<label>Mensagem *</label>
<textarea name="mensagem" rows="5"><?= htmlspecialchars($mensagem) ?></textarea>

<button type="submit">Enviar Mensagem</button>

</form>


<!-- Exibir erros -->
<?php if (!empty($erros)): ?>

<div class="alerta-erro">
<h3>⚠️ Corrija os erros abaixo:</h3>

<?php foreach ($erros as $erro): ?>
<p>• <?= htmlspecialchars($erro) ?></p>
<?php endforeach; ?>

</div>

<?php endif; ?>

</div>

<?php include '../includes/rodape.php'; ?>