# Portfólio Dinâmico — Desenvolvimento Web II (DWII)

Mini-site de portfólio pessoal desenvolvido em **PHP puro**.  
O projeto utiliza **includes, variáveis PHP, arrays, formulários, integração com banco de dados (PDO + MariaDB), controle de acesso com sessões e operações de CRUD**, seguindo a organização ensinada na disciplina.

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

- **Estruturação Modular:** Reutilização de componentes com `include` e `require`.
- **Comunicação entre Páginas:** Uso de métodos `GET` e `POST`.
- **Persistência em Banco de Dados:** Conexão segura via **PDO** e manipulação de dados com MariaDB.
- **Operações CRUD:** Implementação completa de **Create** (Cadastrar) e **Read** (Listar).
- **Segurança:** Proteção contra **SQL Injection** (Prepared Statements) e **XSS** (`htmlspecialchars`).
- **Autenticação:** Gestão de sessões e middlewares de proteção de acesso.
- **Ambiente Profissional:** Configuração via **Dev Containers e Docker**.

---

# 📁 Estrutura do Projeto

| Pasta / Arquivo | Conteúdo |
|-----------------|----------|
| `index.php` | Hub de navegação com acesso às atividades |
| `includes/` | Componentes reutilizáveis (Header, Footer, CSS) |
| `00_apresentacao/` | Página de apresentação pessoal responsiva |
| `01_php-intro/` | Portfólio dinâmico com arrays PHP |
| `02_formularios/` | Práticas de envio e validação de dados |
| `03_pdo/` | Catálogo de tecnologias com banco de dados |
| `04_sessoes/` | Sistema de login e controle de autenticação |
| `05_crud/` | **Sistema de Gestão de Projetos (CRUD)** |
| `05_crud/index.php` | Listagem dinâmica dos projetos cadastrados (**Read**) |
| `05_crud/cadastrar.php`| Formulário e lógica de inserção no banco (**Create**) |
| `05_crud/includes/conexao.php` | Configuração centralizada da conexão PDO |

---

# 📝 CRUD de Projetos (Create & Read)

Nesta etapa, o projeto evoluiu para um sistema funcional de gerenciamento de portfólio. Agora é possível persistir novos projetos diretamente no banco de dados e exibi-los em tempo real.

**Funcionalidades Principais:**
- **Cadastro Dinâmico:** Validação de campos obrigatórios e sanitização de dados antes da inserção.
- **Listagem Inteligente:** Exibição dos projetos em cards ordenados pelo mais recente (`ORDER BY criado_em DESC`).
- **Tratamento de Erros:** Bloco `try/catch` na conexão e mensagens de feedback amigáveis para o usuário.
- **UX (User Experience):** Feedback visual após cadastros bem-sucedidos e botões de navegação fluída entre o sistema e o índice principal.

---

# 🔐 Autenticação e Controle de Acesso

Implementação de área restrita simulando um ambiente real de administração.

- **Middleware `requer_login()`:** Função centralizada que protege arquivos sensíveis.
- **Gestão de Estado:** Uso de `$_SESSION` para manter o usuário logado entre diferentes páginas.
- **Logout Seguro:** Encerramento completo da sessão com limpeza de cookies do lado do cliente.

---

# ⚙️ Ambiente de Desenvolvimento

O projeto utiliza **Dev Containers com Docker** para configurar automaticamente:
- **PHP 8.2**
- **MariaDB 10.11**
- Extensão **PDO MySQL** habilitada
- Servidor embutido do PHP para testes rápidos

---

# 🌐 Como executar o projeto

1. Certifique-se de que o container Docker está rodando.
2. No terminal (raiz do projeto):
   ```bash
   php -S localhost:8000