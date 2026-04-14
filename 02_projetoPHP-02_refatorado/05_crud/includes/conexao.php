<?php
// Ativa a tipagem estrita do PHP para garantir que a função sempre retorne um PDO
declare(strict_types=1);

/**
 * ========================================================
 * ARQUIVO: 05_crud/includes/conexao.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 07 - CRUD: Create e Read
 * Descrição: Função para criar e retornar a conexão PDO.
 * Autor: Henry
 * =========================================================
 */

/**
 * conectar()
 * Retorna uma instância PDO pronta para uso.
 * Configurada para o banco 'portfolio'.
 */
function conectar(): PDO
{
    // 1. Configurações da Conexão
    // Lembrete: Em produção, o ideal é puxar esses dados de um arquivo .env
    $host    = '127.0.0.1';
    $db      = 'portfolio';
    $user    = 'root';
    $pass    = 'dwii2026';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    // 2. Opções de Configuração (Segurança e Performance)
    $opcoes = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Interrompe e avisa caso haja erro de sintaxe SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Garante que as consultas retornem Arrays Associativos limpos
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Fundamental: Desativa emulação para bloquear SQL Injection
    ];

    try {
        // 3. Cria e retorna a conexão
        return new PDO($dsn, $user, $pass, $opcoes);
    } catch (PDOException $e) {
        // 4. Tratamento de Erro Seguro
        // Salva o erro real (que pode conter IP ou senha) de forma invisível nos logs do servidor
        error_log("Erro crítico no PDO (banco 'portfolio'): " . $e->getMessage());
        
        // Exibe uma tela de erro elegante e blindada para o usuário/desenvolvedor
        die("
            <div style='font-family: system-ui, sans-serif; text-align: center; padding: 2.5rem; color: #dc2626; background: #fef2f2; border: 2px solid #fecaca; border-radius: 12px; max-width: 500px; margin: 3rem auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);'>
                <div style='font-size: 3rem; margin-bottom: 1rem;'>🔌</div>
                <h2 style='margin-top: 0; color: #991b1b;'>Falha de Conexão</h2>
                <p style='color: #b91c1c; line-height: 1.5; margin-bottom: 0;'>
                    Não foi possível conectar ao banco de dados <strong>'portfolio'</strong>. <br>
                    Verifique se o container MariaDB/MySQL está em execução.
                </p>
            </div>
        ");
    }
}

// Sem a tag "? >" de fechamento para evitar o envio de espaços em branco antes do HTML.