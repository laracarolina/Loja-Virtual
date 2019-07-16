<?php


class classePedido
{

    public $idPedido;
    public $cpfCliente;
    public $Cliente;
    public $Data;
    public $Quantidade;
    public $Preco;
    public $FormaPagamento;

}

function getPedidos($conn)
{
    $arrayPedidos = [];

    $SQL = "
            SELECT *
            FROM Pedido
            ORDER BY idPedido ASC;
        ";

    $result = $conn->query($SQL);
    if (! $result)
        throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $pedidos = new classePedido();

            $pedidos->idPedido = $row["idPedido"];
            $pedidos->cpfCliente = $row["cpfCliente"];
            $pedidos->Cliente = $row["Cliente"];
            $pedidos->Data = $row["Data"];
            $pedidos->Quantidade = $row["Quantidade"];
            $pedidos->Preco = $row["Preco"];
            $pedidos->FormaPagamento = $row["FormaPagamento"];

            $arrayPedidos[] = $pedidos;
        }
    }

    return $arrayPedidos;

}

?>