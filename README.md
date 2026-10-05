# Sistema de Gestão de Estoque

## 1. Nome do sistema

Sistema de Gestão de Estoque.

## 2. Objetivo

Este sistema foi criado para controlar os produtos de um mercado, permitindo registrar, consultar, editar e excluir itens do estoque de forma simples e organizada.

## 3. Tecnologias utilizadas

- PHP
- MySQL
- HTML
- CSS
- Git
- GitHub

## 4. Funcionalidades

O sistema permite:

- cadastro de produtos;
- listagem de produtos;
- edição de informações;
- exclusão de produtos;
- validação de dados do formulário;
- uso de Prepared Statements;
- tratamento de erros com mensagens simples para o usuário.

## 5. Requisitos

Para executar o projeto, é necessário ter:

- XAMPP instalado;
- Apache ativo;
- MySQL ativo;
- navegador para acessar a aplicação;
- PHP configurado pelo XAMPP.

## 6. Instalação e configuração

1. Instale e inicie o XAMPP.
2. Inicie o Apache e o MySQL.
3. Coloque a pasta do projeto dentro da pasta htdocs do XAMPP.
4. Abra o phpMyAdmin no navegador.
5. Crie o banco de dados executando o arquivo `banco.sql`.
6. Verifique o arquivo `conexao.php` para confirmar as configurações padrão do XAMPP.
7. Acesse o projeto pelo navegador, normalmente em: `http://localhost/recuperacao-atividade-9-10/index.php`.

## 7. Estrutura do banco

O banco principal é chamado `loja_estoque` e contém a tabela `produtos` com os campos:

- `id` — identificador único do produto;
- `nome` — nome do produto;
- `categoria` — categoria do item;
- `descricao` — descrição detalhada;
- `preco` — valor do produto;
- `quantidade` — quantidade em estoque;
- `data_validade` — data de validade.

## 8. Estrutura do projeto

A estrutura está organizada assim:

- `index.php` — página principal com a listagem dos produtos;
- `cadastrar.php` — formulário para cadastrar produto;
- `salvar.php` — grava o produto no banco;
- `editar.php` — carrega os dados do produto para edição;
- `atualizar.php` — atualiza os dados no banco;
- `excluir.php` — remove o produto do banco;
- `conexao.php` — conexão com o MySQL;
- `style.css` — estilos da interface;
- `banco.sql` — script de criação do banco e dados iniciais;
- `docs/caso-de-uso.md` — documentação do caso de uso;
- `docs/diagrama-caso-de-uso.svg` — diagrama visual do caso de uso.

## 9. CRUD

O sistema realiza o CRUD completo:

- Create: cadastro de novos produtos;
- Read: listagem dos produtos cadastrados;
- Update: edição dos dados existentes;
- Delete: exclusão de produtos do estoque.

## 10. Prepared Statements

Os Prepared Statements são usados para tornar as consultas SQL mais seguras e evitar ataques de SQL Injection. Em vez de concatenar diretamente valores recebidos do usuário, as consultas usam parâmetros e a função `bind_param()`.

## 11. Git e GitHub

Para publicar o projeto no GitHub:

1. Abra o terminal no projeto.
2. Inicie o Git com `git init` caso ainda não tenha sido inicializado.
3. Adicione os arquivos com `git add .`.
4. Crie commits com mensagens claras:
   - `Criação da estrutura inicial do projeto`
   - `Criação do banco de dados`
   - `Implementação da conexão com MySQL`
   - `Implementação do cadastro de produtos`
   - `Implementação da listagem de produtos`
   - `Implementação de Prepared Statements`
   - `Implementação da edição de produtos`
   - `Implementação da exclusão de produtos`
   - `Adição das validações`
   - `Criação da interface do sistema`
   - `Criação da documentação`
   - `Finalização do projeto`
5. Conecte ao GitHub e envie o repositório com `git push`.

## 12. Diagrama de Caso de Uso

O diagrama visual do caso de uso foi criado em `docs/diagrama-caso-de-uso.svg`.

Este projeto está pronto para uso local em um ambiente XAMPP e pode ser enviado para o GitHub após autenticação do usuário.
