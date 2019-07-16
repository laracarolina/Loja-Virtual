<?php

    require "classeProduto.php";
	require "conexaoMySql.php";
	
	session_start();

    $arrayProdutos = null;
    $msgErro = "";

    try
    {
        $conn = conectaAoMySQL();
		$arrayProdutos = getNovidades($conn);
	;
		
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
	<script src="js/buscaComAjax.js"></script>
	<script src="js/cookie.js"></script>
    <link rel="shortcut icon" href="images/logo1.png" type="image/png" />
	
</head>

<body>

	<div class="container-fluid">

		<?php include "headerCliente.php"; ?>

        <?php include "barraDENavegacaoCliente.php"; ?>
		
		<?php include "modalCarrinho.php"; ?>
		
		<div id="corpoDaPagina" class="container corpo">

			<div class="row">
			
				<div id="carouselExampleIndicators" class="carousel slide col-lg-12" data-ride="carousel">
				
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
					</ol>
				  
					<div class="carousel-inner">
					
						<div class="carousel-item active">
                        <img class="d-block w-100" src="imagens/n1.png" alt="Novidade 1" width="auto">
						</div>
					  
						<div class="carousel-item">
                        <img class="d-block w-100" src="imagens/n2.png" alt="Novidade 2" width="auto">
						</div>
						
						<div class="carousel-item">
                        <img class="d-block w-100" src="imagens/n11.png" alt="Novidade 3" width="auto">
						</div>
						
						<div class="carousel-item">
                            <img class="d-block w-100" src="imagens/n4.png" alt="Novidade 4" width="auto">
						</div>
				
					</div>
				  
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				  
				</div>
				
			</div>

			<div id="lancamentos" style="background-color:white;width:100%;margin:0 auto;color:rgb(27, 17, 71);padding:5px" class="centerContent">

            <h2 class="centerContent" style="margin:30px;font-family:Arial; New"> LANÇAMENTOS </h2>

	        <?php

			if ($arrayProdutos != "")
			{

			$caminho = "imagens/";
			$produto1 = $arrayProdutos[0];
			$produto2 = $arrayProdutos[1];
			$produto3 = $arrayProdutos[2];

			$img1 = $caminho . $produto1->foto;
			$img2 = $caminho . $produto2->foto;
			$img3 = $caminho . $produto3->foto;

			echo "
	
				<div class='row'>
			
					<div class='col-md-4 centerContent'>
						<a href=visualizaDetalhes.php?idProduto=$produto1->id><img src='$img1' width='250' height='250'></a>
						<br><a href=visualizaDetalhes.php?idProduto=$produto1->id><label> $produto1->nome </label></a>
						<br><label class='text-info'> R$ $produto1->preco </label>
						<br><a href=visualizaDetalhes.php?idProduto=$produto1->id><button class='btn btn-sm estilo'> VER PRODUTO </button></a><br>
					</div>
		
					<div class='col-md-4 centerContent'>
					    <a href=visualizaDetalhes.php?idProduto=$produto2->id><img src='$img2' width='250' height='250'></a>
						<br><a href=visualizaDetalhes.php?idProduto=$produto2->id><label> $produto2->nome </label></a>
						<br><label class='text-info'> R$ $produto2->preco </label>
						<br><a href=visualizaDetalhes.php?idProduto=$produto2->id><button class='btn btn-sm estilo'> VER PRODUTO </button></a><br>
					</div>
					
					<div class='col-md-4 centerContent'>
					    <a href=visualizaDetalhes.php?idProduto=$produto3->id><img src='$img3' width='250' height='250'></a> 
						<br><a href=visualizaDetalhes.php?idProduto=$produto3->id><label> $produto3->nome </label></a>
						<br><label class='text-info'> R$ $produto3->preco </label>
						<br><a href=visualizaDetalhes.php?idProduto=$produto3->id><button class='btn btn-sm estilo'> VER PRODUTO </button></a><br>
					</div>

				</div>	
			";
		}
	?>

</div>


			
		</div>

        <?php include "footer.php"; ?>

    </div>

</body>

</html>
