# 🚀 Portfólio Dinâmico — Gestão de Projetos

Sistema web desenvolvido para a disciplina de Desenvolvimento Web II (DWII), com foco na aplicação prática de CRUD utilizando PHP e MariaDB.

O projeto permite o gerenciamento completo de projetos acadêmicos através de um painel administrativo moderno, responsivo e seguro.

---

# ✨ Funcionalidades

- 🔐 Sistema de login com sessão
- 📁 Cadastro de projetos
- ✏️ Edição de projetos
- 🗑 Exclusão de projetos
- 👁 Visualização detalhada
- 🔗 Integração com links do GitHub
- 🧩 Tecnologias utilizadas em cada projeto
- 📅 Controle de ano/data do projeto
- 📱 Interface responsiva e moderna
- 🛡 Proteção contra XSS

---

# 🛠 Tecnologias Utilizadas

- PHP 8
- MariaDB
- HTML5
- CSS3
- PDO
- Sessions
- Docker / Dev Container

---

# 📁 Estrutura do Projeto

```text
/
├── .devcontainer/
│   ├── devcontainer.json
│   ├── docker-compose.yml
│   └── Dockerfile
│
├── 01_projetoPHP-01/
│
├── 02_projetoPHP-02_refatorado/
│   │
│   ├── includes/
│   │   ├── imgs/
│   │   │   └── henry.jpg
│   │   ├── auth.php
│   │   ├── cabecalho.php
│   │   ├── conexao.php
│   │   ├── nav.php
│   │   ├── rodape.php
│   │   ├── style.css
│   │   └── style2.css
│   │
│   ├── sql/
│   │   └── setup.sql
│   │
│   ├── admin.php
│   ├── catalogo.php
│   ├── contato.php
│   ├── detalhe.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── obrigado.php
│   ├── painel.php
│   ├── perfil.php
│   ├── projetos.php
│   ├── sobre.php
│   └── visualizar.php
│
└── README.md
```

---

# 🔒 Segurança e Refatoração

## Sanitização de Dados

Utilização de:

- `htmlspecialchars()`
- `nl2br()`

Prevenindo execução de scripts maliciosos (XSS).

---

## Tratamento de Exceções

Uso de `try/catch` com `PDOException`.

Isso evita exposição de informações sensíveis do banco de dados ao usuário.

---

## Persistência de Formulários

Implementação com:

```php
array_merge($projeto, $_POST)
```

Mantendo os dados preenchidos em caso de erro de validação.

---

## Layout Responsivo

Utilização de CSS Grid para melhor adaptação em diferentes tamanhos de tela.

```css
grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
```

---

# 🚀 Como Executar

## Pré-requisitos

- PHP 8+
- MariaDB
- VS Code Dev Container ou ambiente local

---

## Execução

### 1. Clone o projeto

```bash
git clone <url-do-repositorio>
```

### 2. Importe o banco de dados

```sql
sql/setup.sql
```

### 3. Inicie o servidor

```bash
php -S localhost:8000
```

### 4. Acesse no navegador

```txt
http://localhost:8000/02_projetoPHP-02_refatorado/index.php
```

---

# 👤 Autor

**Henry Rafael Ribeiro Portes**  
Técnico em Informática Integrado ao Ensino Médio  
Disciplina: Desenvolvimento Web II — DWII  
2026

---

# 📌 Objetivo Acadêmico

Este projeto teve como objetivo aplicar conceitos de:

- CRUD
- Refatoração
- Organização de código
- Segurança em aplicações web
- Modularização
- Experiência do usuário (UX)