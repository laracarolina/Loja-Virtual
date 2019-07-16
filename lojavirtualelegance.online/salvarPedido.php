<?php

    require "conexaoMySql.php";
    require "classeProduto.php";

    class Mensagem{
        public $mensagem;
    }

    $arrayProdutos = null;
    $string = $_GET["string"]; 
    $cpfCliente = $_GET["cpfCliente"];
    $formaPagamento = $_GET["formaPagamento"];

    //determinando data e hora do pedido
    $data = getDate();
    $ano = $data["year"];
    $mes = $data["mon"];
    $dia = $data["mday"];
    $datafinal = $dia . "/" . $mes . "/" . $ano;
    $hora = $data["hours"];
    $min = $data["minutes"];
    $sec = $data["seconds"];
    $horafinal = $hora . ":" . $min . ":" . $sec;


    try{
        $conn = conectaAoMySQL();
        $arrayProdutos = getProdutosAdicionadosAoCarrinho($conn, $string);

        $valorTotal = 0.0;
        foreach ($arrayProdutos as $produto){
        $valorTotal = $valorTotal + doubleval($produto->preco);
        }

        $conn->begin_transaction();

        $sql = "
        INSERT INTO Pedido (idPedido, cpfCliente, formaPagamento, valor, dataPedido, horaPedido)
        VALUES (null, ?, ?, ?, ?, ?);
    ";

    if (! $stmt = $conn->prepare($sql))
    throw new Exception("Falha na operacao prepare: " . $conn->error);

    if (! $stmt->bind_param("ssdss", $cpfCliente, $formaPagamento, $valorTotal, $datafinal, $horafinal))
    throw new Exception("Falha na operacao bind_param: " . $stmt->error);

    if (! $stmt->execute())
    throw new Exception("Falha na operacao execute: " . $stmt->error);

    // consultando ultimo idPedido inserido
    $sql2 = "
          SELECT idPedido FROM Pedido 
          ORDER BY idPedido DESC LIMIT 1";

          $result = $conn->query($sql2);

          $row = $result->fetch_assoc();
          $idPedido = $row["idPedido"];     

    // inserindo na tabela PedidoProduto
    foreach ($arrayProdutos as $produto){


        $sql3 = "
        INSERT INTO PedidoProduto (idPedido, idProduto)
        VALUES ('$idPedido', '$produto->id')
        ";

     $result = $conn->query($sql3);

    }
    $conn->commit();

    $msg = new Mensagem();
    
    $msg->mensagem = "Pedido realizado com sucesso!";
    echo json_encode($msg);
  }

    catch (Exception $e)
    {

        $conn->rollback();
        http_response_code(500);
        $msgErro = $e->getMessage();
        echo $msgErro;
    }

?>