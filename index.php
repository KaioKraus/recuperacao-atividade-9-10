<?php
session_start();
require 'conexao.php';

$mensagem = $_SESSION['mensagem'] ?? '';
$tipoMensagem = $_SESSION['tipo_mensagem'] ?? 'sucesso';
unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);

$erroBanco = '';
$resultado = null;

try {
    $sql = 'SELECT id, nome, categoria, descricao, preco, quantidade, data_validade FROM produtos ORDER BY id ASC';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
} catch (Exception $e) {
    $erroBanco = 'Não foi possível carregar os produtos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Estoque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="cabecalho">
            <div>
                <h1>Sistema de Gestão de Estoque</h1>
            </div>
            <a href="cadastrar.php" class="btn btn-primary">Cadastrar Produto</a>
        </header>

        <?php if ($mensagem !== ''): ?>
            <div class="mensagem <?= htmlspecialchars($tipoMensagem, ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($erroBanco !== ''): ?>
            <div class="mensagem erro">
                <?= htmlspecialchars($erroBanco, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Validade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado && $resultado->num_rows > 0): ?>
                        <?php while ($produto = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td data-label="ID"><?= (int) $produto['id']; ?></td>
                                <td data-label="Nome"><?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td data-label="Categoria"><?= htmlspecialchars($produto['categoria'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td data-label="Descrição"><?= nl2br(htmlspecialchars($produto['descricao'], ENT_QUOTES, 'UTF-8')); ?></td>
                                <td data-label="Preço">R$ <?= number_format((float) $produto['preco'], 2, ',', '.'); ?></td>
                                <td data-label="Quantidade"><?= (int) $produto['quantidade']; ?></td>
                                <td data-label="Validade"><?= htmlspecialchars(date('d/m/Y', strtotime($produto['data_validade'])), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td data-label="Ações" class="acoes">
                                    <a href="editar.php?id=<?= (int) $produto['id']; ?>" class="btn btn-secondary">Editar</a>
                                    <a href="excluir.php?id=<?= (int) $produto['id']; ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir este produto?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="vazio">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
