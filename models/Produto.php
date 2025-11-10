<?php
class Produto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM produtos ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function adicionar($nome, $preco, $categoria) {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, preco, categoria) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $preco, $categoria]);
    }

    public function editar($id, $nome, $preco, $categoria) {
        $stmt = $this->pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, categoria = ? WHERE id = ?");
        return $stmt->execute([$nome, $preco, $categoria, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>