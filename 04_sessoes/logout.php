<?php
session_start();

// 1. Limpar todos os dados da sessão
session_unset();

// 2. Destruir a sessão no servidor
session_destroy();

// 3. Redirecionar para o login
header('Location: login.php');
exit;
?>