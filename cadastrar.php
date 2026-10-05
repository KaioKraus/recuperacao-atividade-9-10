<?php
session_start();

$mensagem = $_SESSION['mensagem'] ?? '';
$tipoMensagem = $_SESSION['tipo_mensagem'] ?? 'erro';
unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container small-container">
        <header class="cabecalho">
            <div>
                <h1>Cadastrar Produto</h1>
            </div>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </header>

        <?php if ($mensagem !== ''): ?>
            <div class="mensagem <?= htmlspecialchars($tipoMensagem, ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <div class="card formulario-card">
            <form action="salvar.php" method="POST">
                <div class="campo">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Arroz 5kg" required>
                </div>

                <div class="campo">
                    <label for="categoria">Categoria</label>
                    <input type="text" id="categoria" name="categoria" placeholder="Ex: Alimentação" required>
                </div>

                <div class="campo">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o produto" required></textarea>
                </div>

                <div class="campo-duplo">
                    <div class="campo">
                        <label for="preco">Preço</label>
                        <input type="number" id="preco" name="preco" step="0.01" min="0.01" placeholder="Ex: 25.90" required>
                    </div>

                    <div class="campo">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" id="quantidade" name="quantidade" min="0" step="1" placeholder="Ex: 15" required>
                    </div>
                </div>

                <div class="campo">
                    <label for="data_validade">Data de validade</label>
                    <input type="date" id="data_validade" name="data_validade" required>
                </div>

                <div class="acoes-formulario">
                    <button type="submit" class="btn btn-primary">Salvar Produto</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
