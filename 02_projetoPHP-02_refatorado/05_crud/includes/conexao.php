<?php
/**
 * ___________________________________________________________________________
 * * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal – versão refatorada
 * Arquivo    : includes/conexao.php
 * Autor      : Henry
 * Data       : 06/05/2026
 * Descrição  : Conexão PDO única do projeto.
 * Resolve P5 (dois bancos) e P6 (dois conexao.php).
 * ___________________________________________________________________________
 */

/**
 * conectar() – cria e devolve uma instância PDO conectada ao
 * banco 'portfolio'. Cada chamada abre uma nova conexão.
 *
 * Retorno: PDO pronto para uso (query, prepare, etc.)
 * Em caso de falha: encerra com mensagem amigável (die).
 */
function conectar(): PDO
{
    // 127.0.0.1 força TCP – 'localhost' tentaria socket Unix,
    // que falha em containers (Codespaces / DevContainer).
    $dsn = 'mysql:host=127.0.0.1;dbname=portfolio;charset=utf8mb4';
    $usuario = 'root';
    $senha = 'dwii2026'; // senha padrão do ambiente do curso

    try {
        // O 4º argumento é um array de OPÇÕES do PDO.
        // Cada constante muda o comportamento do objeto.
        return new PDO($dsn, $usuario, $senha, [

            // ERRMODE_EXCEPTION: erros de SQL viram PDOException
            // (capturáveis com try/catch). Sem isso, falhas
            // passam silenciosamente – pesadelo de debug.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

            // FETCH_ASSOC: fetchAll() devolve só o array com
            // chaves de coluna (['nome' => '...']) em vez de
            // dobrado com índices numéricos.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

            // EMULATE_PREPARES = false: usa prepared statements
            // REAIS do MariaDB, não simulação. Mais seguro contra
            // SQL Injection e tipos vêm corretos do banco.
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $e) {
        // Em produção: registre $e->getMessage() em arquivo de log,
        // NUNCA exiba detalhes da exceção ao usuário (vaza host,
        // usuário, estrutura do banco para um possível atacante).
        die('Erro de conexão com o banco de dados.');
    }
}