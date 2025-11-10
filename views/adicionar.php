<!DOCTYPE html>
<html>
<head>
    <title>SISTEMA R.O.B.CO - ADICIONAR</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
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
    </div>
</body>
</html>