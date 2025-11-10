<!DOCTYPE html>
<html>
<head>
    <title>SISTEMA R.O.B.CO - EDITAR</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
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
    </div>
</body>
</html>