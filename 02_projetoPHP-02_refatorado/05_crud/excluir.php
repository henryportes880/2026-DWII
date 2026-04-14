<?php
/**
 * ========================================================
 * ARQUIVO: 05_crud/excluir.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 07 - CRUD Completo: Delete
 * Autor: Henry
 * Descrição: Implementa a remoção segura de registros.
 * =========================================================
 */

// 1. Proteção e Dependências
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

// 2. Validação do ID (GET)
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?erro=id_invalido');
    exit;
}

// 3. Verifica se o projeto existe antes de confirmar
$pdo = conectar();
$stmt = $pdo->prepare('SELECT nome FROM projetos WHERE id = :id');
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();

if (!$projeto) {
    header('Location: index.php?erro=nao_encontrado');
    exit;
}

// 4. Processamento da Exclusão (SÓ via POST por segurança)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare('DELETE FROM projetos WHERE id = :id');
        $stmt->execute([':id' => $id]);

        header('Location: index.php?excluido=ok');
        exit;
    } catch (PDOException $e) {
        error_log("Erro ao excluir: " . $e->getMessage());
        die("Erro crítico ao processar a exclusão. O administrador foi notificado.");
    }
}

// 5. Variáveis de Template
$titulo_pagina = 'Confirmar Exclusão | CRUD';
$caminho_raiz  = '../';
$pagina_atual  = 'crud';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main class="container" style="max-width: 800px; margin: 0 auto; padding: 3rem 1rem;">
    
    <header style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">⚠️</div>
        <h1 style="color: #991b1b; font-size: 2.2rem;">Confirmar Exclusão</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem;">Esta é uma operação crítica e irreversível.</p>
    </header>

    <article class="card" style="border: 2px solid #fecaca; padding: 0; overflow: hidden; box-shadow: var(--shadow-lg);">
        
        <div style="background: #fee2e2; padding: 1.5rem 2.5rem; border-bottom: 1px solid #fecaca;">
            <p style="color: #991b1b; margin: 0; font-weight: 500;">
                Você está prestes a excluir permanentemente o registro abaixo:
            </p>
        </div>

        <div style="padding: 2.5rem; text-align: center;">
            <h2 style="font-size: 1.8rem; color: var(--text-heading); margin-bottom: 1rem;">
                "<?= htmlspecialchars($projeto['nome']) ?>"
            </h2>
            <p style="color: var(--text-muted); line-height: 1.6;">
                Ao confirmar, todos os dados associados a este projeto serão removidos do banco de dados <strong>portfolio</strong>.
            </p>
        </div>

        <footer style="background: var(--bg-surface-hover); padding: 2rem; border-top: 1px solid var(--border-light); text-align: center;">
            <form action="excluir.php?id=<?= $id ?>" method="POST" style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                
                <button type="submit" class="btn" style="background: #dc2626; color: white; border: none; padding: 1rem 2.5rem; font-size: 1.1rem; font-weight: 600; width: 100%; max-width: 400px; box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2);">
                    🗑️ Sim, excluir permanentemente
                </button>

                <a href="index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-light); padding: 0.8rem 2rem; width: 100%; max-width: 400px; text-decoration: none;">
                    Não, cancelar e voltar
                </a>
            </form>
        </footer>
    </article>

</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>