<h1>[ TERMINAL DE GERENCIAMENTO ]</h1>

<div class="novo-produto">
    <a href="index.php?acao=adicionar"></a>
</div>

<table>
    <tr>
        <th>Nome do Item</th>
        <th>Valor (Caps)</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    
    <?php foreach ($produtos as $produto): ?>
    <tr>
        <td><?= htmlspecialchars($produto['nome']) ?></td>
        <td><?= number_format($produto['preco'], 0, ',', '.') ?> Caps</td>
        <td><?= htmlspecialchars($produto['categoria']) ?></td>
        <td class="acoes">
            <a class="editar" href="index.php?acao=editar&id=<?= $produto['id'] ?>">[Editar]</a>
            <a class="excluir" href="index.php?acao=excluir&id=<?= $produto['id'] ?>">[Excluir]</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>