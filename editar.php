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
    $sql = 'SELECT id, nome, categoria, descricao, preco, quantidade, data_validade FROM produtos WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $produto = $resultado->fetch_assoc();

    if (!$produto) {
        $_SESSION['mensagem'] = 'Produto não encontrado.';
        $_SESSION['tipo_mensagem'] = 'erro';
        header('Location: index.php');
        exit;
    }
} catch (Exception $e) {
    $_SESSION['mensagem'] = 'Erro ao carregar o produto.';
    $_SESSION['tipo_mensagem'] = 'erro';
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container small-container">
        <header class="cabecalho">
            <div>
                <h1>Editar Produto</h1>
            </div>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </header>

        <div class="card formulario-card">
            <form action="atualizar.php" method="POST">
                <input type="hidden" name="id" value="<?= (int) $produto['id']; ?>">

                <div class="campo">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="campo">
                    <label for="categoria">Categoria</label>
                    <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($produto['categoria'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="campo">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($produto['descricao'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="campo-duplo">
                    <div class="campo">
                        <label for="preco">Preço</label>
                        <input type="number" id="preco" name="preco" step="0.01" min="0.01" value="<?= htmlspecialchars((string) $produto['preco'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <div class="campo">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" id="quantidade" name="quantidade" min="0" step="1" value="<?= (int) $produto['quantidade']; ?>" required>
                    </div>
                </div>

                <div class="campo">
                    <label for="data_validade">Data de validade</label>
                    <input type="date" id="data_validade" name="data_validade" value="<?= htmlspecialchars($produto['data_validade'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="acoes-formulario">
                    <button type="submit" class="btn btn-primary">Atualizar Produto</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
