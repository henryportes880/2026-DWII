# Portfólio Dinâmico — Desenvolvimento Web II (DWII)

Mini-site de portfólio pessoal desenvolvido em **PHP puro**.  
O projeto utiliza **includes, variáveis PHP, arrays, formulários, integração com banco de dados (PDO + MariaDB) e controle de acesso com sessões**, seguindo a organização ensinada na disciplina.

---

# 👤 Estudante

* **Nome:** Henry Rafael Ribeiro Portes  
* **Curso:** Técnico em Informática Integrado ao Ensino Médio  
* **Turma:** 3º ano  
* **Ano:** 2026  

---

# 📚 Conteúdo do Projeto

Este repositório reúne as atividades desenvolvidas na disciplina **Desenvolvimento Web II (DWII)**.

Entre os conceitos praticados estão:

- Estruturação de sites com **PHP**
- Reutilização de código com **includes**
- Uso de **variáveis e arrays**
- Criação de **formulários HTML com método GET e POST**
- Conexão com **banco de dados MariaDB usando PDO**
- Consultas SQL com **SELECT, INSERT e prepared statements**
- **Gestão de Sessões PHP** para autenticação de usuários
- Criação de **Middleware de segurança** (funções de restrição de acesso)
- Configuração de ambiente de desenvolvimento com **Dev Containers e Docker**

---

# 📁 Estrutura do Projeto

| Pasta / Arquivo | Conteúdo |
|-----------------|----------|
| `index.php` | Hub de navegação com acesso às atividades |
| `includes/` | Componentes reutilizáveis do site |
| `00_apresentacao/` | Página de apresentação pessoal |
| `01_php-intro/` | Portfólio dinâmico com PHP |
| `02_formularios/` | Formulário de contato (GET) |
| `03_pdo/` | Catálogo de tecnologias com banco de dados |
| `04_sessoes/` | **Sistema de login e área restrita** |
| `04_sessoes/login.php` | Tela de login com verificação de credenciais |
| `04_sessoes/painel.php` | Área protegida (exige login) |
| `04_sessoes/publico.php` | Página de acesso livre com detecção de estado de login |
| `04_sessoes/logout.php` | Encerramento de sessão e redirecionamento |
| `04_sessoes/includes/auth.php` | Lógica centralizada de autenticação |

---

# 🔐 Autenticação e Controle de Acesso (Sessões PHP)

Nesta atividade foi implementado um sistema de login completo para simular uma área restrita, explorando a persistência de dados no lado do servidor.

**Funcionalidades implementadas:**

- **Início e Encerramento de Sessões:** Uso de `session_start()` e `session_destroy()`.
- **Persistência de Dados:** Armazenamento de informações do usuário logado no array global `$_SESSION`.
- **Segurança e Refatoração:** Extração da lógica de proteção para a função `requer_login()` dentro de um arquivo `auth.php`, facilitando a proteção de múltiplas páginas.
- **Prevenção de Ataques:** Uso de `session_regenerate_id()` para evitar fixação de sessão e `htmlspecialchars()` para exibir dados do usuário com segurança.
- **Experiência do Usuário (UX):** Redirecionamento automático de usuários não autenticados e persistência do nome de usuário no formulário em caso de erro.

---

# 🗄️ Catálogo de Tecnologias (PDO + MariaDB)

Nesta atividade foi desenvolvido um **catálogo dinâmico de tecnologias**, onde os dados são armazenados em um banco **MariaDB** e acessados pelo **PHP usando PDO**.

Funcionalidades implementadas:

- Conexão segura com banco de dados usando **PDO**
- Consulta de dados com **query() + fetchAll()**
- Busca de registro específico com **prepare() + execute()**
- Uso de **parâmetros para evitar SQL Injection**

---

# ⚙️ Ambiente de Desenvolvimento

O projeto utiliza **Dev Containers com Docker** para configurar automaticamente:

- PHP 8.2
- MariaDB 10.11
- Driver **PDO MySQL**
- Cliente **mariadb** no terminal

---

# 🌐 Como executar o projeto

No terminal do Codespace ou ambiente local (certifique-se de estar na raiz do projeto):

```bash
cd /workspaces/2026-DWII
php -S localhost:8000