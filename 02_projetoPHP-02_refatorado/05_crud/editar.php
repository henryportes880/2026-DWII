<?php
/**
 * ========================================================
 * ARQUIVO: 05_crud/editar.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 07 - CRUD Completo: Update
 * Autor: Henry
 * Descrição: Busca dados via GET e processa a atualização via POST.
 * =========================================================
 */

// 1. Proteção e Dependências
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

// 2. Validação do ID
$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php?erro=id_invalido');
    exit;
}

// 3. Busca dos dados originais
$pdo = conectar();
$stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id');
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();

if (!$projeto) {
    header('Location: index.php?erro=nao_encontrado');
    exit;
}

// 4. Processamento do formulário (POST)
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome        = trim($_POST['nome'] ?? '');
    $descricao   = trim($_POST['descricao'] ?? '');
    $tecnologias = trim($_POST['tecnologias'] ?? '');
    $link_github = trim($_POST['link_github'] ?? '');
    $link_deploy = trim($_POST['link_deploy'] ?? ''); 
    $ano         = (int) ($_POST['ano'] ?? date('Y'));

    if ($nome === '' || $descricao === '' || $tecnologias === '') {
        $erro = 'Por favor, preencha todos os campos obrigatórios (*).';
    } elseif ($ano < 2000 || $ano > (int)date('Y')) {
        $erro = 'Ano inválido.';
    }

    if ($erro === '') {
        try {
            $sql = "UPDATE projetos SET nome = :nome, descricao = :descricao, tecnologias = :tecnologias, 
                    link_github = :link_github, link_deploy = :link_deploy, ano = :ano WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome, ':descricao' => $descricao, ':tecnologias' => $tecnologias,
                ':link_github' => $link_github ?: null, ':link_deploy' => $link_deploy ?: null,
                ':ano' => $ano, ':id' => $id
            ]);
            header('Location: index.php?editado=ok');
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $erro = 'Erro interno ao salvar.';
        }
    }
    // Mantém os dados digitados no formulário em caso de erro
    $projeto = array_merge($projeto, $_POST);
}

// 5. Variáveis de Template
$titulo_pagina = 'Editar Projeto | CRUD';
$caminho_raiz  = '../';
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main class="container" style="max-width: 900px; margin: 0 auto; padding: 2rem 1rem;">
    
    <div style="margin-bottom: 2rem;">
        <a href="index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); display: inline-block;">
            ← Voltar para a lista
        </a>
    </div>

    <header style="text-align: center; margin-bottom: 3rem;">
        <span class="badge" style="background: var(--bg-surface-hover); color: var(--primary); margin-bottom: 1rem;">ID do Registro: #<?= $id ?></span>
        <h1 style="font-size: 2.5rem; color: var(--text-heading);">✏️ Editar Projeto</h1>
        <p style="color: var(--text-muted);">Atualize as informações do seu portfólio.</p>
    </header>

    <article class="card" style="padding: 2.5rem; box-shadow: var(--shadow-lg);">
        
        <?php if ($erro): ?>
            <div style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px;">
                <span>🚫</span> <strong><?= htmlspecialchars($erro) ?></strong>
            </div>
        <?php endif; ?>

        <form action="editar.php?id=<?= $id ?>" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-heading);">Nome do Projeto *</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($projeto['nome']) ?>" required style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-light); border-radius: 6px; background: var(--bg-surface);">
            </div>

            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-heading);">Descrição Completa *</label>
                <textarea name="descricao" rows="5" required style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-light); border-radius: 6px; background: var(--bg-surface); resize: vertical;"><?= htmlspecialchars($projeto['descricao']) ?></textarea>
            </div>

            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-heading);">Tecnologias *</label>
                <input type="text" name="tecnologias" value="<?= htmlspecialchars($projeto['tecnologias']) ?>" required style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-light); border-radius: 6px; background: var(--bg-surface);">
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-heading);">GitHub URL</label>
                    <input type="url" name="link_github" value="<?= htmlspecialchars($projeto['link_github'] ?? '') ?>" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-light); border-radius: 6px; background: var(--bg-surface);">
                </div>
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-heading);">Deploy URL</label>
                    <input type="url" name="link_deploy" value="<?= htmlspecialchars($projeto['link_deploy'] ?? '') ?>" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-light); border-radius: 6px; background: var(--bg-surface);">
                </div>
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-heading);">Ano</label>
                    <input type="number" name="ano" value="<?= (int)$projeto['ano'] ?>" min="2000" max="<?= date('Y') ?>" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-light); border-radius: 6px; background: var(--bg-surface);">
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-light); display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="index.php" class="btn" style="background: transparent; color: var(--text-muted); border: none;">Cancelar</a>
                <button type="submit" class="btn" style="padding: 0.8rem 2.5rem; font-weight: 600;">
                    💾 Salvar Alterações
                </button>
            </div>
        </form>
    </article>
</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>