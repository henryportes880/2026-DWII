<?php
// Ativa a tipagem estrita do PHP (Boas práticas modernas)
declare(strict_types=1);

/**
 * ========================================================
 * ARQUIVO: 04_sessoes/includes/auth.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 * Funções auxiliares para controle de sessão e proteção de rotas.
 */

/**
 * requer_login()
 * Bloqueia o acesso de usuários não autenticados.
 * Se não houver usuário na sessão, expulsa para a página de login.
 */
function requer_login(): void
{
    // Garante que a sessão seja iniciada apenas se já não estiver ativa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        // Redireciona para o login. 
        // O caminho é relativo ao script que CHAMA a função (ex: painel.php)
        header('Location: login.php');
        exit; // O exit é obrigatório para parar a execução do script vazado
    }
}

/**
 * usuario_logado()
 * Retorna o nome do usuário que está na sessão, ou uma string vazia se não logado.
 */
function usuario_logado(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Retorna o usuário usando o Operador de Coalescência Nula
    return $_SESSION['usuario'] ?? '';
}

/**
 * redirecionar_se_logado()
 * Evita que um usuário já autenticado acesse a página de login ou registro novamente.
 */
function redirecionar_se_logado(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['usuario'])) {
        header('Location: painel.php');
        exit;
    }
}

// Omitimos a tag "? >" de fechamento intencionalmente (padrão PSR-12). 
// Como este arquivo usa header(), qualquer espaço em branco vazado quebraria os redirecionamentos.