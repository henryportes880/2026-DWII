<?php
/**
 * ========================================================
 * ARQUIVO: 03_pdo/includes/rod_pdo.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 05 - PHP + MariaDB: persistência de dados via PDO
 * Autor: Henry
 * =========================================================
 * * Proxy local para o rodapé: Reutiliza o arquivo global
 * que está na raiz do projeto (/includes/rodape.php).
 */

// Utilizamos require_once no lugar de include para garantir que 
// o rodapé principal seja carregado com sucesso e apenas uma vez.
require_once __DIR__ . '/../../includes/rodape.php';

// Omitimos a tag "? >" de fechamento intencionalmente (padrão PSR-12). 
// Isso evita o envio acidental de espaços em branco ou quebras de linha invisíveis.