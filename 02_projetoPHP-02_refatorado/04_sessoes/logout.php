<?php
/**
 * ========================================================
 * ARQUIVO: 04_sessoes/logout.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Autor: Henry
 * =========================================================
 */

// 1. Recupera a sessão atual para poder manipulá-la
session_start();

// 2. Esvazia todas as variáveis da sessão
// Boa prática: Atribuir um array vazio é a forma mais moderna e recomendada
// pelo manual do PHP em vez de usar a antiga função session_unset().
$_SESSION = [];

// 3. Destrói os dados da sessão armazenados no servidor
session_destroy();

// 4. Invalida o cookie de sessão no navegador do usuário (Segurança Máxima)
// Isso impede que alguém capture o cookie antigo e tente sequestrar a sessão.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000, // Define o vencimento para o passado (força a exclusão)
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// 5. Redireciona de volta para a tela de login
header('Location: login.php');
exit; // O exit é crucial após um header de redirecionamento.

// Omitimos intencionalmente a tag de fechamento "? >".