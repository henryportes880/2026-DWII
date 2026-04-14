<?php
/**
 * ARQUIVO: index.php
 * HUB Principal do Repositório DWII 2026
 */

$nome = "Henry Rafael Ribeiro Portes";
$subtitulo = "Repositório 2026 - Desenvolvimento Web II";

$aulas = [
    [
        "numero" => "00",
        "nome" => "Apresentação Pessoal",
        "descricao" => "Página pessoal responsiva com foco em estrutura semântica.",
        "link" => "00_apresentacao/index.html",
        "icone" => "👤",
        "conceitos" => ["HTML", "Flexbox", "Responsivo"]
    ],
    [
        "numero" => "01-03",
        "nome" => "Portfólio PHP",
        "descricao" => "Site dinâmico utilizando includes e gerenciamento de estados.",
        "link" => "01_php-intro/index.php",
        "icone" => "💻",
        "conceitos" => ["PHP", "Include", "Arrays"]
    ],
    [
        "numero" => "04",
        "nome" => "Formulário de Contato",
        "descricao" => "Sistema de envio de mensagens com validação e proteção XSS.",
        "link" => "02_formularios/contato.php",
        "icone" => "📩",
        "conceitos" => ["POST", "Validação", "Security"]
    ],
    [
        "numero" => "05",
        "nome" => "Banco de Dados",
        "descricao" => "Implementação de catálogo utilizando a biblioteca PDO.",
        "link" => "03_pdo/index.php",
        "icone" => "🗄️",
        "conceitos" => ["PDO", "SQL", "Query"]
    ],
    [
        "numero" => "06",
        "nome" => "Sistema de Login",
        "descricao" => "Controle de acesso restrito com gerenciamento de sessões.",
        "link" => "04_sessoes/login.php",
        "icone" => "🔐",
        "conceitos" => ["Session", "Auth", "Login"]
    ],
    [
        "numero" => "07",
        "nome" => "CRUD Completo",
        "descricao" => "Gerenciador de projetos com as operações de Create e Read.",
        "link" => "05_crud/index.php",
        "icone" => "📝",
        "conceitos" => ["Insert", "Select", "PDO-CRUD"]
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($subtitulo) ?></title>
    <link rel="stylesheet" href="includes/style.css">
</head>

<body class="hub-page">

<header class="hub-header">
    <div class="container">
        <h1><?= htmlspecialchars($nome) ?></h1>
        <p class="tagline"><?= htmlspecialchars($subtitulo) ?></p>
    </div>
</header>

<main class="container">
    <h2 class="titulo-secao">📂 Módulos da Disciplina</h2>

    <div class="grid-hub">
        <?php foreach ($aulas as $aula): ?>
            <article class="card card-hub">
                <div class="card-topo">
                    <span class="icone-projeto"><?= htmlspecialchars($aula['icone']) ?></span>
                    <span class="badge-aula">Aula <?= htmlspecialchars($aula['numero']) ?></span>
                </div>

                <div class="card-corpo">
                    <h3><?= htmlspecialchars($aula['nome']) ?></h3>
                    <p class="desc-hub"><?= htmlspecialchars($aula['descricao']) ?></p>
                </div>

                <div class="tags">
                    <?php foreach ($aula['conceitos'] as $conceito): ?>
                        <span class="tag"><?= htmlspecialchars($conceito) ?></span>
                    <?php endforeach; ?>
                </div>

                <a href="<?= htmlspecialchars($aula['link']) ?>" class="btn btn-block btn-projeto">
                    Acessar Módulo
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<footer class="main-footer">
    <div class="container">
        <p><?= htmlspecialchars($nome) ?> &copy; <?= date("Y") ?> | Instituto Federal do Paraná</p>
    </div>
</footer>

</body>
</html>