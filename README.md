# Sistema de Votação - Trabalho de Aplicações para Internet

Este é um projeto desenvolvido para a disciplina de Aplicações para Internet, utilizando PHP e o padrão MVC.

## Objetivo
Desenvolver um sistema de votação online simples e funcional seguindo os padrões MVC, DAO e Service.

## Tecnologias
- PHP 7.4+
- MySQL 5.7+
- HTML/CSS
- Padrão MVC (Model-View-Controller)
- Padrão DAO (Data Access Object)
- Padrão Service (Regras de Negócio)

## Funcionalidades
- ✅ **CRUD completo** de votações
- ✅ **Validação de dados** robusta
- ✅ **Controle de votos duplicados**
- ✅ **Resultados em tempo real** com gráficos
- ✅ **Sistema de busca** avançado
- ✅ **Estatísticas detalhadas** e relatórios
- ✅ **Interface administrativa** completa
- ✅ **Design responsivo** e moderno
- ✅ **Animações** e transições suaves
- ✅ **Arquitetura MVC** completa
- ✅ **Padrões DAO e Service**
- ✅ **Conexão MySQL** robusta

## Instalação

### 1. Pré-requisitos
- Servidor web (Apache/Nginx)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior

### 2. Configuração Rápida
1. Clone o repositório
2. Coloque os arquivos no servidor web
3. Acesse: `http://localhost/site_votacao/setup_database.php`
4. Aguarde a configuração automática
5. Acesse: `http://localhost/site_votacao/`

### 3. Configuração Manual
1. Execute o script `database.sql` no MySQL
2. Verifique as configurações em `config/database.php`
3. Acesse: `http://localhost/site_votacao/install.php`

## Estrutura do Projeto
```
site_votacao/
├── config/          # Configurações
├── models/          # Entidades (Model)
├── views/           # Interface (View)
├── controllers/     # Controladores (Controller)
├── dao/            # Acesso a dados (DAO)
├── services/       # Regras de negócio (Service)
├── assets/css/     # Estilos
└── database.sql    # Script do banco
```

## Desenvolvedores
- **Pedro Teles** (pedrohts1@hotmail.com)
- **Arthur Morel** (arthurmorel2003@outlook.com)

## Características Técnicas
- **Arquitetura:** MVC (Model-View-Controller)
- **Padrões:** DAO (Data Access Object) e Service
- **Banco de Dados:** MySQL com PDO
- **Frontend:** HTML5, CSS3, JavaScript ES6
- **Design:** Responsivo com animações CSS
- **Segurança:** Validação de dados e sanitização
- **Performance:** Otimizado para carregamento rápido

## Estrutura do Projeto
```
site_votacao/
├── config/          # Configurações e banco
├── models/          # Entidades (Model)
├── views/           # Interface (View)
├── controllers/     # Controladores (Controller)
├── dao/            # Acesso a dados (DAO)
├── services/       # Regras de negócio (Service)
├── assets/         # CSS, JS e recursos
│   ├── css/        # Estilos modernos
│   └── js/         # JavaScript interativo
├── database.sql    # Script do banco
├── install.php     # Página de instalação
└── setup_database.php # Configuração automática
```
