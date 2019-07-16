<?php

    // Arquivo com os dados e função de conexão
    require "conexaoMySql.php";
    require "classeProduto.php";

    $arrayProdutos = null;
    $msgErro = "";

    try
    {
        $conn = conectaAoMySQL();
        $arrayProdutos = getProdutos($conn);
    }
    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }

    ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Inicio </title>
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

    <?php include "headerAdmin.php"; ?>

    <?php include "barraDeNavegacaoAdmin.php"; ?>

        <div class="container corpo">

            <div class="table-responsive">

                <table class="table table-hover">

                        <thead>

                            <tr>
                                <th>Produto</th>
                                <th>Nome</th>
                                <th>Fabricante</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Quantidade em estoque</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if ($arrayProdutos != "")
                                {

                                    $caminho = "imagens/";

                                    foreach ($arrayProdutos as $produto)
                                    {
                                        $img = $caminho . $produto->foto;
                                        echo "
                                        
                                            <tr>  
                                                <td><img src='$img' width='120' height='120'></td>
                                                <td>$produto->nome</td>
                                                <td>$produto->fabricante</td>
                                                <td>$produto->descricao</td>
                                                <td>$produto->preco </td>
                                                <td>$produto->quantidade </td>
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

        <?php include "footer.php"; ?>

    </div>

</body>

</html>