<?php

    require "conexaoMySql.php";
    require "classeClientes.php";

    $arrayClientes = null;
    $msgErro = "";

    try
    {
        $conn = conectaAoMySQL();
        $arrayClientes = getClientes($conn);
    }

    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Clientes Cadastrados </title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/eventos.js"></script>
    <link rel="shortcut icon" href="images/logo1.png" type="image/png" />

</head>

<body>

    <div class="container-fluid">

        <?php include "headerAdmin.php"; ?>

		<?php include "barraDeNavegacaoAdmin.php"; ?>

        <div class="container corpo">

            <h3>Clientes Cadastrados</h3>

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Data de Nascimento</th>
                            <th>Profissão</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                            if ($arrayClientes != "")
                            {
                                foreach ($arrayClientes as $clientes)
                                {
                                    
                                    echo "
                                    <form 
                                        <tr>
                                            <td>$clientes->cpf</td>
                                            <td>$clientes->nome</td>
                                            <td>$clientes->email</td>
                                            <td>$clientes->telefone</td>
                                            <td>$clientes->dataNascimento</td>
                                            <td>$clientes->profissao</td>
                                            <td><a href=verPedidosCliente.php?cpfCliente=$clientes->cpf><button type=\"button\" class=\"btn btn-sm estilo\">Ver pedidos</button></a></td>
                                         <input type=\"hidden\" value=$clientes->cpf id=\"cpf\"> 
                                        <td><button type=\"button\" class=\"btn btn-sm estilo\" onclick=\"excluirCliente()\">Excluir Cliente</button></td>
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