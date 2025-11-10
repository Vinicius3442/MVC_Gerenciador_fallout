<h1>[ EDITAR ITEM: #<?= $produto['id'] ?> ]</h1>

<div class="pipboy-layout">

    <div class="pipboy-left form-panel">
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
            <p class="form-actions">
                <a href="index.php" class="voltar">[< VOLTAR]</a>
                <button type="submit">[ATUALIZAR ITEM]</button>
            </p>
        </form>
    </div>

    <div class="pipboy-right">
        <div class="item-model-view">
            <img src="img/pipboy.gif" 
                 alt="Vault Boy" 
                 class="item-model-gif" />
        </div>
        <div class="item-stats-view">
            <h2>// EDITANDO REGISTRO //</h2>
            <hr class="pipboy-hr-short">
            <p><span>MODIFIQUE OS DADOS DO ITEM.</span></p>
            <p><span>AS MUDANÇAS SERÃO PERMANENTES.</span></p>
        </div>
    </div>

</div>