<?php


class ProdutoController {
    private $produtoModel;

    public function __construct($pdo) {
        $this->produtoModel = new Produto($pdo);
    }

    public function listar() {
        $produtos = $this->produtoModel->listar();
        // Chama a View de listagem
        include 'views/listar.php';
    }
    public function adicionar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->produtoModel->adicionar($_POST['nome'], $_POST['preco'], $_POST['categoria']);
            header('Location: index.php');
        } else {
            include 'views/adicionar.php';
        }
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->produtoModel->editar($_POST['id'], $_POST['nome'], $_POST['preco'], $_POST['categoria']);
            header('Location: index.php');
        } else {
            $produto = $this->produtoModel->buscarPorId($id);
            include 'views/editar.php';
        }
    }

    public function excluir($id) {
        $this->produtoModel->excluir($id);
        header('Location: index.php');
    }
}
?>