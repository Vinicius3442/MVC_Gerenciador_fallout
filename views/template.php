<?php
// views/template.php

// Define um título padrão se não for passado
if (!isset($pageTitle)) {
    $pageTitle = "SISTEMA R.O.B.CO";
}

// Define a ação atual para o menu
$acao = $_GET['acao'] ?? 'listar';

?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/script.js" defer></script>
</head>
<body>

    <div class="container">
        <div class="header-menu">
            <a href="index.php?acao=stats" class="<?= ($acao === 'stats') ? 'active' : '' ?>">STAT</a>
            <a href="index.php?acao=listar" class="<?= ($acao === 'listar' || $acao === 'excluir') ? 'active' : '' ?>">INV</a>
            <a href="index.php?acao=adicionar" class="<?= ($acao === 'adicionar') ? 'active' : '' ?>">REGIST</a>
            <a href="index.php?acao=dados" class="<?= ($acao === 'dados') ? 'active' : '' ?>">DATA</a>
            <a href="index.php?acao=mapa" class="<?= ($acao === 'mapa') ? 'active' : '' ?>">MAP</a>
            <a href="index.php?acao=radio" class="<?= ($acao === 'radio') ? 'active' : '' ?>">RADIO</a>
        </div>

        <?= $content ?? '' ?>

    </div>

    <div id="loading-overlay"></div>
    <audio id="uiBlipSound" src="audio/start.mp3" preload="auto"></audio>
    
    <audio id="crtGlitchSound" src="audio/crt.mp3" preload="auto" loop></audio>

    <img src="img/loading.gif"
         alt="Carregando..."
         class="loading-vault-boy"
         id="loadingVaultBoy" /> </body>
</html>