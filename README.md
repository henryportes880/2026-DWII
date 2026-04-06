# Portfólio Dinâmico — Desenvolvimento Web II (DWII)

Mini-site de portfólio pessoal desenvolvido em **PHP puro**.  
O projeto utiliza **includes, variáveis PHP, arrays, formulários, integração com banco de dados (PDO + MariaDB), controle de acesso com sessões e operações de CRUD completo**, seguindo a organização ensinada na disciplina.

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
- **CRUD Completo:** Implementação de **Create** (Cadastrar), **Read** (Listar), **Update** (Editar) e **Delete** (Excluir).
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
| `05_crud/` | **Sistema de Gestão de Projetos (CRUD Completo)** |
| `05_crud/index.php` | Listagem dinâmica com opções de edição e exclusão (**Read**) |
| `05_crud/cadastrar.php`| Formulário e lógica de inserção no banco (**Create**) |
| `05_crud/editar.php`| Recuperação de dados via ID e atualização de registros (**Update**) |
| `05_crud/excluir.php`| Lógica para remoção segura de registros do banco (**Delete**) |
| `05_crud/includes/conexao.php` | Configuração centralizada da conexão PDO |

---

# 📝 CRUD de Projetos (Full CRUD)

Nesta etapa, o projeto atingiu sua maturidade como um sistema funcional de gerenciamento. Agora é possível realizar o ciclo completo de vida dos dados.

**Funcionalidades Principais:**
- **Cadastro e Listagem:** Inserção de novos projetos e exibição organizada por data de criação.
- **Edição Dinâmica:** Carregamento de dados existentes em formulários para atualização segura via banco de dados.
- **Exclusão Controlada:** Remoção de registros do banco de dados com redirecionamento automático.
- **Tratamento de Erros:** Uso de `try/catch` para garantir que falhas no banco não quebrem a experiência do usuário.
- **UX (User Experience):** Feedback visual para o usuário após cada operação (sucesso ao salvar, editar ou excluir).

---

# 🔐 Autenticação e Controle de Acesso

Implementação de área restrita simulando um ambiente real de administração.

- **Middleware `requer_login()`:** Função centralizada que protege arquivos sensíveis (essencial para as operações de Update e Delete).
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