<?php
function requer_login() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        // Usamos o caminho relativo para voltar uma pasta e achar o arquivo
        // Se você estiver no CRUD, ele volta para a raiz e entra em 04_sessoes
        header('Location: ../04_sessoes/acesso_negado.php');
        exit;
    }
}