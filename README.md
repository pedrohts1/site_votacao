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
- ✅ CRUD completo de votações
- ✅ Validação de dados
- ✅ Controle de votos duplicados
- ✅ Resultados em tempo real
- ✅ Interface administrativa
- ✅ Arquitetura MVC
- ✅ Conexão com banco MySQL

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
- Pedro Teles (pedrohts1@hotmail.com)
- [Nome do Parceiro]
