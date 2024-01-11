<?php 

class Produto {
    // atributos da classe Produto
    public string $nome;
    public float $preco;
    public int $quantidade;

    // contrução da classe Produto
    public function __construct($data) {
        // Inicializa um produto com os dados fornecidos
        $this->setProduto($data);
    }

    // configurar os atributos do produto
    private function setProduto($data) {
        // desestruturação do array $data para atribuir valores aos atributos
        [$this->nome, $this->preco, $this->quantidade] = $data;
    }

    // obter uma representação do produto
    public function getProduto() {
        return "Nome do Produto: {$this->nome}\nPreço: {$this->preco}\nQuantidade: {$this->quantidade}\n";
    }
}

class Venda extends Produto {
    // atributos publicos adicionais para a classe Venda
    public int $quantidadeParaVenda;
    public float $desconto;

    // construção da classe Venda
    public function __construct(array $data, int $quantidadeParaVenda, float $desconto) {
        // chama o construtor da classe pai (Produto) para configurar os atributos básicos do produto
        parent::__construct($data);
        // configura os atributos adicionais específicos da classe Venda
        $this->quantidadeParaVenda = $quantidadeParaVenda;
        $this->desconto = $desconto;
    }

    // realizar uma venda
    public function setVenda() {
        // verifica se o produto foi cadastrado
        if (!$this->nome) {
            echo "Impossível realizar a venda. Produto não cadastrado.\n";
            return;
        }

        // verifica se há estoque suficiente para a venda
        if ($this->quantidade < $this->quantidadeParaVenda) {
            echo "Impossível realizar a venda. Estoque de Produto Insuficiente.\n";
            return;
        }

        // reduz a quantidade em estoque e mostra uma mensagem de venda registrada
        $this->quantidade -= $this->quantidadeParaVenda;
        echo "Venda realizada e registrada!\n";
        
        // chama o getVenda para exibir a venda
        $this->getVenda();
    }

    // obter detalhes da venda
    public function getVenda() {
        // calcula o valor da venda com e sem desconto
        $valorSemDesconto = $this->preco * $this->quantidadeParaVenda;
        $valorComDesconto = $valorSemDesconto - ($valorSemDesconto * ($this->desconto/100));
        
        // mostra a venda, incluindo valores e estoque atualizado
        echo "Venda realizada: {$this->quantidadeParaVenda} {$this->nome} com {$this->desconto}% de desconto.\nValor sem desconto: R$ $valorSemDesconto\nValor com desconto: R$ $valorComDesconto\nEstoque atual: {$this->quantidade}\n";
    }
}

// cria uma instância de Venda com dados específicos
$venda = new Venda(["Pacotes de Arroz", 1.5, 5], 5, 10);

// Realiza a venda
$venda->setVenda();

?>