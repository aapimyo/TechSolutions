# 🖥️ TechSolutions — Sistema de Agendamentos Internos

## 📋 Nome do Projeto
**TechSolutions - Sistema de Agendamentos**

## 🎯 Objetivo do Sistema
Sistema web interno desenvolvido para a empresa TechSolutions com o objetivo de informatizar e organizar o gerenciamento de usuários e tarefas/agendamentos internos, substituindo o controle manual por uma plataforma digital com autenticação, painel de controle e CRUD completo.

---

## 🛠️ Tecnologias Utilizadas

| Tecnologia | Versão / Descrição |
|---|---|
| PHP | 8.x (via XAMPP) |
| MySQL | 8.x (via XAMPP) |
| MySQLi | Extensão nativa do PHP |
| HTML5 | Estrutura das páginas |
| CSS3 | Estilização (embutida nos arquivos) |
| XAMPP | Ambiente de desenvolvimento local |

---

## 📂 Estrutura do Projeto

```
sistema/
├── conexao.php               # Configuração da conexão MySQLi
├── login.php                 # Tela de login
├── validar.php               # Validação de autenticação (POST)
├── logout.php                # Encerramento de sessão
├── dashboard.php             # Painel principal com estatísticas
├── layout_header.php         # Cabeçalho/sidebar compartilhado
├── layout_footer.php         # Rodapé compartilhado
│
├── usuarios/
│   ├── cadastrar.php         # Cadastrar + listar usuários
│   ├── editar.php            # Editar usuário
│   └── excluir.php           # Excluir usuário
│
└── tarefas/
    ├── listar.php            # Listar tarefas (com filtro de status)
    ├── cadastrar.php         # Cadastrar tarefa
    ├── editar.php            # Editar tarefa
    └── excluir.php           # Excluir tarefa
```

---

## ⚙️ Passo a Passo para Instalação

### 1. Instalar o XAMPP
- Acesse [https://www.apachefriends.org/](https://www.apachefriends.org/) e baixe o XAMPP para o seu sistema operacional.
- Instale normalmente seguindo o assistente.

### 2. Copiar os arquivos do projeto
- Abra a pasta de instalação do XAMPP (geralmente `C:\xampp\` no Windows ou `/opt/lampp/` no Linux).
- Navegue até a pasta `htdocs`.
- Crie uma pasta chamada `sistema` dentro de `htdocs`.
- Copie **todos os arquivos e pastas** do projeto para dentro de `C:\xampp\htdocs\sistema\`.

A estrutura final deve ser:
```
C:\xampp\htdocs\sistema\
    conexao.php
    login.php
    dashboard.php
    ...
    usuarios\
    tarefas\
```

---

## 🗄️ Como Configurar o Banco de Dados

### 1. Iniciar os serviços do XAMPP
- Abra o **XAMPP Control Panel**.
- Clique em **Start** para os módulos **Apache** e **MySQL**.
- Aguarde até que ambos fiquem com fundo verde.

### 2. Importar o banco de dados
**Opção A — Via phpMyAdmin (recomendado):**
1. Abra o navegador e acesse: `http://localhost/phpmyadmin`
2. Clique em **Importar** no menu superior.
3. Clique em **Escolher arquivo** e selecione o arquivo `banco_de_dados.sql` do projeto.
4. Clique em **Executar** (ou "Go") no final da página.

**Opção B — Via SQL direto:**
1. Acesse `http://localhost/phpmyadmin`
2. Clique em **SQL** no menu superior.
3. Cole o conteúdo do arquivo `banco_de_dados.sql` e clique em **Executar**.

### 3. Verificar a criação
- No menu lateral do phpMyAdmin, você deve ver o banco **`empresa_agendamento`** com duas tabelas: `usuarios` e `tarefas`.

---

## ▶️ Como Executar o Projeto no XAMPP

1. Certifique-se de que **Apache** e **MySQL** estão rodando no XAMPP Control Panel.
2. Abra o navegador.
3. Acesse: `http://localhost/sistema/login.php`

---

## 🔑 Como Acessar o Sistema

Um usuário administrador é criado automaticamente pelo script SQL:

| Campo | Valor |
|---|---|
| **Email** | `admin@techsolutions.com` |
| **Senha** | `admin123` |

> ⚠️ **Recomendação:** Altere a senha do administrador após o primeiro acesso.

---

## 🧪 Como Testar as Funcionalidades

### 🔐 Login e Autenticação
- [ ] Acesse `login.php` sem estar logado
- [ ] Tente acessar `dashboard.php` diretamente — deve redirecionar para o login
- [ ] Faça login com email/senha incorretos — deve exibir mensagem de erro
- [ ] Faça login com `admin@techsolutions.com` / `admin123` — deve ir para o dashboard
- [ ] Clique no botão de logout — deve encerrar a sessão e redirecionar para o login

### 👥 CRUD de Usuários (`/usuarios/cadastrar.php`)
- [ ] Cadastre um novo usuário com nome, email e senha
- [ ] Tente cadastrar com email já existente — deve exibir aviso
- [ ] Edite um usuário existente (nome, email, senha opcional)
- [ ] Exclua um usuário — confirme a exclusão no alerta do navegador
- [ ] Tente excluir o próprio usuário logado — deve ser bloqueado

### 📅 CRUD de Tarefas (`/tarefas/listar.php`)
- [ ] Cadastre uma nova tarefa com título, descrição, data e status
- [ ] Visualize a lista de tarefas e filtre por status (Pendente / Em andamento / Concluído)
- [ ] Edite uma tarefa existente e altere o status
- [ ] Exclua uma tarefa — confirme a exclusão no alerta do navegador
- [ ] Verifique se o Dashboard reflete os números atualizados

### 📊 Dashboard
- [ ] Verifique se os cards de estatísticas contam corretamente os usuários e tarefas
- [ ] Verifique se as últimas 5 tarefas aparecem na tabela

---

## 🖼️ Prints do Sistema

> Adicione prints das seguintes telas ao seu repositório:
> - `print_login.png` — Tela de login
> - `print_dashboard.png` — Dashboard com estatísticas
> - `print_usuarios.png` — Listagem de usuários
> - `print_tarefas.png` — Listagem de tarefas
> - `print_nova_tarefa.png` — Formulário de cadastro de tarefa

---

## 🔧 Configuração da Conexão

Se o seu MySQL tiver senha diferente do padrão, edite o arquivo `conexao.php`:

```php
$host     = "localhost";   // Servidor do banco
$usuario  = "root";        // Usuário do MySQL
$senha    = "";            // Senha (vazia por padrão no XAMPP)
$banco    = "empresa_agendamento";  // Nome do banco
```

---

## 📜 Recursos Técnicos Utilizados

| Recurso | Onde é usado |
|---|---|
| `mysqli` | `conexao.php` — conexão com o banco |
| `$_POST` | `validar.php`, `cadastrar.php`, `editar.php` |
| `$_GET` | `editar.php`, `excluir.php` (parâmetro `id`) |
| `while` | Listagem de usuários e tarefas |
| `if / else` | Validações, mensagens de erro/sucesso |
| `header()` | Redirecionamentos após ações |
| `session_start()` | Todos os arquivos protegidos |
| `mysqli_query()` | Todas as operações no banco |
| `mysqli_fetch_assoc()` | Leitura dos resultados |

---

## 👨‍💻 Desenvolvido por
**Equipe TechSolutions** — Projeto Acadêmico  
Sistema Web com PHP + MySQL + XAMPP
