<?php
function requer_login(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
}
function usuario_logado(): string
{
    return $_SESSION['usuario'] ?? '';  
}
?>