<?php

   require "conexaoMySql.php";

    $msgErro = "";

    $cpf  = $_POST["cpf"];

    try
    {
        $conn = conectaAoMySQL();
        
        $sql = "
               DELETE FROM Cliente WHERE cpf = '$cpf'
               ";
        
        if (!$result = $conn->query($sql))
        throw new Exception('Ocorreu uma falha ao buscar o cliente: ' . $conn->error);
       
        $array = array($result);

        echo json_encode($array);
    }

    catch (Exception $e)
{
    http_response_code(500);

    $msgErro = $e->getMessage();
    echo $msgErro;
}



?>