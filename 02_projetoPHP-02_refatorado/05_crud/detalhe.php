<?php
/**
 * ========================================================
 * ARQUIVO: 05_crud/detalhe.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 07 - CRUD: Create e Read
 * Autor: Gabriela Bomfati Garcia
 * Descrição: Exibe detalhes completos de um projeto específico.
 * =========================================================
 */

// 1. Proteção e Dependências
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

// 2. Validação do ID (Casting para int garante segurança básica)
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    // Em vez de die(), poderíamos redirecionar com erro, 
    // mas aqui vamos apenas definir uma mensagem para exibir no template.
    $projeto = null;
    $erro_id = "ID de projeto inválido ou não fornecido.";
} else {
    // 3. Busca dos dados no Banco
    try {
        $pdo = conectar();
        $sql = 'SELECT * FROM projetos WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $projeto = $stmt->fetch();

        if (!$projeto) {
            $erro_id = "Projeto não encontrado em nossa base de dados.";
        }
    } catch (PDOException $e) {
        error_log("Erro ao buscar detalhes: " . $e->getMessage());
        $erro_id = "Ocorreu um erro ao processar sua solicitação.";
        $projeto = null;
    }
}

// 4. Variáveis de Template
$titulo_pagina = $projeto ? $projeto['nome'] . " | Detalhes" : "Erro | Detalhes";
$caminho_raiz  = '../';
$pagina_atual  = 'crud';

require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main>
    <div style="margin-bottom: 2rem;">
        <a href="index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none; display: inline-block;">
            ← Voltar para a Lista
        </a>
    </div>

    <?php if (isset($erro_id)): ?>
        <article class="card" style="text-align: center; padding: 4rem 2rem;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
            <h2 style="color: var(--text-heading); margin-bottom: 1rem;">Ops! Algo deu errado.</h2>
            <p style="color: var(--text-muted); margin-bottom: 2rem;"><?php echo $erro_id; ?></p>
            <a href="index.php" class="btn">Ver todos os projetos</a>
        </article>
    <?php else: ?>
        
        <section class="inicio" style="margin-bottom: 2.5rem;">
            <div style="margin-bottom: 0.5rem;">
                <span class="badge" style="background: var(--primary); color: white;">Ano: <?php echo htmlspecialchars((string)$projeto['ano']); ?></span>
            </div>
            <h1><?php echo htmlspecialchars($projeto['nome']); ?></h1>
        </section>

        <article class="card" style="padding: 0; overflow: hidden;">
            
            <div style="height: 8px; background: linear-gradient(90deg, var(--primary), var(--primary-hover));"></div>

            <div style="padding: 2.5rem;">
                <div style="margin-bottom: 2.5rem;">
                    <h3 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <span>📝</span> Descrição do Projeto
                    </h3>
                    <div style="line-height: 1.8; color: var(--text-body); font-size: 1.1rem; background: var(--bg-surface-hover); padding: 1.5rem; border-radius: var(--radius-sm); border-left: 4px solid var(--border-focus);">
                        <?php echo nl2br(htmlspecialchars($projeto['descricao'])); ?>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; align-items: start;">
                    
                    <div>
                        <h3 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.75rem;">
                            🚀 Tecnologias
                        </h3>
                        <p style="color: var(--text-heading); font-weight: 500;">
                            <?php 
                                // Transforma a string de tecnologias em mini badges
                                $techs = explode(',', $projeto['tecnologias']);
                                foreach($techs as $t): 
                            ?>
                                <span class="badge" style="background: var(--bg-surface-hover); color: var(--primary); border: 1px solid var(--border-light); margin-right: 4px; margin-bottom: 4px; display: inline-block;">
                                    <?php echo htmlspecialchars(trim($t)); ?>
                                </span>
                            <?php endforeach; ?>
                        </p>
                    </div>

                    <?php if ($projeto['link_github']): ?>
                    <div style="text-align: right;">
                        <h3 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.75rem;">
                            Repositório
                        </h3>
                        <a href="<?php echo htmlspecialchars($projeto['link_github']); ?>" target="_blank" class="btn" style="background: #24292e; color: white; border: none; display: inline-flex; align-items: center; gap: 0.75rem;">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                            Ver no GitHub
                        </a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

            <div style="background: var(--bg-surface-hover); padding: 1.25rem 2.5rem; border-top: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">
                    ID do Projeto: <code>#<?php echo $projeto['id']; ?></code>
                </span>
                <a href="editar.php?id=<?php echo $projeto['id']; ?>" style="color: var(--primary); font-weight: 600; text-decoration: none; font-size: 0.95rem;">
                    ✏️ Editar Projeto
                </a>
            </div>
        </article>

    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>