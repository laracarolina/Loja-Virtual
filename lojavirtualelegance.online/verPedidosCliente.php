<?php

    require "conexaoMySql.php";
    require "classePedidoCliente.php";
    require "retornaDadosPessoais.php";

    $arrayPedidos = null;
    $msgErro = "";

    try
    {
        $conn = conectaAoMySQL();
        $cpf = $_GET['cpfCliente'];
        $dados = getDados($conn, $cpf);
    }

    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Meus Pedidos </title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/eventos.js"></script>
    <script src="js/buscaComAjax.js"></script>
    <script src="js/cookie.js"></script>


</head>

<body>


    <div class="container-fluid">


        <?php include "headerAdmin.php"; ?>

    
        <?php include "barraDeNavegacaoAdmin.php"; ?>


        <div id="corpoDaPagina" class="container corpo">

            <h3> Meus Pedidos </h3> <br>

            <div class="table-responsive">

                <table class="table table-striped table-hover">
                    
					<thead>
					
                        <tr>
                            <th> CPF do Cliente  </th>
							<th> Data Pedido</th>
                            <th> Hora Pedido </th>
                            <th> Forma de Pagamento </th>
                            <th> Valor Total </th>
                        </tr>
						
                    </thead>

                    <tbody>
                    <?php
                      $arrayPedidos = getPedidosCliente($conn, $cpf);
                    if ($arrayPedidos != "")
                    {
                        foreach ($arrayPedidos as $pedido)
                        {
                        
                            echo "
                                        <tr>
                                            <td> $pedido->cpfCliente </td>
                                            <td>$pedido->data</td>
                                            <td>$pedido->hora</td>
                                            <td>$pedido->formaPagamento</td>
                                            <td>$pedido->valor</td>
                                            <td><button type=\"button\" class=\"btn btn-sm estilo\">Ver Produtos</button></td>
                                        </tr> 
                                    ";
                        }
                    }
                    ?>

                    </tbody>

                </table>

                
                

                <?php
                if ($msgErro != "")
                    echo "<p class='text-danger'>A operação não pode ser realizada: $msgErro</p>";
                ?>
				
            </div>

        </div>

        <?php include "footer.php"; ?>

    </div>

</body>

</html>