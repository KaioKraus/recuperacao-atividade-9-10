<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastrar.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = trim($_POST['preco'] ?? '');
$quantidade = trim($_POST['quantidade'] ?? '');
$data_validade = trim($_POST['data_validade'] ?? '');

// Validação básica dos dados antes do cadastro.
$erros = [];

if ($nome === '') {
    $erros[] = 'Nome é obrigatório.';
}

if ($categoria === '') {
    $erros[] = 'Categoria é obrigatória.';
}

if ($descricao === '') {
    $erros[] = 'Descrição é obrigatória.';
}

if ($preco === '' || !is_numeric($preco) || (float) $preco <= 0) {
    $erros[] = 'Preço deve ser numérico e maior que zero.';
}

if ($quantidade === '' || !preg_match('/^\d+$/', $quantidade) || (int) $quantidade < 0) {
    $erros[] = 'Quantidade deve ser um número inteiro e não pode ser negativa.';
}

if ($data_validade === '' || !DateTime::createFromFormat('Y-m-d', $data_validade)) {
    $erros[] = 'Data de validade inválida.';
}

if (!empty($erros)) {
    $_SESSION['mensagem'] = implode(' ', $erros);
    $_SESSION['tipo_mensagem'] = 'erro';
    header('Location: cadastrar.php');
    exit;
}

$preco = (float) $preco;
$quantidade = (int) $quantidade;

try {
    $conn = conectarBanco();
    $sql = 'INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, data_validade) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception('Erro ao preparar a consulta.');
    }

    $stmt->bind_param('sssdis', $nome, $categoria, $descricao, $preco, $quantidade, $data_validade);

    if (!$stmt->execute()) {
        throw new Exception('Erro ao cadastrar o produto.');
    }

    $_SESSION['mensagem'] = 'Produto cadastrado com sucesso!';
    $_SESSION['tipo_mensagem'] = 'sucesso';
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    $_SESSION['mensagem'] = 'Erro ao cadastrar o produto.';
    $_SESSION['tipo_mensagem'] = 'erro';
    header('Location: cadastrar.php');
    exit;
}
