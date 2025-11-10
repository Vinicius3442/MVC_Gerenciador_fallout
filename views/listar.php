<!DOCTYPE html>
<html>
<head>
    <title>SISTEMA R.O.B.CO - PRODUTOS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
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
                    <a class="excluir" href="index.php?acao=excluir&id=<?= $produto['id'] ?>" onclick="return confirm('// ATENÇÃO: EXCLUIR ITEM DO INVENTÁRIO? //')">[Excluir]</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>