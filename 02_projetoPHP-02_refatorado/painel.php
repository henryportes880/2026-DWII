<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Arquivo : painel.php (raiz)
 * Descrição : Área restrita fundida com funcionalidades de contador e mensagens flash.
 */

require_once __DIR__ . '/includes/auth.php';
requer_login(); // Proteção de acesso

// 1. Contador de Visitas (Lógica do código antigo)
if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}
$_SESSION['visitas']++;

// 2. Variáveis de Template (Baseadas nas imagens, com títulos do antigo)
$pagina_atual = 'painel';
$titulo_pagina = 'Painel | Área Restrita';
$caminho_raiz = './';

require_once __DIR__ . '/includes/cabecalho.php';
?>

<main style="max-width: 900px; margin: 40px auto; padding: 0 20px;">

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <span>✨</span>
            <p style="margin: 0;"><?php echo htmlspecialchars($_SESSION['flash']); ?></p>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <section class="inicio" style="margin-bottom: 40px;">
        <h1>Painel de Controle</h1>
        <p>Olá, <strong><?= htmlspecialchars(usuario_atual()) ?></strong>! Bem-vindo à área restrita do sistema.</p>
    </section>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
        
        <article class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background: #fff;">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-top: 0;">
                <span>👤</span> Status da Sessão
            </h3>
            
            <ul style="list-style: none; padding: 0; line-height: 2;">
                <li style="display: flex; justify-content: space-between; border-bottom: 1px dashed #eee;">
                    <strong>Usuário:</strong> 
                    <span><?= htmlspecialchars(usuario_atual()) ?></span>
                </li>
                <li style="display: flex; justify-content: space-between; border-bottom: 1px dashed #eee;">
                    <strong>Visitas:</strong> 
                    <span style="background: #eee; padding: 2px 8px; border-radius: 10px; font-size: 0.9em;"><?php echo $_SESSION['visitas']; ?></span>
                </li>
            </ul>
            
            <div style="background: #f9f9f9; padding: 10px; border-radius: 4px; font-size: 0.85rem; color: #666; margin-top: 15px;">
                <p style="margin: 0;">💡 O contador aumenta a cada F5 porque a sessão persiste no servidor.</p>
            </div>
        </article>

        <article class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background: #fff; display: flex; flex-direction: column;">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-top: 0;">
                <span>📊</span> Ações
            </h3>
            <p style="color: #666; flex-grow: 1;">Gerencie seus projetos e informações de perfil.</p>
            
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <a href="projetos.php" style="display: block; text-align: center; padding: 10px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">📂 Gerenciar Projetos</a>
                <a href="perfil.php" style="display: block; text-align: center; padding: 10px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px;">⚙️ Meu Perfil</a>
            </div>
        </article>

    </div>

    <div style="text-align: center; border-top: 1px solid #eee; padding-top: 24px;">
    <a href="logout.php" style="color: #dc3545; text-decoration: none; font-weight: bold; padding: 10px 20px; border: 1px solid #dc3545; border-radius: 4px;">🚪 Encerrar Sessão</a>
</div>

</main>

<?php require_once __DIR__ . '/includes/rodape.php'; ?>