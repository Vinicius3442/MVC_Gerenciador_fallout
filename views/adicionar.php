<h1>[ REGISTRAR NOVO ITEM ]</h1>

<form action="index.php?acao=adicionar" method="POST">
    <p>
        <label>NOME DO ITEM:</label>
        <input type="text" name="nome" required>
    </p>
    <p>
        <label>VALOR (CAPS):</label>
        <input type="number" step="1" name="preco" required>
    </p>
    <p>
        <label>CATEGORIA:</label>
        <input type="text" name="categoria">
    </p>
    <p>
        <button type="submit">[SALVAR NOVO]</button>
    </p>
</form>

<div class="voltar">
    <a href="index.php"></a>
</div>