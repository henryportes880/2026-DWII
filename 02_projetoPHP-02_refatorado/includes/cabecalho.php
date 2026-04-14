<?php
/**
 * ===============================================================
 * ARQUIVO: includes/cabecalho.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - Modularização e Estrutura de Layout
 * Autor: Henry
 * Descrição: Gera o <head>, links de estilo e navegação global.
 * ===============================================================
 */

// 1. Configurações de Segurança e Padrão
// isset() evita erros de "Variable undefined" caso a página esqueça de declarar.
if (!isset($titulo_pagina)) $titulo_pagina = 'Portfólio DWII';
if (!isset($caminho_raiz))  $caminho_raiz  = './'; 
if (!isset($pagina_atual))  $pagina_atual  = ''; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?php echo htmlspecialchars($titulo_pagina); ?></title>

    <link rel="stylesheet" href="<?php echo $caminho_raiz; ?>includes/style.css">
    
    <link rel="shortcut icon" href="<?php echo $caminho_raiz; ?>favicon.ico" type="image/x-icon">
</head>
<body>

<?php
/**
 * __DIR__ garante que o PHP encontre o nav.php na mesma pasta 
 * onde este cabecalho.php reside, não importa qual página o chamou.
 */
include __DIR__ . '/nav.php'; 
?>