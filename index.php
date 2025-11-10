<?php
// index.php (na pasta raiz)

require_once 'config.php'; // session_start() está aqui
require_once 'models/Produto.php';
require_once 'controllers/ProdutoController.php';

// *** NOVO: Lógica da Tela de Boot ***
if (!isset($_SESSION['boot_completed']) && !isset($_GET['booted'])) {
    $_SESSION['boot_completed'] = true; // Marca que a tela de boot será mostrada/foi mostrada
    include 'views/boot_screen.php';
    exit(); // Para a execução e exibe a tela de boot
}
// Se chegou aqui, ou já "bootou" ou veio da tela de boot com ?booted=true
// Para limpar o ?booted=true da URL, redirecionamos.
if (isset($_GET['booted'])) {
    header('Location: index.php');
    exit();
}
// FIM da lógica da Tela de Boot
// ----------------------------

// Adicione aqui a inclusão do JS (já estava)
echo '<script src="js/script.js" defer></script>';

// Instancia o controller
$controller = new ProdutoController($pdo);

$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($acao) {
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
    default:
        $controller->listar();
        break;
}
?>