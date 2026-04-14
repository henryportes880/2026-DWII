<?php
/**
 * ========================================================
 * ARQUIVO: 03_pdo/includes/conexao.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Finalidade: Estabelecer conexão PDO com o MariaDB
 * Autor: Henry
 * =========================================================
 */

// 1. Configurações da Conexão (Baseadas no docker-compose.yml)
// Dica de Ouro: Em projetos reais/produção, nunca deixe senhas aqui.
// Use variáveis de ambiente (ex: $_ENV['DB_PASS'] ou a função getenv()).
$host    = '127.0.0.1';    
$db      = 'dwii_db';      
$user    = 'dwii_user';    
$pass    = 'dwii2026';     
$charset = 'utf8mb4';      

// 2. DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;sslmode=disabled";

// 3. Opções de Configuração do PDO (Boas práticas de segurança e performance)
$opcoes = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em erros (facilita o debug)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna arrays associativos por padrão
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desativa emulação para máxima segurança contra SQL Injection
];

// 4. Instância do PDO (Tentativa de Conexão)
try {
    $pdo = new PDO($dsn, $user, $pass, $opcoes);
} catch (PDOException $e) {
    // Segurança: Em produção, NUNCA exiba o erro real ($e->getMessage()) na tela.
    // Ele pode vazar dados do seu servidor. O correto é salvar em um log invisível.
    error_log("Erro no PDO: " . $e->getMessage()); 
    
    // Mensagem amigável para o usuário (ou desenvolvedor local)
    die("
        <div style='font-family: system-ui, sans-serif; text-align: center; padding: 3rem; color: #ef4444;'>
            <h1 style='margin-bottom: 0.5rem;'>❌ Falha na Conexão</h1>
            <p>Não foi possível conectar ao banco de dados. Verifique se o container MariaDB está rodando no Docker.</p>
        </div>
    ");
}

// Omitimos a tag "? >" de fechamento intencionalmente. 
// Isso evita o envio acidental de espaços em branco (output) antes dos "headers" das páginas.