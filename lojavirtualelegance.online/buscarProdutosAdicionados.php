<?php

    require "conexaoMySql.php";
    require "classeProduto.php";

    try{
        $conn = conectaAoMySQL();
        $arrayProdutos = null;
        $string = $_GET["string"]; 
        $arrayProdutos = getProdutosAdicionadosAoCarrinho($conn, $string);
        $array = json_encode($arrayProdutos);
        echo $array;

    }

    catch (Exception $e)
    {
        http_response_code(500);

        $msgErro = $e->getMessage();
        echo $msgErro;
    }

?>