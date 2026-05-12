<?php
/**
 * ========================================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal – versão refatorada
 * Arquivo    : catalogo.php (migrado de 03_pdo/index.php)
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * Descrição  : Lista pública de tecnologias do banco unificado.
 * Exibe apenas registros com status = 'ativo'.
 * ========================================================================
 */

// session_start() é idempotente: já iniciada não dá erro,
// mas chamar duas vezes gera warning. session_status() evita isso.
if (session_status() === PHP_SESSION_NONE) session_start();

// Trio padrão de variáveis que cabecalho.php espera:
// $pagina_atual -> marca o item ativo no nav (cor dourada)
// $titulo_pagina -> texto da aba do navegador
// $caminho_raiz -> caminho relativo até a raiz do projeto
$pagina_atual = 'catalogo';
$titulo_pagina = 'Catálogo de Tecnologias | Portfólio DWII';
$caminho_raiz = './';

// __DIR__ retorna o caminho ABSOLUTO do diretório deste arquivo,
// independente de qual pasta você estava ao executar o PHP.
// Resolve P10 (caminhos frágeis dependentes do CWD).
require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/cabecalho.php';

// conectar() devolve uma instância PDO nova.
// Padrão função (vs $pdo global) deixa explícito que estamos
// abrindo conexão – não acontece como efeito colateral do include.
$pdo = conectar();

// Filtro WHERE status = 'ativo':
// tecnologias com status = 'inativo' ainda existem no banco,
// mas não aparecem ao visitante. O painel admin pode listar
// todas (filtro diferente) para reativar quando quiser.
$stmt = $pdo->query(
    "SELECT * FROM tecnologias 
     WHERE status = 'ativo' 
     ORDER BY nome ASC"
);

$tecnologias = $stmt->fetchAll();
?>

<main>
    
    <div class="inicio">
        <h1>Catálogo de Tecnologias</h1>
        <p>Conheça as tecnologias que utilizo em meus projetos.</p>
    </div>

    <?php if (empty($tecnologias)): ?>
        <div class="card text-center" style="padding: 60px 20px;">
            <p style="font-size: 48px; margin: 0 0 16px;">📁</p>
            <h3 style="color: var(--neutral-600); margin: 0;">Nenhuma tecnologia ativa</h3>
            <p class="text-muted" style="margin-top: var(--spacing-md);">
                As tecnologias serão adicionadas em breve.
            </p>
        </div>
    <?php else: ?>

        <div class="cards-grid">
            <?php foreach ($tecnologias as $tec): ?>
                <article class="card">
                    
                    <!-- Header do Card -->
                    <div class="flex-between mb-3">
                        <h3 style="margin: 0; color: var(--neutral-900);">
                            <?php 
                            // htmlspecialchars() converte < > " & em entidades.
                            // Bloqueia XSS – se um atacante salvar <script>
                            // no banco, vira texto literal aqui, não código.
                            echo htmlspecialchars($tec['nome']); 
                            ?>
                        </h3>
                    </div>

                    <!-- Badge de Categoria -->
                    <div class="mb-3">
                        <span class="badge badge-gold">
                            <?php echo htmlspecialchars($tec['categoria']); ?>
                        </span>
                    </div>
                    
                    <!-- Descrição -->
                    <p class="text-muted mb-4">
                        <?php echo htmlspecialchars($tec['descricao']); ?>
                    </p>
                    
                    <!-- Botão de Ação -->
                    <div class="flex-between" style="margin-top: auto;">
                        <a href="detalhe.php?id=<?php echo (int)$tec['id']; ?>" class="btn btn-outline btn-small">
                            Ver detalhes →
                        </a>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <!-- Botão Voltar -->
    <div style="text-align: center; margin-top: var(--spacing-2xl);">
    <a href="index.php" class="btn-voltar">
        ← Voltar ao Início
    </a>
</div>


</main>
<?php require_once __DIR__ . '/includes/rodape.php'; ?>
