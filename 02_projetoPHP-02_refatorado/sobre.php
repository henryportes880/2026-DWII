<?php
/**
 * ===============================================================
 * Arquivo: 01_php-intro/sobre.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 03 - Arquitetura Web e Introdução ao PHP
 * Autor: Henry
 * ===============================================================
 */

if (session_status() === PHP_SESSION_NONE){
 session_start();
 }

    // Variáveis PHP
    $nome = "Henry";
    $idade = 17;
    $pagina_atual = "sobre";
    $caminho_raiz = "./"; 
    $titulo_pagina = "Sobre mim - {$nome}";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    


    <main>
        
        <div class="inicio">
            <h1>Sobre mim</h1>
            <p>Conheça um pouco mais sobre minha trajetória, interesses e objetivos profissionais.</p>
        </div>
        
        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">Perfil</span>
            </div>
            <h2>Quem sou eu</h2>
            <p>Olá! Meu nome é <strong><?php echo $nome; ?></strong>, tenho <?php echo $idade; ?> anos e moro em Ponta Grossa, no Paraná.</p>
            <p style="margin-top: 0.5rem;">Atualmente, curso o 3° ano do Ensino Médio Técnico no <strong>IFPR</strong>. Além das aulas no instituto, também busco me aprimorar através do curso na <strong>Lions</strong>, focando sempre em aprender coisas novas no universo da tecnologia.</p>
        </article>

        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">Tecnologia</span>
            </div>
            <h2>Por que a Informática?</h2>
            <p>Sempre tive curiosidade em entender como os sistemas funcionam por trás de uma interface bonita. Escolhi a área pela facilidade que tenho com exatas e pelo interesse em descobrir como a tecnologia pode solucionar problemas reais.</p>
            <p style="margin-top: 0.5rem;">Durante o curso, desenvolvi um interesse especial pela área de <strong>banco de dados</strong>, pois acho fascinante a forma como as informações são organizadas e estruturadas.</p>
        </article>

        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">Pessoal & Futuro</span>
            </div>
            <h2>Hobbies e Objetivos</h2>
            <p>No meu tempo livre, gosto de aproveitar o momento com meus amigos e família, ouvir música e assistir a séries e filmes.</p>
            <p style="margin-top: 0.5rem;">Meu objetivo principal a curto prazo é concluir o curso técnico. Em seguida, pretendo ingressar em uma faculdade na área de TI e construir uma carreira sólida no mercado.</p>
        </article>

        <div style="text-align: center; margin-top: 2.5rem;">
            <a href="index.php" class="btn">← Voltar ao início</a>
        </div>

    </main>

    <?php include __DIR__ . '/includes/rodape.php'; ?>

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

        main {
            animation: fadeInUp 0.8s ease-out;
        }

        .card {
            animation: fadeInUp 0.8s ease-out backwards;
        }

        .card:nth-child(2) { animation-delay: 0.1s; }
        .card:nth-child(3) { animation-delay: 0.2s; }
        .card:nth-child(4) { animation-delay: 0.3s; }

        @media (max-width: 768px) {
            main {
                gap: 2rem;
            }
        }
    </style>

</body>
</html>
