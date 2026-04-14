# 🚀 Portfólio Dinâmico — Gestão de Projetos (DWII)

## 📖 Sobre o Projeto

Este projeto consiste em um sistema de gerenciamento de portfólio acadêmico desenvolvido para a disciplina de Desenvolvimento Web II. O objetivo principal é aplicar, na prática, o ciclo **CRUD (Create, Read, Update, Delete)**, integrando **PHP 8** com **MariaDB**.

O sistema permite o controle completo de projetos, com foco em:

* 🔒 Segurança
* 🧩 Modularização
* 🎯 Experiência do usuário (UX)

---

## 📁 Estrutura de Arquivos

```text
/
├── includes/               
│   ├── cabecalho.php
│   └── rodape.php
│
├── 04_sessoes/             
│   └── includes/
│       └── auth.php        # Middleware de segurança (requer_login)
│
└── 05_crud/                
    ├── includes/
    │   └── conexao.php     # Conexão PDO + tratamento de erros
    │
    ├── index.php           # Listagem de projetos (Read)
    ├── cadastrar.php       # Inserção de dados (Create)
    ├── editar.php          # Atualização de dados (Update)
    ├── excluir.php         # Remoção de dados (Delete)
    └── detalhe.php         # Visualização completa
```

---

## 🛠 Decisões de Refatoração

### 🔐 Tratamento de Exceções (PDOException)

* **Antes:** `die($e->getMessage())`
* **Agora:** uso de `try/catch`

**Motivo:**
Evita expor informações sensíveis do banco de dados.
Erros são registrados com `error_log()` e o usuário recebe apenas uma mensagem amigável.

---

### 💾 Persistência de Dados em Formulários

* **Implementação:** `array_merge($projeto, $_POST)`

**Motivo:**
Evita que o usuário perca os dados preenchidos ao ocorrer erro de validação.

---

### 🎨 Layout Responsivo com CSS Grid

* **Uso:** `display: grid` + `repeat(auto-fill, minmax(320px, 1fr))`

**Motivo:**

* Melhor adaptação em diferentes telas
* Centralização automática
* Layout mais moderno

---

### 🛡 Sanitização contra XSS

* **Funções utilizadas:**

  * `htmlspecialchars()`
  * `nl2br()`

**Motivo:**
Impede a execução de scripts maliciosos inseridos pelo usuário.

---

## 🚀 Como Executar

### 📌 Pré-requisitos

* PHP 8.2+
* MariaDB
* Ambiente local ou Docker

---

### ⚙️ Passos

1. Clone ou baixe o projeto
2. Importe o banco de dados conforme fornecido na disciplina
3. No terminal, execute:

```bash
php -S localhost:8000
```

4. Acesse no navegador:

```
http://localhost:8000/05_crud/index.php
```

---

## 👤 Autor

* **Nome:** Henry Rafael Ribeiro Portes
* **Curso:** Técnico em Informática Integrado ao Ensino Médio
* **Disciplina:** Desenvolvimento Web II (DWII)
* **Ano:** 2026

---

## 📌 Observações

Projeto focado em boas práticas de desenvolvimento web, com ênfase em:

* Segurança de aplicações
* Organização de código
* Experiência do usuário
