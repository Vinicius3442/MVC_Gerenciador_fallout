<h1>[ INVENTÁRIO ]</h1>

<div class="pipboy-layout">

    <div class="pipboy-left">
        
        <div class="sub-nav">
            <?php 
                $first = true;
                foreach ($produtosAgrupados as $categoria => $itens): 
            ?>
                <a href="#" 
                   class="sub-nav-item <?= $first ? 'active' : '' ?>" 
                   data-category="<?= htmlspecialchars($categoria) ?>">
                   <?= htmlspecialchars($categoria) ?> (<?= count($itens) ?>)
                </a>
            <?php 
                $first = false; 
                endforeach; 
            ?>
        </div>

        <div class="inventory-header">
            <span>ITEM</span>
            <span class="header-value">VALOR</span>
        </div>
        
        <div class="item-lists">
            <?php 
                $first = true;
                foreach ($produtosAgrupados as $categoria => $itens): 
            ?>
                <ul class="item-list <?= $first ? 'active' : '' ?>" 
                    id="list-<?= htmlspecialchars($categoria) ?>">
                    
                    <?php foreach ($itens as $produto): ?>
                        <li class="inventory-item"
                            data-id="<?= $produto['id'] ?>"
                            data-nome="<?= htmlspecialchars($produto['nome']) ?>"
                            data-preco="<?= number_format($produto['preco'], 0, ',', '.') ?>"
                            data-categoria="<?= htmlspecialchars($produto['categoria']) ?>">
                            
                            <span class="item-name"><?= htmlspecialchars($produto['nome']) ?></span>
                            <span class="item-value"><?= number_format($produto['preco'], 0, ',', '.') ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php 
                $first = false; 
                endforeach; 
            ?>
        </div>
        
    </div>

    <div class="pipboy-right">

        <div class="item-model-view">
            <img src="img/pipboy.gif"
                 alt="Vault Boy" 
                 class="item-model-gif" />
        </div>

        <div class="item-stats-view">
            <h2 id="detail-nome">// SELECIONE UM ITEM //</h2>
            <hr classC="pipboy-hr-short">
            <p>VALOR: <span id="detail-preco">--</span> CAPS</p>
            <p>CATEGORIA: <span id="detail-categoria">--</span></p>

            <div class="item-actions-static">
                <a id="detail-edit" href="#" class="editar">[EDITAR]</a>
                <a id="detail-delete" href="#" class="excluir">[EXCLUIR]</a>
            </div>
        </div>
        
    </div>

</div>