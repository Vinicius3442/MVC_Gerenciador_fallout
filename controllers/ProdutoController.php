<?php
// controllers/ProdutoController.php
// (Não precisa mais dos "require" aqui, pois o index.php já cuida disso)

class ProdutoController {
    private $produtoModel;

    public function __construct($pdo) {
        $this->produtoModel = new Produto($pdo);
    }

    /**
     * Função helper para carregar uma view dentro do template
     * $viewFile: O arquivo da view (ex: 'listar.php')
     * $data: Um array de dados para extrair (ex: ['produtos' => $produtos])
     */
    private function carregarViewComTemplate($viewFile, $data = []) {
        // Extrai as variáveis do array $data para que possam ser usadas na view
        // Ex: $data['produtos'] se torna a variável $produtos
        extract($data);
        
        // Captura a "ação" atual para o menu do template saber qual botão destacar
        $acao = $_GET['acao'] ?? 'listar';

        // Inicia o buffer de saída. Nada é enviado ao navegador ainda.
        ob_start();

        // 1. Inclui o conteúdo da view específica (ex: listar.php, adicionar.php)
        //    O conteúdo será armazenado no buffer.
        include "views/{$viewFile}";

        // 2. Pega o conteúdo do buffer e o armazena na variável $content
        $content = ob_get_clean();
        
        // 3. Agora, carrega o template principal.
        //    O template.php irá usar as variáveis $pageTitle, $acao, e $content.
        include 'views/template.php';
    }


    // --- NOSSAS AÇÕES ---

    // Ação: Listar produtos
    public function listar() {
        $produtos = $this->produtoModel->listar(); // Pega a lista ordenada
        
        // --- NOVO: Agrupa os produtos por categoria ---
        $produtosAgrupados = [];
        foreach ($produtos as $produto) {
            // Se a categoria for nula ou vazia, agrupa em 'Outros'
            $categoria = $produto['categoria'] ?: 'OUTROS';
            
            // Cria o array da categoria se ele não existir
            if (!isset($produtosAgrupados[$categoria])) {
                $produtosAgrupados[$categoria] = [];
            }
            // Adiciona o produto a sua categoria
            $produtosAgrupados[$categoria][] = $produto;
        }
        // --- FIM DO NOVO BLOCO ---

        $data = [
            // Envia o array AGRUPADO para a view, e não mais $produtos
            'produtosAgrupados' => $produtosAgrupados, 
            'pageTitle' => 'SISTEMA R.O.B.CO - INVENTÁRIO'
        ];
        
        $this->carregarViewComTemplate('listar.php', $data);
    }
    public function stats() {
        // Busca os dados do model
        $stimpakCount = $this->produtoModel->getCountByName('Stimpak');
        $radawayCount = $this->produtoModel->getCountByName('RadAway');

        $data = [
            'stimpakCount' => $stimpakCount,
            'radawayCount' => $radawayCount,
            'pageTitle' => 'SISTEMA R.O.B.CO - STATUS'
        ];
        // Carrega a nova view 'stats.php'
        $this->carregarViewComTemplate('stats.php', $data);
    }
    // Ação: Adicionar produto
    public function adicionar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->produtoModel->adicionar($_POST['nome'], $_POST['preco'], $_POST['categoria']);
            header('Location: index.php');
        } else {
            $data = [
                'pageTitle' => 'SISTEMA R.O.B.CO - ADICIONAR' // Título para o template
            ];
            $this->carregarViewComTemplate('adicionar.php', $data);
        }
    }

    // Ação: Editar produto
    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->produtoModel->editar($_POST['id'], $_POST['nome'], $_POST['preco'], $_POST['categoria']);
            header('Location: index.php');
        } else {
            $produto = $this->produtoModel->buscarPorId($id);
            
            // Se o produto não existir, redireciona para a home
            if (!$produto) {
                header('Location: index.php');
                exit;
            }

            $data = [
                'produto' => $produto, // Passa os dados do produto para a view
                'pageTitle' => "SISTEMA R.O.B.CO - EDITAR #{$id}" // Título para o template
            ];
            $this->carregarViewComTemplate('editar.php', $data);
        }
    }

    // Ação: Excluir produto
    public function excluir($id) {
        $this->produtoModel->excluir($id);
        header('Location: index.php');
    }
    public function mapa() {
        $data = [
            'pageTitle' => 'SISTEMA R.O.B.CO - MAPA'
        ];
        // Carrega a nova view 'mapa.php'
        $this->carregarViewComTemplate('mapa.php', $data);
    }
    public function dados() {
        // Busca os dados das duas funções do model
        $categorias = $this->produtoModel->contarPorCategoria();
        $stats = $this->produtoModel->getInventarioStats();

        $data = [
            'categorias' => $categorias,
            'stats'      => $stats, // <-- Passando as novas stats
            'pageTitle'  => 'SISTEMA R.O.B.CO - DADOS'
        ];
        
        $this->carregarViewComTemplate('dados.php', $data);
    }
    // Ação: Rádio
    public function radio() {
        $data = [
            'pageTitle' => 'SISTEMA R.O.B.CO - RÁDIO'
        ];
        // Carrega a nova view 'radio.php'
        $this->carregarViewComTemplate('radio.php', $data);
    }
}
?>