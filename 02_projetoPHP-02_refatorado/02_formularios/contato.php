<?php
/**
 * ==================================================================
 * ARQUIVO: 02_formularios/contato.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Henry
 * =====================================================================
 */

// 1. CONFIGURAÇÕES INICIAIS
$nome_visitante = '';
$email = '';
$assunto = '';
$mensagem = '';
$erros = [];

// 2. PROCESSAMENTO DO FORMULÁRIO (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // trim() limpa espaços vazios indesejados
    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    // VALIDAÇÕES
    if (empty($nome_visitante)) {
        $erros[] = 'O campo Nome é obrigatório.';
    }

    if (empty($email)) {
        $erros[] = 'O campo E-mail é obrigatório.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Informe um e-mail válido.';
    }

    if (empty($assunto)) {
        $erros[] = 'Selecione um assunto.';
    }

    if (empty($mensagem)) {
        $erros[] = 'O campo Mensagem é obrigatório.';
    } elseif (strlen($mensagem) < 10) {
        $erros[] = "A mensagem deve ter pelo menos 10 caracteres.";
    } elseif (strlen($mensagem) > 500) {
        $erros[] = "A mensagem deve ter no máximo 500 caracteres.";
    }

    // REDIRECIONAR SE NÃO HOUVER ERROS
    if (empty($erros)) {
        $url = "obrigado.php?nome=" . urlencode($nome_visitante) . "&assunto=" . urlencode($assunto);
        header("Location: $url");
        exit;
    }
}

// 3. VARIÁVEIS DO TEMPLATE (Para o cabeçalho)
$nome = "Henry";
$pagina_atual = "contato";
$caminho_raiz = "../"; 
$titulo_pagina = "Contato - {$nome}";

include '../includes/cabecalho.php'; 
?>

<main>
    
    <div class="inicio">
        <h1>Entre em Contato</h1>
        <p>Preencha o formulário abaixo para enviar sua dúvida, proposta ou sugestão.</p>
    </div>

    <?php if (!empty($erros)): ?>
        <div class="alert-error">
            <strong>🚫 Corrija os erros abaixo:</strong>
            <ul style="margin-left: 1.5rem; font-size: 0.9rem; margin-top: var(--spacing-sm);">
                <?php foreach ($erros as $erro): ?>
                    <li><?php echo htmlspecialchars($erro); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <article class="card">
        <form class="form-container" action="contato.php" method="post">
            
            <div class="form-group">
                <label for="nome_visitante">Seu nome:</label>
                <input type="text" name="nome_visitante" id="nome_visitante"
                       value="<?php echo htmlspecialchars($nome_visitante); ?>" placeholder="Seu nome completo">
            </div>

            <div class="form-group">
                <label for="email">Seu e-mail:</label>
                <input type="email" name="email" id="email"
                       value="<?php echo htmlspecialchars($email); ?>" placeholder="exemplo@email.com">
            </div>

            <div class="form-group">
                <label for="assunto">Assunto:</label>
                <select name="assunto" id="assunto">
                    <option value="">Selecione um assunto...</option>
                    <option value="Duvida" <?php if ($assunto === 'Duvida') echo 'selected'; ?>>❓ Dúvida</option>
                    <option value="Proposta" <?php if ($assunto === 'Proposta') echo 'selected'; ?>>💻 Proposta de trabalho</option>
                    <option value="Colaboracao" <?php if ($assunto === 'Colaboracao') echo 'selected'; ?>>🤝 Colaboração</option>
                    <option value="Outro" <?php if ($assunto === 'Outro') echo 'selected'; ?>>➡️ Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mensagem">Sua mensagem:</label>
                <textarea name="mensagem" id="mensagem" rows="6" placeholder="Escreva sua mensagem aqui..."><?php echo htmlspecialchars($mensagem); ?></textarea>
                <p style="font-size: 0.8rem; color: var(--neutral-500); text-align: right; margin-top: var(--spacing-xs);">
                    <?php echo strlen($mensagem); ?> / 500 caracteres
                </p>
            </div>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </article>
    
    <div style="text-align: center; margin-top: var(--spacing-2xl);">
        <a href="../index.php" class="btn">← Voltar ao Início</a>
    </div>

</main>

<!-- ANIMAÇÕES CSS -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    main {
        animation: fadeInUp 0.8s ease-out;
    }

    .alert-error {
        animation: fadeInUp 0.6s ease-out;
    }

    .card {
        animation: fadeInUp 0.8s ease-out 0.1s backwards;
    }

    @media (max-width: 768px) {
        main {
            gap: 2rem;
        }
    }
</style>

<?php include '../includes/rodape.php'; ?>
