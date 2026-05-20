<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula : 13 - Refatoracao Parte V: Painel admin
 * Arquivo : admin.php
 */

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/conexao.php';

requer_login();

$pdo       = conectar();
$erro      = '';
$em_edicao = null;

/* ──────────────────────────────────────────────────────────
   LOGS
────────────────────────────────────────────────────────── */

function registrar_log(PDO $pdo, string $acao, int $registro_id, string $detalhes): void
{
    $stmt = $pdo->prepare(
        "INSERT INTO logs
        (
            tabela_afetada,
            registro_id,
            acao,
            usuario_login,
            detalhes
        )
        VALUES
        (
            'projetos',
            :id,
            :acao,
            :usuario,
            :detalhes
        )"
    );

    $stmt->execute([
        ':id'       => $registro_id,
        ':acao'     => $acao,
        ':usuario'  => usuario_atual(),
        ':detalhes' => $detalhes,
    ]);
}

/* ──────────────────────────────────────────────────────────
   PROCESSAMENTO POST
────────────────────────────────────────────────────────── */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? '';

    /* ── SALVAR ───────────────────────────────────────── */

    if ($acao === 'salvar') {

        $id           = (int) ($_POST['id'] ?? 0);
        $nome         = trim($_POST['nome'] ?? '');
        $descricao    = trim($_POST['descricao'] ?? '');
        $tecnologias  = trim($_POST['tecnologias'] ?? '');
        $link_github  = trim($_POST['link_github'] ?? '');
        $ano          = (int) ($_POST['ano'] ?? date('Y'));
        $status       = $_POST['status'] ?? 'rascunho';

        if (
            $nome === '' ||
            $descricao === '' ||
            $tecnologias === ''
        ) {

            $erro = 'Preencha todos os campos obrigatórios.';

        } else {

            $link = $link_github !== ''
                ? $link_github
                : null;

            /* ── UPDATE ─────────────────────────────── */

            if ($id > 0) {

                $stmt = $pdo->prepare(
                    "UPDATE projetos
                    SET
                        nome = :nome,
                        descricao = :descricao,
                        tecnologias = :tecnologias,
                        link_github = :link,
                        ano = :ano,
                        status = :status
                    WHERE id = :id"
                );

                $stmt->execute([
                    ':nome'        => $nome,
                    ':descricao'   => $descricao,
                    ':tecnologias' => $tecnologias,
                    ':link'        => $link,
                    ':ano'         => $ano,
                    ':status'      => $status,
                    ':id'          => $id,
                ]);

                registrar_log(
                    $pdo,
                    'UPDATE',
                    $id,
                    "Projeto editado: {$nome}"
                );

            } else {

                /* ── INSERT ─────────────────────────── */

                $stmt = $pdo->prepare(
                    "INSERT INTO projetos
                    (
                        nome,
                        descricao,
                        tecnologias,
                        link_github,
                        ano,
                        status
                    )
                    VALUES
                    (
                        :nome,
                        :descricao,
                        :tecnologias,
                        :link,
                        :ano,
                        :status
                    )"
                );

                $stmt->execute([
                    ':nome'        => $nome,
                    ':descricao'   => $descricao,
                    ':tecnologias' => $tecnologias,
                    ':link'        => $link,
                    ':ano'         => $ano,
                    ':status'      => $status,
                ]);

                $id = (int) $pdo->lastInsertId();

                registrar_log(
                    $pdo,
                    'INSERT',
                    $id,
                    "Projeto criado: {$nome}"
                );
            }

            header('Location: admin.php?ok=salvo');
            exit;
        }

        /* ── PRESERVAR FORMULÁRIO ───────────────────── */

        $em_edicao = [
            'id'           => $id,
            'nome'         => $nome,
            'descricao'    => $descricao,
            'tecnologias'  => $tecnologias,
            'link_github'  => $link_github,
            'ano'          => $ano,
            'status'       => $status,
        ];
    }

    /* ── ARQUIVAR ───────────────────────────────────── */

    if ($acao === 'arquivar') {

        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0) {

            $stmt = $pdo->prepare(
                "UPDATE projetos
                SET status = 'arquivado'
                WHERE id = :id"
            );

            $stmt->execute([
                ':id' => $id
            ]);

            registrar_log(
                $pdo,
                'STATUS',
                $id,
                'Projeto arquivado'
            );
        }

        header('Location: admin.php?ok=arquivado');
        exit;
    }
}

/* ──────────────────────────────────────────────────────────
   EDIÇÃO
────────────────────────────────────────────────────────── */

if (
    $em_edicao === null &&
    isset($_GET['editar'])
) {

    $stmt = $pdo->prepare(
        "SELECT *
        FROM projetos
        WHERE id = :id"
    );

    $stmt->execute([
        ':id' => (int) $_GET['editar']
    ]);

    $em_edicao = $stmt->fetch() ?: null;
}

/* ──────────────────────────────────────────────────────────
   FILTROS
────────────────────────────────────────────────────────── */

$filtros_validos = [
    'todos',
    'rascunho',
    'publicado',
    'arquivado'
];

$filtro = $_GET['filtro'] ?? 'todos';

if (!in_array($filtro, $filtros_validos, true)) {
    $filtro = 'todos';
}

/* ──────────────────────────────────────────────────────────
   LISTAGEM
────────────────────────────────────────────────────────── */

if ($filtro === 'todos') {

    $projetos = $pdo
        ->query(
            "SELECT *
            FROM projetos
            ORDER BY criado_em DESC"
        )
        ->fetchAll();

} else {

    $stmt = $pdo->prepare(
        "SELECT *
        FROM projetos
        WHERE status = :status
        ORDER BY criado_em DESC"
    );

    $stmt->execute([
        ':status' => $filtro
    ]);

    $projetos = $stmt->fetchAll();
}

/* ──────────────────────────────────────────────────────────
   HEADER GLOBAL
────────────────────────────────────────────────────────── */

$pagina_atual  = 'painel';
$titulo_pagina = 'Painel Administrativo';
$caminho_raiz  = './';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php require_once __DIR__ . '/includes/cabecalho.php'; ?>
</head>

<body>

<main class="admin-page">

    <section class="container">

        <!-- HEADER -->

        <section class="admin-page-header mb-5">

            <div>
                <span class="badge badge-info mb-2">
                    Administração
                </span>

                <h1 class="admin-page-title">
                    Painel Administrativo
                </h1>

                <p class="text-muted admin-page-description">
                    Gerencie os projetos do portfólio, edite conteúdos
                    e controle os status de publicação.
                </p>
            </div>

        </section>

        <!-- ALERTAS -->

        <?php if (isset($_GET['ok'])): ?>

            <div class="alert-success">

                <div>

                    <strong>
                        Operação concluída
                    </strong>

                    <p class="mb-0">
                        A ação foi executada com sucesso.
                    </p>

                </div>

            </div>

        <?php endif; ?>

        <?php if ($erro !== ''): ?>

            <div class="alert-error">

                <div>

                    <strong>
                        Erro de validação
                    </strong>

                    <p class="mb-0">
                        <?php echo htmlspecialchars($erro); ?>
                    </p>

                </div>

            </div>

        <?php endif; ?>

        <!-- FORMULÁRIO -->

        <article class="card admin-card mb-5">

            <div class="admin-section-header mb-4">

                <div>

                    <span class="badge badge-gold mb-2">
                        Formulário
                    </span>

                    <h3 class="admin-card-title">
                        <?php echo $em_edicao ? 'Editar Projeto' : 'Novo Projeto'; ?>
                    </h3>

                </div>

            </div>

            <form
                action="admin.php"
                method="post"
                class="form-container admin-form"
            >

                <input
                    type="hidden"
                    name="acao"
                    value="salvar"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?php echo (int) ($em_edicao['id'] ?? 0); ?>"
                >

                <!-- NOME -->

                <div class="form-group">

                    <label>
                        Nome do Projeto
                    </label>

                    <input
                        type="text"
                        name="nome"
                        required
                        placeholder="Digite o nome do projeto"
                        value="<?php echo htmlspecialchars($em_edicao['nome'] ?? ''); ?>"
                    >

                </div>

                <!-- DESCRIÇÃO -->

                <div class="form-group">

                    <label>
                        Descrição
                    </label>

                    <textarea
                        name="descricao"
                        rows="5"
                        required
                        placeholder="Descreva o projeto detalhadamente"
                    ><?php echo htmlspecialchars($em_edicao['descricao'] ?? ''); ?></textarea>

                </div>

                <!-- GRID -->

                <div class="admin-form-grid">

                    <div class="form-group">

                        <label>
                            Tecnologias
                        </label>

                        <input
                            type="text"
                            name="tecnologias"
                            required
                            placeholder="Ex: PHP, MySQL, CSS"
                            value="<?php echo htmlspecialchars($em_edicao['tecnologias'] ?? ''); ?>"
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Link GitHub
                        </label>

                        <input
                            type="url"
                            name="link_github"
                            placeholder="https://github.com/..."
                            value="<?php echo htmlspecialchars($em_edicao['link_github'] ?? ''); ?>"
                        >

                    </div>

                </div>

                <!-- GRID -->

                <div class="admin-form-grid">

                    <div class="form-group">

                        <label>
                            Ano
                        </label>

                        <input
                            type="number"
                            name="ano"
                            min="2000"
                            max="2099"
                            required
                            value="<?php echo (int) ($em_edicao['ano'] ?? date('Y')); ?>"
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select name="status">

                            <?php
                            $st = $em_edicao['status'] ?? 'rascunho';
                            ?>

                            <?php foreach ([
                                'rascunho',
                                'publicado',
                                'arquivado'
                            ] as $op): ?>

                                <option
                                    value="<?php echo $op; ?>"
                                    <?php echo $op === $st ? 'selected' : ''; ?>
                                >
                                    <?php echo ucfirst($op); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

                <!-- ACTIONS -->

                <div class="admin-actions">

                    <button
                        type="submit"
                        class="btn"
                    >
                        Salvar Projeto
                    </button>

                    <?php if ($em_edicao): ?>

                        <a
                            href="admin.php"
                            class="btn btn-secondary"
                        >
                            Cancelar
                        </a>

                    <?php endif; ?>

                </div>

            </form>

        </article>

        <!-- LISTAGEM -->

        <article class="card admin-card shadow-lg">

            <div class="admin-header mb-4">

                <div>

                    <span class="badge badge-info mb-2">
                        Projetos
                    </span>

                    <h3 class="admin-card-title">
                        Projetos Cadastrados
                    </h3>

                </div>

                <!-- FILTRO -->

                <form
                    action="admin.php"
                    method="get"
                    class="admin-filter"
                >

                    <label class="text-primary">
                        Filtrar por status
                    </label>

                    <select
                        name="filtro"
                        onchange="this.form.submit()"
                    >

                        <?php foreach ($filtros_validos as $op): ?>

                            <option
                                value="<?php echo $op; ?>"
                                <?php echo $op === $filtro ? 'selected' : ''; ?>
                            >
                                <?php echo ucfirst($op); ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </form>

            </div>

            <!-- VAZIO -->

            <?php if (empty($projetos)): ?>

                <div class="admin-empty">

                    <p class="text-muted">
                        Nenhum projeto encontrado para o filtro selecionado.
                    </p>

                </div>

            <?php else: ?>

                <!-- TABELA -->

                <div class="admin-table-wrapper">

                    <table class="admin-table">

                        <thead>

                            <tr>

                                <th>
                                    Nome
                                </th>

                                <th class="text-center">
                                    Ano
                                </th>

                                <th class="text-center">
                                    Status
                                </th>

                                <th class="text-right">
                                    Ações
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php foreach ($projetos as $p): ?>

                            <?php

                            $badge_classe = match($p['status']) {
                                'publicado' => 'badge-success',
                                'arquivado' => 'badge-error',
                                default     => 'badge-warning'
                            };

                            ?>

                            <tr>

                                <td>

                                    <div class="flex-col">

                                        <strong>
                                            <?php echo htmlspecialchars($p['nome']); ?>
                                        </strong>

                                        <span class="text-muted">
                                            <?php echo htmlspecialchars($p['tecnologias']); ?>
                                        </span>

                                    </div>

                                </td>

                                <td class="text-center">

                                    <span class="badge">
                                        <?php echo (int) $p['ano']; ?>
                                    </span>

                                </td>

                                <td class="text-center">

                                    <span class="badge admin-status-badge <?php echo $badge_classe; ?>">
                                        <?php echo ucfirst($p['status']); ?>
                                    </span>

                                </td>

                                <td class="text-right">
    <div class="admin-table-actions">
        <a href="admin.php?editar=<?php echo (int) $p['id']; ?>" class="btn btn-secondary btn-small admin-action-btn">
            Editar
        </a>

        <?php if ($p['status'] !== 'arquivado'): ?>
            <form action="admin.php" method="post" onsubmit="return confirm('Deseja realmente arquivar este projeto?');">
                <input type="hidden" name="acao" value="arquivar">
                <input type="hidden" name="id" value="<?php echo (int) $p['id']; ?>">

                <a type="submit" class="btn btn-small admin-action-btn">
                    Arquivar
        </a>
            </form>
        <?php endif; ?>
    </div>
</td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

                <!-- FOOTER -->

                <div class="admin-footer-info">

                    <p class="text-muted">

                        Total de projetos:
                        <strong>
                            <?php echo count($projetos); ?>
                        </strong>

                    </p>

                </div>

            <?php endif; ?>

        </article>

        <!-- VOLTAR -->

        <div class="text-center mt-6">

            <a
                href="painel.php"
                class="btn-voltar"
            >
                Voltar ao Painel Geral
            </a>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>