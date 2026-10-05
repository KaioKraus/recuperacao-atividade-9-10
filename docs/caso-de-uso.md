# Documento de Caso de Uso

## Sistema
Sistema de Gestão de Estoque.

## Ator
Funcionário / Administrador do Mercado.

Esse ator é responsável por cadastrar, visualizar, editar e excluir produtos do estoque.

## Casos de uso

### 1. Cadastrar Produto
- Nome: Cadastrar Produto
- Ator: Funcionário / Administrador do Mercado
- Objetivo: Registrar um novo produto no sistema.
- Pré-condição: O usuário deve estar na página de cadastro.
- Fluxo principal:
  1. O usuário acessa a página de cadastro.
  2. Preenche os dados do produto.
  3. Clica em salvar.
  4. O sistema valida as informações.
  5. O produto é salvo no banco de dados.
- Resultado esperado: O produto aparece na listagem com sucesso.

### 2. Visualizar Produtos
- Nome: Visualizar Produtos
- Ator: Funcionário / Administrador do Mercado
- Objetivo: Consultar os produtos disponíveis no estoque.
- Pré-condição: O sistema precisa ter produtos cadastrados ou não.
- Fluxo principal:
  1. O usuário acessa a página inicial.
  2. O sistema consulta os produtos cadastrados.
  3. A lista é exibida em tabela.
- Resultado esperado: O usuário consegue visualizar todos os produtos e suas informações.

### 3. Editar Produto
- Nome: Editar Produto
- Ator: Funcionário / Administrador do Mercado
- Objetivo: Alterar as informações de um produto já cadastrado.
- Pré-condição: O produto deve existir no banco de dados.
- Fluxo principal:
  1. O usuário acessa a opção de edição de um produto.
  2. O sistema busca os dados atuais.
  3. O usuário altera os campos desejados.
  4. Confirma a atualização.
  5. O sistema salva as alterações.
- Resultado esperado: As informações do produto ficam atualizadas no sistema.

### 4. Excluir Produto
- Nome: Excluir Produto
- Ator: Funcionário / Administrador do Mercado
- Objetivo: Remover um produto cadastrado do estoque.
- Pré-condição: O produto deve existir no banco de dados.
- Fluxo principal:
  1. O usuário seleciona a opção de excluir.
  2. O sistema solicita confirmação.
  3. O usuário confirma a exclusão.
  4. O sistema remove o registro.
- Resultado esperado: O produto deixa de aparecer na listagem.
