<?php
/**
 * ========================================================
 * ARQUIVO: 03_pdo/includes/cab_pdo.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 05 - PHP + MariaDB: persistência de dados via PDO
 * Autor: Henry
 * =========================================================
 * * Este arquivo facilita a inclusão do cabeçalho global.
 * __DIR__ garante que o PHP encontre a pasta certa independente
 * de onde o script principal esteja rodando.
 */

// 1. Definição de valores padrão usando o Operador de Coalescência Nula (PHP 7+)
// Isso substitui os blocos "if (!isset(...))" deixando o código muito mais limpo.
$titulo_pagina = $titulo_pagina ?? "Catálogo de Tecnologias";
$pagina_atual  = $pagina_atual  ?? "catalogo";

// 2. Caminho relativo da subpasta 03_pdo/ até a raiz para o CSS/Imagens
$caminho_raiz = '../';

// 3. Inclui o cabeçalho principal que está na raiz do projeto
// Utilizamos require_once no lugar de include para garantir que o 
// cabeçalho principal não seja carregado duas vezes por acidente.
require_once __DIR__ . '/../../includes/cabecalho.php';
?>