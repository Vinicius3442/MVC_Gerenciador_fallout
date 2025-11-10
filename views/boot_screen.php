<!DOCTYPE html>
<html>
<head>
    <title>INICIANDO SISTEMA R.O.B.CO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden; /* Evita barras de rolagem */
            position: relative;
        }
        .boot-screen {
            text-align: center;
            opacity: 0; /* Começa invisível */
            animation: fadeIn 1s forwards, glitch 0.5s infinite alternate 1s; /* Fade in, depois glitch */
        }
        .boot-screen h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        .boot-screen p {
            font-size: 1.5em;
        }

        /* Animações */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes glitch {
            0% { text-shadow: 0 0 5px #32FF32, 0 0 10px #32FF32; transform: translateX(0); }
            33% { text-shadow: 2px 0 5px red, -2px 0 5px blue; transform: translateX(-2px); }
            66% { text-shadow: -2px 0 5px cyan, 2px 0 5px magenta; transform: translateX(2px); }
            100% { text-shadow: 0 0 5px #32FF32, 0 0 10px #32FF32; transform: translateX(0); }
        }

    </style>
</head>
<body>
    <div class="boot-screen">
        <h1>... INICIANDO SISTEMA ROB.CO ...</h1>
        <p>VERIFICANDO INTEGRIDADE DOS MÓDULOS...</p>
        <p>CARREGANDO DADOS DO INVENTÁRIO...</p>
        <p>SISTEMA PRONTO. AGUARDE...</p>
    </div>

    <script>
        // Depois que a animação terminar, redireciona para a página principal
        setTimeout(() => {
            window.location.href = 'index.php?booted=true'; // Adiciona um flag para não exibir de novo
        }, 5000); // 5 segundos de animação
    </script>
</body>
</html>