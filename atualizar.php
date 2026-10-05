<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome = trim($_POST['nome'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = trim($_POST['preco'] ?? '');
$quantidade = trim($_POST['quantidade'] ?? '');
$data_validade = trim($_POST['data_validade'] ?? '');

if ($id === false || $id <= 0) {
    $_SESSION['mensagem'] = 'ID inválido.';
    $_SESSION['tipo_mensagem'] = 'erro';
    header('Location: index.php');
    exit;
}

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
    header('Location: editar.php?id=' . $id);
    exit;
}

$preco = (float) $preco;
$quantidade = (int) $quantidade;

try {
    $conn = conectarBanco();
    $sql = 'UPDATE produtos SET nome = ?, categoria = ?, descricao = ?, preco = ?, quantidade = ?, data_validade = ? WHERE id = ?';
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception('Erro ao preparar a consulta.');
    }

    $stmt->bind_param('sssdisi', $nome, $categoria, $descricao, $preco, $quantidade, $data_validade, $id);

    if (!$stmt->execute()) {
        throw new Exception('Erro ao atualizar o produto.');
    }

    $_SESSION['mensagem'] = 'Produto atualizado com sucesso!';
    $_SESSION['tipo_mensagem'] = 'sucesso';
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    $_SESSION['mensagem'] = 'Erro ao atualizar o produto.';
    $_SESSION['tipo_mensagem'] = 'erro';
    header('Location: editar.php?id=' . $id);
    exit;
}
