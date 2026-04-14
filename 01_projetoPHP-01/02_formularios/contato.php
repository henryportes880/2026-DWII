<?php
/**
 * ARQUIVO : 02_formularios/contato.php
 * Refatorado: Remoção de estilos inline e padronização de classes.
 */

$nome = "Henry Rafael Ribeiro Portes";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Contato";

$nome_visitante = '';
$email = '';
$mensagem = '';
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome_visitante === '') $erros[] = "O nome é obrigatório.";
    if ($email === '') $erros[] = "O e-mail é obrigatório.";
    if ($mensagem === '') {
        $erros[] = "A mensagem é obrigatória.";
    } elseif (strlen($mensagem) < 10) {
        $erros[] = "A mensagem deve ter pelo menos 10 caracteres.";
    }

    if (empty($erros)) {
        header('Location: obrigado.php?nome=' . urlencode($nome_visitante));
        exit;
    }
}

include '../includes/cabecalho.php'; 
?>

<header class="hub-header">
    <div class="container">
        <div class="header-acoes">
        </div>
        <h1>Contato</h1>
        <p class="tagline">Aula 04 - Formulários e Validações</p>
    </div>
</header>
<a href="../index.php" class="btn-voltar">← Voltar ao Repositório</a>

<div class="container">
    <div class="form-wrapper">
        <form class="form-container" action="contato.php" method="post">
            <div class="form-group">
                <label for="nome_visitante">Nome Completo *</label>
                <input type="text" id="nome_visitante" name="nome_visitante" 
                       placeholder="Ex: João Silva"
                       value="<?= htmlspecialchars($nome_visitante) ?>">
            </div>

            <div class="form-group">
                <label for="email">E-mail de Contato *</label>
                <input type="email" id="email" name="email" 
                       placeholder="seu@email.com"
                       value="<?= htmlspecialchars($email) ?>">
            </div>

            <div class="form-group">
                <label for="mensagem">Sua Mensagem *</label>
                <textarea id="mensagem" name="mensagem" rows="5" 
                          placeholder="Como posso te ajudar?"><?= htmlspecialchars($mensagem) ?></textarea>
            </div>

            <button type="submit" class="btn">Enviar Mensagem</button>
        </form>

        <?php if (!empty($erros)): ?>
            <div class="alerta-erro">
                <h3>⚠️ Corrija os erros abaixo:</h3>
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?= htmlspecialchars($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/rodape.php'; ?>