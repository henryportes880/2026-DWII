<?php
/**
 * ========================================================
 * ARQUIVO: index.php (Página Principal do Portfólio)
 * Autor: Henry Portes
 * Descrição: Landing page do portfólio com apresentação
 *            pessoal e acesso rápido aos projetos
 * ========================================================
 */

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

// 1. CONFIGURAÇÃO DE CAMINHOS E DADOS
$pagina_atual = 'inicio';
$caminho_raiz = './'; 
$titulo_pagina = 'Portfólio - Henry Portes | Desenvolvedor em Formação';

// DADOS DO PERFIL
$nome = 'Henry Portes';
$email = '20241ctb0100075@estudantes.ifpr.edu.br';
$descricao = 'Bem-vindo ao meu portfólio! Aqui você encontrará um pouco mais sobre quem eu sou, minha trajetória e os projetos que venho desenvolvendo.';
$profissao = 'Desenvolvedor em Formação';
$instituicao = 'IFPR - Campus Ponta Grossa';

// 2. INCLUI O CABEÇALHO
include __DIR__ . '/includes/cabecalho.php';
?>

<main class="container">
    
    <!-- SEÇÃO HERO PREMIUM -->
    <section class="hero-section" style="display: flex; flex-wrap: wrap; align-items: center; gap: 4rem; text-align: left; margin-bottom: 4rem; animation: fadeInUp 0.8s ease-out;">
        
        <!-- COLUNA DE TEXTO -->
        <div class="texto-coluna" style="flex: 1; min-width: 300px;">
            
            <!-- Badge de Status -->
            <div style="margin-bottom: 1.5rem;">
                <span class="badge badge-gold" style="display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.85rem;">
                    🚀 <?= htmlspecialchars($profissao) ?>
                </span>
            </div>
            
            <!-- Título Principal -->
            <h1 style="font-size: clamp(2rem, 6vw, 3.5rem); margin-bottom: 1rem; line-height: 1.2;">
                Olá, eu sou <br>
                <span style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <?= htmlspecialchars($nome) ?>
                </span> 👋
            </h1>
            
            <!-- Subtítulo -->
            <p style="font-size: 1.15rem; margin-bottom: 1.5rem; color: var(--neutral-600); font-weight: 500;">
                Estudante de Tecnologia — <?= htmlspecialchars($instituicao) ?>
            </p>
            
            <!-- Descrição -->
            <p style="margin-bottom: 2.5rem; font-size: 1.05rem; line-height: 1.8; color: var(--neutral-600); max-width: 500px;">
                <?= htmlspecialchars($descricao) ?>
            </p>
            
            <!-- Botões de Ação -->
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="01_php-intro/projetos.php" class="btn btn-large" style="box-shadow: 0 8px 16px rgba(21, 101, 192, 0.3);">
                    📚 Meus Projetos
                </a>
                <a href="01_php-intro/sobre.php" class="btn btn-outline btn-large">
                    👤 Sobre Mim
                </a>
            </div>

            <!-- Links Sociais/Contato -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--neutral-200);">
                <p style="color: var(--neutral-500); font-size: 0.9rem; margin-bottom: 1rem;">Conecte-se comigo:</p>
                <div style="display: flex; gap: 1rem;">
                    <a href="mailto:<?= htmlspecialchars($email) ?>" title="Enviar Email" style="display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: var(--radius-full); background: var(--neutral-100); color: var(--primary); font-size: 1.3rem; transition: var(--transition-fast); text-decoration: none;" onmouseover="this.style.background='var(--primary)'; this.style.color='white';" onmouseout="this.style.background='var(--neutral-100)'; this.style.color='var(--primary)';">
                        ✉️
                    </a>
                    <a href="01_php-intro/sobre.php" title="Mais Informações" style="display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: var(--radius-full); background: var(--neutral-100); color: var(--primary); font-size: 1.3rem; transition: var(--transition-fast); text-decoration: none;" onmouseover="this.style.background='var(--primary)'; this.style.color='white';" onmouseout="this.style.background='var(--neutral-100)'; this.style.color='var(--primary)';">
                        ℹ️
                    </a>
                </div>
            </div>
        </div>

        <!-- COLUNA DE FOTO -->
        <div class="foto-coluna" style="flex: 0 0 auto; margin: 0 auto; animation: slideInRight 0.8s ease-out;">
            <div style="position: relative; width: 280px; height: 280px;">
                <!-- Fundo decorativo -->
                <div style="position: absolute; inset: -20px; background: var(--gradient-primary); border-radius: var(--radius-2xl); opacity: 0.1; z-index: 0;"></div>
                
                <!-- Imagem -->
                <img src="<?= $caminho_raiz ?>imgs/henry.jpg" 
                     alt="Foto de <?= htmlspecialchars($nome) ?>" 
                     style="position: relative; z-index: 1; width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-xl); box-shadow: var(--shadow-2xl); border: 6px solid white;">
            </div>
        </div>

    </section>

    <!-- SEÇÃO DE CARDS COM INFORMAÇÕES -->
    <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem; margin-top: 4rem; margin-bottom: 4rem;">
        
        <!-- Card: Curso -->
        <article class="card" style="padding: 2rem; text-align: center; animation: fadeInUp 0.8s ease-out 0.1s both;">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">🎓</div>
            <h3 style="color: var(--primary); margin-bottom: 0.75rem; font-size: 1.15rem; font-weight: 700;">Curso</h3>
            <p style="font-weight: 600; color: var(--neutral-900); margin-bottom: 0.5rem;">Técnico em Informática</p>
            <p style="font-size: 0.85rem; color: var(--neutral-500);">IFPR - Campus Ponta Grossa</p>
        </article>

        <!-- Card: Disciplina -->
        <article class="card" style="padding: 2rem; text-align: center; animation: fadeInUp 0.8s ease-out 0.2s both;">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">💻</div>
            <h3 style="color: var(--primary); margin-bottom: 0.75rem; font-size: 1.15rem; font-weight: 700;">Disciplina</h3>
            <p style="font-weight: 600; color: var(--neutral-900); margin-bottom: 0.5rem;">Desenvolvimento Web II</p>
            <p style="font-size: 0.85rem; color: var(--neutral-500);">Ano Letivo: 2026</p>
        </article>

        <!-- Card: Contato -->
        <article class="card" style="padding: 2rem; text-align: center; animation: fadeInUp 0.8s ease-out 0.3s both;">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">📧</div>
            <h3 style="color: var(--primary); margin-bottom: 0.75rem; font-size: 1.15rem; font-weight: 700;">Contato</h3>
            <p style="font-weight: 600; color: var(--neutral-900); margin-bottom: 0.5rem; font-size: 0.9rem; word-break: break-all;">
                <?= htmlspecialchars($email) ?>
            </p>
            <p style="font-size: 0.85rem; color: var(--neutral-500);">E-mail Institucional</p>
        </article>

    </section>

    <!-- SEÇÃO CTA (Call To Action) -->
    <section style="background: var(--gradient-primary); color: white; padding: 3rem 2rem; border-radius: var(--radius-2xl); text-align: center; margin-bottom: 2rem; box-shadow: var(--shadow-xl); animation: fadeInUp 0.8s ease-out 0.4s both;">
        <h2 style="color: white; margin-bottom: 1rem; font-size: 1.8rem;">Pronto para explorar meus projetos?</h2>
        <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: 2rem; font-size: 1.05rem; max-width: 500px; margin-left: auto; margin-right: auto;">
            Confira os trabalhos que venho desenvolvendo durante meu curso de Desenvolvimento Web.
        </p>
        <a href="01_php-intro/projetos.php" class="btn" style="background: white; color: var(--primary); font-weight: 700; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);">
            🚀 Ver Todos os Projetos
        </a>
    </section>

</main>

<!-- ANIMAÇÕES CSS -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .hero-section {
        animation: fadeInUp 0.8s ease-out;
    }

    @media (max-width: 768px) {
        .hero-section {
            gap: 2rem;
        }

        .foto-coluna {
            width: 100%;
            max-width: 260px;
        }
    }
</style>

<?php 
// 3. INCLUI O RODAPÉ
include __DIR__ . '/includes/rodape.php'; 
?>
