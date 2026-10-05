<?php
session_start();
require 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id <= 0) {
    $_SESSION['mensagem'] = 'ID inválido.';
    $_SESSION['tipo_mensagem'] = 'erro';
    header('Location: index.php');
    exit;
}

try {
    $conn = conectarBanco();
    $sql = 'DELETE FROM produtos WHERE id = ?';
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception('Erro ao preparar a consulta.');
    }

    $stmt->bind_param('i', $id);

    if (!$stmt->execute()) {
        throw new Exception('Erro ao excluir o produto.');
    }

    $_SESSION['mensagem'] = 'Produto excluído com sucesso!';
    $_SESSION['tipo_mensagem'] = 'sucesso';
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    $_SESSION['mensagem'] = 'Erro ao excluir o produto.';
    $_SESSION['tipo_mensagem'] = 'erro';
    header('Location: index.php');
    exit;
}
