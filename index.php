<?php
require_once 'config.php'; 

if (!isset($_GET['booted']) && !isset($_GET['acao'])) {
    include 'views/boot_screen.php';
    exit();
}

require_once 'models/Produto.php';
require_once 'controllers/ProdutoController.php';


// Instancia o controller
$controller = new ProdutoController($pdo);

// Define a ação e o ID
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Roteamento (isto está perfeito)
switch ($acao) {
    case 'stats':
        $controller->stats();
        break;
    case 'adicionar':
        $controller->adicionar();
        break;
    case 'editar':
        $controller->editar($id);
        break;
    case 'excluir':
        $controller->excluir($id);
        break;
    case 'listar':
        $controller->listar();
        break;
    case 'dados':
        $controller->dados();
        break;
    case 'mapa':
        $controller->mapa();
        break;
    case 'radio':
        $controller->radio();
        break;
    default:
        $controller->stats();
        break;
}
?>