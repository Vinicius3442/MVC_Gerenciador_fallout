<h1>[ REGISTRAR NOVO ITEM ]</h1>

<div class="pipboy-layout">

    <div class="pipboy-left form-panel">
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
            <p class="form-actions">
                <a href="index.php" class="voltar">[< VOLTAR]</a>
                <button type="submit">[SALVAR NOVO]</button>
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
            <h2>// NOVO REGISTRO //</h2>
            <hr class="pipboy-hr-short">
            <p><span>PREENCHA OS CAMPOS PARA ADICIONAR UM NOVO ITEM AO INVENTÁRIO.</span></p>
            <p><span>CERTIFIQUE-SE DE QUE O VALOR EM CAPS ESTÁ CORRETO.</span></p>
        </div>
    </div>

</div>