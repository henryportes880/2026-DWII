<?php
/**
 * ========================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal – versão refatorada
 * Arquivo    : detalhe.php (migrado de 03_pdo/detalhe.php)
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * Descrição  : Detalhe de uma tecnologia. Acessada via GET ?id=N.
 * Usa prepared statement para prevenir SQL Injection.
 * Só exibe registros com status = 'ativo'.
 * =========================================================
 */

if (session_status() === PHP_SESSION_NONE) session_start();

// $pagina_atual = 'catalogo' (não 'detalhe') porque queremos
// que o item "Catálogo" do nav fique destacado em ambas as páginas.
// Pedagogicamente: detalhe é uma sub-página do catálogo.
$pagina_atual = 'catalogo';
$titulo_pagina = 'Detalhe | Portfólio DWII';
$caminho_raiz = './';

require_once __DIR__ . '/includes/conexao.php';

// filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT):
// - retorna o INT se a string for um inteiro válido
// - retorna FALSE se não for inteiro (ex.: 'abc', '5.5', '5; DROP')
// - retorna NULL se 'id' não estiver na URL
// Já elimina entrada maliciosa antes mesmo de chegar ao banco.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Cinto + suspensórios: além do filter_input, exigimos id > 0.
// IDs sempre começam em 1 – qualquer valor <= 0 é entrada inválida.
if (!$id || $id <= 0) {
    header('Location: catalogo.php');
    exit; // SEMPRE após header() - sem o exit, código continua executando.
}

$pdo = conectar();

// Prepared statement: o valor :id é enviado SEPARADO da string SQL.
// O banco trata como dado, NUNCA como código. SQL Injection
// fica impossível, mesmo se o atacante mandar `?id=1; DROP TABLE`.
//
// Filtro AND status = 'ativo': mesmo que alguém adivinhe um id
// de tecnologia inativa, ele não consegue acessar o detalhe.
$stmt = $pdo->prepare(
"SELECT * FROM tecnologias 
WHERE id = :id 
AND status = 'ativo' 
LIMIT 1"
);
$stmt->execute([':id' => $id]);
$tec = $stmt->fetch();

// $tec === false quando: id não existe OU está inativo.
// Em qualquer caso, redirecionamos sem revelar o motivo
// (boa prática: não dar pistas a quem está sondando).
if (!$tec) {
    header('Location: catalogo.php');
    exit;
}

// Atualiza o título da aba com o nome da tecnologia.
// Movido para DEPOIS do fetch porque depende dos dados.
$titulo_pagina = htmlspecialchars($tec['nome']) . ' | Portfólio DWII';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container">
    <a href="catalogo.php" class="btn-secundario" 
    style="display: inline-block; margin-bottom: 20px;">← Voltar ao catálogo</a>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <h1 class="titulo-secao" style="margin: 0;">
                <?php echo htmlspecialchars($tec['nome']); ?>
            </h1>
            <span style="background: #e8edf5; color: #3b579d; padding: 4px 12px; 
            border-radius: 20px; font-size: 14px; white-space: nowrap; margin-left: 12px;">
                <?php echo htmlspecialchars($tec['categoria']); ?>
            </span>
        </div>

        <p><?php echo htmlspecialchars($tec['descricao']); ?></p>

        <p style="font-size: 13px; color: #6b7280; margin-top: 16px;">
        📅 Cadastrado em: 
        <?php echo date('d/m/Y', strtotime($tec['criado_em'])); ?>
        </p>
    </div>
    </div>

<?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>