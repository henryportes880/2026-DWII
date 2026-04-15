<?php
/**
 * ===============================================================
 * Arquivo: 01_php-intro/projetos.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 03 - Arquitetura Web e Introdução ao PHP
 * Autor: Henry
 * ===============================================================
 */
    // Variáveis PHP
    $nome = "Henry";
    $curso = "Técnico em Informática - IFPR";
    $pagina_atual = "projetos"; 
    $caminho_raiz = "../"; 
    $titulo_pagina = "Projetos - {$nome}";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php include '../includes/cabecalho.php'; ?>

    <main>
        
        <div class="inicio">
            <h1>Meus Projetos</h1>
            <p>No meu curso <strong><?php echo $curso; ?></strong> e nas aulas da <strong>Lions</strong>, desenvolvi diversos projetos. Abaixo, listo os que considero mais relevantes:</p>
        </div>

        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">HTML / CSS</span>
            </div>
            <h2>Site Portfólio</h2>
            <p>Primeiro projeto prático na disciplina de Desenvolvimento Web II, focado em estruturação semântica e estilização moderna para apresentação pessoal.</p>
        </article>

        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">Bootstrap</span>
            </div>
            <h2>Formulário Responsivo</h2>
            <p>Trabalho focado em responsividade e componentes prontos, utilizando diferentes tipos de inputs e validações básicas de front-end.</p>
        </article>

        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">Python</span>
            </div>
            <h2>Sistema de Agendamento</h2>
            <p>Desenvolvido na disciplina de Programação, este sistema conta com tela de login, cadastro de usuários e um módulo de agendamentos para organização de serviços autônomos.</p>
        </article>

        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">Lógica de Programação</span>
            </div>
            <h2>CRUD Lions</h2>
            <p>Projeto de manipulação de dados onde apliquei conceitos de Listagem, Cadastro, Alteração e Exclusão (CRUD), integrando a lógica com armazenamento de informações.</p>
        </article>

        <article class="card">
            <div style="margin-bottom: 0.75rem;">
                <span class="badge">PHP / MySQL</span>
            </div>
            <h2>Projeto Integrador Web</h2>
            <p>Aplicação completa utilizando HTML, CSS e PHP com conexão a banco de dados. O sistema permite o gerenciamento completo de registros, unindo tudo o que foi aprendido no IFPR.</p>
        </article>

        <div style="text-align: center; margin-top: 2.5rem;">
            <a href="../index.php" class="btn">← Voltar ao início</a>
        </div>

    </main>  

    <?php include '../includes/rodape.php'; ?>

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
        .card:nth-child(5) { animation-delay: 0.4s; }
        .card:nth-child(6) { animation-delay: 0.5s; }

        @media (max-width: 768px) {
            main {
                gap: 2rem;
            }
        }
    </style>

</body>
</html>
