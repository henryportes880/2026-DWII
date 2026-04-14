<?php
/**
 * ========================================================
 * ARQUIVO: 05_crud/cadastrar.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 07 - CRUD: Create e Read
 * Autor: Henry
 * Descrição: Formulário e processamento de inserção (INSERT)
 * =========================================================
 */

// 1. Proteção e Dependências
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

$erro = '';
$form = [
    'nome' => '', 'descricao' => '', 'tecnologias' => '', 
    'link_github' => '', 'ano' => date('Y'),
];

// 2. Processamento do POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura e sanitiza (trim remove espaços em branco acidentais nas pontas)
    $form['nome']        = trim($_POST['nome'] ?? '');
    $form['descricao']   = trim($_POST['descricao'] ?? '');
    $form['tecnologias'] = trim($_POST['tecnologias'] ?? '');
    $form['link_github'] = trim($_POST['link_github'] ?? '');
    $form['ano']         = (int) ($_POST['ano'] ?? date('Y'));

    // Validações
    if ($form['nome'] === '') {
        $erro = 'O nome do projeto é obrigatório.';
    } elseif ($form['descricao'] === '') {
        $erro = 'A descrição é obrigatória.';
    } elseif ($form['tecnologias'] === '') {
        $erro = 'Informe ao menos uma tecnologia.';
    } elseif ($form['ano'] < 2000 || $form['ano'] > (int)date('Y')) {
        $erro = 'Informe um ano válido entre 2000 e ' . date('Y') . '.';
    }

    // Persistência
    if ($erro === '') {
        try {
            $pdo = conectar();
            $sql = 'INSERT INTO projetos (nome, descricao, tecnologias, link_github, ano)
                    VALUES (:nome, :descricao, :tecnologias, :link_github, :ano)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome'        => $form['nome'],
                ':descricao'   => $form['descricao'],
                ':tecnologias' => $form['tecnologias'],
                ':link_github' => $form['link_github'] !== '' ? $form['link_github'] : null,
                ':ano'         => $form['ano'],
            ]);
            
            // Redireciona com parâmetro de sucesso na URL (GET)
            header('Location: index.php?cadastro=ok');
            exit;
        } catch (PDOException $e) {
            // SEGURANÇA: Registra o erro real no servidor de forma silenciosa
            error_log('Erro PDO ao cadastrar projeto: ' . $e->getMessage());
            // Exibe apenas uma mensagem amigável e genérica para o usuário
            $erro = 'Ocorreu um erro interno ao salvar o projeto. Tente novamente mais tarde.';
        }
    }
}

// 3. Variáveis de Template
$titulo_pagina = 'Novo Projeto | CRUD';
$caminho_raiz  = '../';
require_once __DIR__ . '/../includes/cabecalho.php';
?>

<main style="max-width: 700px; margin: 0 auto;">
    
    <div style="margin-bottom: 2rem;">
        <a href="index.php" class="btn" style="background: var(--bg-surface); color: var(--text-heading); border: 1px solid var(--border-focus); box-shadow: none; display: inline-block;">
            ← Voltar para a lista
        </a>
    </div>

    <section class="inicio" style="margin-bottom: 2.5rem; text-align: center;">
        <h1 style="font-size: 2.2rem; margin-bottom: 0.75rem;">➕ Novo Projeto</h1>
        <p style="color: var(--neutral-600); font-size: 1.05rem;">Preencha os dados abaixo para adicionar um novo projeto ao portfólio.</p>
    </section>

    <article class="card" style="padding: 2.5rem 2rem; box-shadow: var(--shadow-lg);">
        
        <!-- ALERTA DE ERRO -->
        <?php if ($erro): ?>
            <div style="background: #fef2f2; color: #dc2626; border: 2px solid #fecaca; padding: 1.25rem; border-radius: var(--radius-md); margin-bottom: 2rem; display: flex; align-items: flex-start; gap: 1rem; box-shadow: 0 4px 6px rgba(220, 38, 38, 0.1); animation: slideIn 0.3s ease-out;">
                <span style="font-size: 1.5rem; flex-shrink: 0;">🚫</span>
                <p style="margin: 0; font-weight: 500; font-size: 0.95rem; line-height: 1.5;"><?php echo htmlspecialchars($erro); ?></p>
            </div>
        <?php endif; ?>

        <!-- FORMULÁRIO -->
        <form action="cadastrar.php" method="post" style="display: flex; flex-direction: column; gap: 1.75rem;">
            
            <!-- Campo: Nome do Projeto -->
            <div>
                <label for="nome" style="font-weight: 700; color: var(--text-heading); font-size: 0.95rem; display: block; margin-bottom: 0.5rem;">
                    Nome do Projeto <span style="color: #dc2626; font-weight: 900;">*</span>
                </label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    value="<?= htmlspecialchars($form['nome']) ?>" 
                    placeholder="Ex: E-commerce em PHP" 
                    maxlength="120" 
                    required 
                    style="width: 100%; padding: 0.85rem; border: 2px solid var(--border-light); border-radius: var(--radius-md); background: var(--bg-surface); font-family: inherit; font-size: 1rem; outline: none; transition: 0.2s;"
                    onmouseover="this.style.borderColor='var(--primary)'"
                    onmouseout="this.style.borderColor='var(--border-light)'"
                    onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 3px rgba(21, 101, 192, 0.1)'"
                    onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none'"
                >
            </div>

            <!-- Campo: Descrição -->
            <div>
                <label for="descricao" style="font-weight: 700; color: var(--text-heading); font-size: 0.95rem; display: block; margin-bottom: 0.5rem;">
                    Descrição <span style="color: #dc2626; font-weight: 900;">*</span>
                </label>
                <textarea 
                    id="descricao" 
                    name="descricao" 
                    rows="4" 
                    placeholder="O que este projeto faz? Descreva brevemente..." 
                    required 
                    style="width: 100%; padding: 0.85rem; border: 2px solid var(--border-light); border-radius: var(--radius-md); background: var(--bg-surface); font-family: inherit; font-size: 1rem; outline: none; resize: vertical; transition: 0.2s;"
                    onmouseover="this.style.borderColor='var(--primary)'"
                    onmouseout="this.style.borderColor='var(--border-light)'"
                    onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 3px rgba(21, 101, 192, 0.1)'"
                    onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none'"
                ><?= htmlspecialchars($form['descricao']) ?></textarea>
            </div>

            <!-- Campo: Tecnologias -->
            <div>
                <label for="tecnologias" style="font-weight: 700; color: var(--text-heading); font-size: 0.95rem; display: block; margin-bottom: 0.5rem;">
                    Tecnologias <span style="color: #dc2626; font-weight: 900;">*</span>
                </label>
                <input 
                    type="text" 
                    id="tecnologias" 
                    name="tecnologias" 
                    value="<?= htmlspecialchars($form['tecnologias']) ?>" 
                    placeholder="Ex: PHP, MySQL, CSS, JavaScript" 
                    required 
                    style="width: 100%; padding: 0.85rem; border: 2px solid var(--border-light); border-radius: var(--radius-md); background: var(--bg-surface); font-family: inherit; font-size: 1rem; outline: none; transition: 0.2s;"
                    onmouseover="this.style.borderColor='var(--primary)'"
                    onmouseout="this.style.borderColor='var(--border-light)'"
                    onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 3px rgba(21, 101, 192, 0.1)'"
                    onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none'"
                >
                <p style="font-size: 0.8rem; color: var(--neutral-500); margin-top: 0.4rem;">💡 Separe as tecnologias por vírgula</p>
            </div>

            <!-- Campos: GitHub e Ano -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.75rem;">
                
                <!-- Campo: GitHub -->
                <div>
                    <label for="link_github" style="font-weight: 700; color: var(--text-heading); font-size: 0.95rem; display: block; margin-bottom: 0.5rem;">
                        GitHub (URL) <span style="color: var(--neutral-400); font-weight: 400;">Opcional</span>
                    </label>
                    <input 
                        type="url" 
                        id="link_github" 
                        name="link_github" 
                        value="<?= htmlspecialchars($form['link_github']) ?>" 
                        placeholder="https://github.com/seu-usuario/projeto" 
                        style="width: 100%; padding: 0.85rem; border: 2px solid var(--border-light); border-radius: var(--radius-md); background: var(--bg-surface); font-family: inherit; font-size: 1rem; outline: none; transition: 0.2s;"
                        onmouseover="this.style.borderColor='var(--primary)'"
                        onmouseout="this.style.borderColor='var(--border-light)'"
                        onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 3px rgba(21, 101, 192, 0.1)'"
                        onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none'"
                    >
                </div>
                
                <!-- Campo: Ano -->
                <div>
                    <label for="ano" style="font-weight: 700; color: var(--text-heading); font-size: 0.95rem; display: block; margin-bottom: 0.5rem;">
                        Ano de Conclusão <span style="color: #dc2626; font-weight: 900;">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="ano" 
                        name="ano" 
                        min="2000" 
                        max="<?= date('Y') ?>" 
                        value="<?= htmlspecialchars($form['ano']) ?>" 
                        required 
                        style="width: 100%; padding: 0.85rem; border: 2px solid var(--border-light); border-radius: var(--radius-md); background: var(--bg-surface); font-family: inherit; font-size: 1rem; outline: none; transition: 0.2s;"
                        onmouseover="this.style.borderColor='var(--primary)'"
                        onmouseout="this.style.borderColor='var(--border-light)'"
                        onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 3px rgba(21, 101, 192, 0.1)'"
                        onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none'"
                    >
                </div>
            </div>

            <!-- Botão de Envio -->
            <div style="margin-top: 1.5rem; padding-top: 2rem; border-top: 2px solid var(--border-light); text-align: center;">
                <button 
                    type="submit" 
                    class="btn" 
                    style="padding: 1rem 2.5rem; font-size: 1.05rem; font-weight: 700; box-shadow: 0 8px 16px rgba(21, 101, 192, 0.3); transition: 0.3s;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 24px rgba(21, 101, 192, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 16px rgba(21, 101, 192, 0.3)'"
                >
                    💾 Salvar Projeto
                </button>
            </div>

        </form>
    </article>

</main>

<!-- ANIMAÇÕES CSS -->
<style>
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
