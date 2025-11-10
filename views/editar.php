<h1>[ EDITAR ITEM: #<?= $produto['id'] ?> ]</h1>

<form action="index.php?acao=editar&id=<?= $produto['id'] ?>" method="POST">
    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
    
    <p>
        <label>NOME DO ITEM:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
    </p>
    <p>
        <label>VALOR (CAPS):</label>
        <input type="number" step="1" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>
    </p>
    <p>
        <label>CATEGORIA:</label>
        <input type="text" name="categoria" value="<?= htmlspecialchars($produto['categoria']) ?>">
    </p>
    <p>
        <button type="submit">[ATUALIZAR ITEM]</button>
    </p>
</form>

<div class="voltar">
    <a href="index.php"></a>
</div>