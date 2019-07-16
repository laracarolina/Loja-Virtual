<?php

    require "classeProduto.php";
    require "conexaoMySql.php";

    $arrayProdutos = null;
    $msgErro = "";

    try
    {
        $conn = conectaAoMySQL();
        $arrayProdutos = getCamisetas($conn);
    }

    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

	<title> Camisetas </title>
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
    <link rel="shortcut icon" href="images/logo1.png" type="image/png" />

</head>

<body>

	<div class="container-fluid">

	    <?php include "header.php"; ?>

        <?php include "barraDeNavegacao.php"; ?>

        <?php include "modalCarrinho.php"; ?>

		<div id="corpoDaPagina" class="container corpo">

			<?php

			    if ($arrayProdutos != "") {
				    $caminho = "imagens/";

				    for ($i = 0; $i < count($arrayProdutos); $i = $i + 4) {
				        $produto1 = $arrayProdutos[$i];
				        $produto2 = $arrayProdutos[$i + 1];
				        $produto3 = $arrayProdutos[$i + 2];
				        $produto4 = $arrayProdutos[$i + 3];

				        $img1 = $caminho . $produto1->foto;
				        $img2 = $caminho . $produto2->foto;
				        $img3 = $caminho . $produto3->foto;
				        $img4 = $caminho . $produto4->foto;

				        echo "<div class='row'>";

				        if ($produto1 != null) {
				            echo "
                                <div class='col-md-3 centerContent'>
                                    <a href=visualizaDetalhes.php?idProduto=$produto1->id><img src='$img1' width='200' height='200'></a> 
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto1->id><label> $produto1->nome </label></a>
                                    <br><label class='text-info'> R$ $produto1->preco </label>
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto1->id><button class='btn btn-sm estilo'> VER PRODUTO </button></a><br>
                                </div>
                            ";
				        } else {
				            echo "    
                                <div class='col-md-3 centerContent'>
                                </div>
                            ";
				        }

				        if ($produto2 != null) {
				            echo "
                                <div class='col-md-3 centerContent'>
                                    <a href=visualizaDetalhes.php?idProduto=$produto2->id><img src='$img2' width='200' height='200'></a> 
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto2->id><label> $produto2->nome </label></a>
                                    <br><label class='text-info'> R$ $produto2->preco </label>
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto2->id><button class='btn btn-sm estilo'> VER PRODUTO </button></a><br>
                                </div>
                            ";
				        } else {
				            echo "
                                <div class='col-md-3 centerContent'>	
                                </div>
                            ";
				        }

				        if ($produto3 != null) {
                            echo "
                                <div class='col-md-3 centerContent'>
                                    <a href=visualizaDetalhes.php?idProduto=$produto3->id><img src='$img3' width='200' height='200'></a>
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto3->id><label> $produto3->nome </label></a>
                                    <br><label class='text-info'> R$ $produto3->preco </label>
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto3->id><button class='btn btn-sm estilo'> VER PRODUTO </button></a><br>
                                </div>
                            ";
				        } else {
				            echo "
                                <div class='col-md-3 centerContent'>
                                </div>
	                        ";
				        }

				        if ($produto4 != null) {
                            echo "
                                <div class='col-md-3 centerContent'>
                                    <a href=visualizaDetalhes.php?idProduto=$produto4->id><img src='$img4' width='200' height='200'></a>
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto4->id><label> $produto4->nome </label></a>
                                    <br><label class='text-info'> R$ $produto4->preco </label>
                                    <br><a href=visualizaDetalhes.php?idProduto=$produto4->id><button class='btn btn-sm estilo'> VER PRODUTO </button></a><br>
                                </div>
                            ";
				        } else {
				            echo "
                                <div class='col-md-3 centerContent'>  
                                </div>
                            ";
				        }
				        echo "</div>";
				    }
			    }

			?>

		</div>

		<?php include "footer.php"; ?>

	</div>

</body>

</html>