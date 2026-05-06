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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php
    // Note o __DIR__ aqui também – não dependemos do CWD em
    // NENHUM include do projeto.
    include __DIR__ . '/includes/cabecalho.php';
    ?>
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 class="titulo-secao" style="margin: 0;">Catálogo de Tecnologias</h1>
            <span style="color: #6b7280; font-size: 14px;">
                <?php echo count($tecnologias); ?> tecnologia(s)
            </span>
        </div>

        <?php if (empty($tecnologias)): ?>
            <div class="card" style="text-align: center; padding: 40px 20px; color: #6b7280;">
                <p style="font-size: 40px; margin: 0 0 12px;">📁</p>
                <p style="font-size: 16px; margin: 0;">Nenhuma tecnologia ativa.</p>
            </div>
        <?php else: ?>

            <?php foreach ($tecnologias as $tec): ?>
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <h3 style="margin: 0;">
                            <?php 
                            // htmlspecialchars() converte < > " & em entidades.
                            // Bloqueia XSS – se um atacante salvar <script>
                            // no banco, vira texto literal aqui, não código.
                            echo htmlspecialchars($tec['nome']); 
                            ?>
                        </h3>
                        <span style="background: #e8edf5; color: #3b579d; padding: 3px 10px; border-radius: 20px; font-size: 13px; white-space: nowrap;">
                            <?php echo htmlspecialchars($tec['categoria']); ?>
                        </span>
                    </div>
                    
                    <p style="margin: 0 0 10px;"><?php echo htmlspecialchars($tec['descricao']); ?></p>
                    
                    <div style="display: flex; justify-content: flex-end;">
                        <a href="detalhe.php?id=<?php echo (int)$tec['id']; ?>" class="btn-secundario">Ver detalhes →</a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>