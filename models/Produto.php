<?php
class Produto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        // Mude de "ORDER BY nome" para "ORDER BY categoria, nome"
        $stmt = $this->pdo->query("SELECT * FROM produtos ORDER BY categoria, nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCountByName($itemName) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM produtos WHERE nome = ?");
        $stmt->execute([$itemName]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Retorna o total. Se não houver, retorna 0.
        return $result['total'] ?? 0;
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
    public function contarPorCategoria() {
        $stmt = $this->pdo->query("SELECT categoria, COUNT(*) as total 
                                  FROM produtos 
                                  GROUP BY categoria 
                                  ORDER BY total DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getInventarioStats() {
        $stats = [
            'total_itens' => 0,
            'valor_total' => 0,
            'item_caro' => ['nome' => 'N/A', 'preco' => 0]
        ];

        // 1. Total de Itens
        $stmt_count = $this->pdo->query("SELECT COUNT(*) as total FROM produtos");
        $stats['total_itens'] = $stmt_count->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // 2. Valor Total
        $stmt_sum = $this->pdo->query("SELECT SUM(preco) as total FROM produtos");
        $stats['valor_total'] = $stmt_sum->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        
        // 3. Item Mais Caro
        $stmt_max = $this->pdo->query("SELECT nome, preco FROM produtos ORDER BY preco DESC LIMIT 1");
        $item_caro = $stmt_max->fetch(PDO::FETCH_ASSOC);
        
        if ($item_caro) {
            $stats['item_caro'] = $item_caro;
        }

        return $stats;
    }
}
?>