<?php


class Pedido
{

    public $idPedido;
    public $cpfCliente;
    public $data;
    public $hora;
    public $valor;
    public $formaPagamento;
}

class Produto
    {
        public $id;
        public $nome;
        public $fabricante;
        public $descricao;
        public $preco;
        public $quantidade;
        public $foto;
    
}

function getPedidos($conn)
{
    $arrayPedidos = [];

    $SQL = "
            SELECT idPedido, cpfCliente, formaPagamento, valor, dataPedido, horaPedido                         
            FROM Pedido
        ";

   
        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($idPedido, $cpfCliente, $formaPagamento, $valor, $data, $hora))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
               $pedido = new Pedido();

                $pedido->idPedido            = $idPedido;
                $pedido->cpfCliente          = $cpfCliente;
                $pedido->data         = $data;
                $pedido->hora   = $hora;
                $pedido->valor = $valor;
                $pedido->formaPagamento = $formaPagamento;

                $arrayPedidos[] = $pedido;
        }

        return $arrayPedidos;

}

function getProdutosPedido($conn, $idPedido)
{
    $arrayProdutos= [];
    $array = null;

    $SQL = "
            SELECT idProduto                        
            FROM PedidoProduto WHERE idPedido = $idPedido
        ";

   
        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($idProduto))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
                $produto = new Produto();
                $id  = $idProduto;
                $array = getProdutoPeloId($conn, $id);
                $arrayProdutos[] = $array[0];
        }

        return $arrayProdutos;

}

function getPedidosCliente($conn, $cpfCliente){
 
    $arrayPedidos = [];

    $SQL = "
            SELECT idPedido, cpfCliente, formaPagamento, valor, dataPedido, horaPedido                         
            FROM Pedido WHERE cpfCliente = '$cpfCliente'
        ";

   
        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($idPedido, $cpfCliente, $formaPagamento, $valor, $data, $hora))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
                $pedido = new Pedido();
                $pedido->idPedido            = $idPedido;
                $pedido->cpfCliente          = $cpfCliente;
                $pedido->data         = $data;
                $pedido->hora   = $hora;
                $pedido->valor = $valor;
                $pedido->formaPagamento = $formaPagamento;

                $arrayPedidos[] = $pedido;
        }
        return $arrayPedidos;

}

function getProdutoPeloId($conn, $id)
    {
        $arrayProdutos = [];

        $SQL = "
            SELECT idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto
            FROM Produto WHERE idProduto = ?
        ";

        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->bind_param("i", $id))
            throw new Exception("Falha na operacao bind_param: " . $stmt->error);

        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($id, $nome, $fabricante, $descricao, $preco, $quantidade, $foto))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
               $produto = new Produto();

            $produto->id            = $id;
            $produto->nome          = $nome;
            $produto->fabricante    = $fabricante;
            $produto->descricao   = $descricao;
            $produto->preco = $preco;
            $produto->quantidade = $quantidade;
            $produto->foto = $foto;

                $arrayProdutos[] = $produto;
        }

        return $arrayProdutos;

    }

?>