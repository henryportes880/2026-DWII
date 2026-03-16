# Portfólio Dinâmico — Desenvolvimento Web II (DWII)

Mini-site de portfólio pessoal desenvolvido em **PHP puro**.  
O projeto utiliza **includes, variáveis PHP, arrays, formulários e integração com banco de dados (PDO + MariaDB)**, seguindo a organização ensinada na disciplina.

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
- Criação de **formulários HTML com método GET**
- Conexão com **banco de dados MariaDB usando PDO**
- Consultas SQL com **SELECT, INSERT e prepared statements**
- Configuração de ambiente de desenvolvimento com **Dev Containers e Docker**

---

# 📁 Estrutura do Projeto

| Pasta / Arquivo | Conteúdo |
|-----------------|----------|
| `index.php` | Hub de navegação com acesso às atividades |
| `includes/` | Componentes reutilizáveis do site |
| `includes/cabecalho.php` | Cabeçalho e estrutura HTML |
| `includes/nav.php` | Menu de navegação |
| `includes/rodape.php` | Rodapé do site |
| `includes/style.css` | Estilos globais do projeto |
| `imgs/` | Imagens utilizadas no site |
| `00_apresentacao/` | Página de apresentação pessoal |
| `01_php-intro/` | Portfólio dinâmico com PHP |
| `01_php-intro/index.php` | Página inicial do portfólio |
| `01_php-intro/sobre.php` | Página biográfica |
| `01_php-intro/projetos.php` | Lista de projetos |
| `02_formularios/` | Formulário de contato |
| `02_formularios/contato.php` | Formulário HTML com método GET |
| `03_pdo/` | Catálogo de tecnologias com banco de dados |
| `03_pdo/index.php` | Lista de tecnologias cadastradas |
| `03_pdo/detalhe.php` | Página de detalhes de uma tecnologia |
| `03_pdo/includes/conexao.php` | Conexão com banco de dados via PDO |
| `03_pdo/includes/cab_pdo.php` | Proxy do cabeçalho global |
| `03_pdo/includes/rod_pdo.php` | Proxy do rodapé global |
| `03_pdo/sql/setup.sql` | Script SQL para criação da tabela e dados iniciais |
| `.devcontainer/` | Configuração do ambiente de desenvolvimento (PHP + MariaDB) |

---

# 🗄️ Catálogo de Tecnologias (PDO + MariaDB)

Nesta atividade foi desenvolvido um **catálogo dinâmico de tecnologias**, onde os dados são armazenados em um banco **MariaDB** e acessados pelo **PHP usando PDO**.

Funcionalidades implementadas:

- Conexão segura com banco de dados usando **PDO**
- Consulta de dados com **query() + fetchAll()**
- Busca de registro específico com **prepare() + execute()**
- Uso de **parâmetros para evitar SQL Injection**
- Separação da conexão em arquivo reutilizável

Tecnologias cadastradas no banco:

- HTML
- CSS
- PHP
- MariaDB
- JavaScript
- Git

---

# ⚙️ Ambiente de Desenvolvimento

O projeto utiliza **Dev Containers com Docker** para configurar automaticamente:

- PHP 8.2
- MariaDB 10.11
- Driver **PDO MySQL**
- Cliente **mariadb** no terminal

Arquivos responsáveis:
.devcontainer/
├── Dockerfile
├── devcontainer.json
└── docker-compose.yml

Isso garante que qualquer pessoa que abrir o repositório tenha **o mesmo ambiente configurado automaticamente**.

---

# 🌐 Como executar o projeto

No terminal do Codespace ou ambiente local:

```bash
cd ~/workspaces/2026-DWII
php -S localhost:8000