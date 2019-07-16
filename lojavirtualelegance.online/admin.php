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

	<div class="container-fluid">

		<?php include "headerAdmin.php"; ?>

		<?php include "barraDeNavegacaoAdmin.php"; ?>

		<div class="container corpo">

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
                            <a href="moletons.php"><img class="d-block w-100" src="imagens/n1.png" alt="Novidade 1" width="auto"></a>
                        </div>

                        <div class="carousel-item">
                            <a href="camisetas.php"><img class="d-block w-100" src="imagens/n2.png" alt="Novidade 2" width="auto"></a>
                        </div>

                        <div class="carousel-item">
                            <a href="moletons.php"><img class="d-block w-100" src="imagens/n11.png" alt="Novidade 3" width="auto"></a>
                        </div>

                        <div class="carousel-item">
                            <a href="camisetas.php"><img class="d-block w-100" src="imagens/n4.png" alt="Novidade 4" width="auto"></a>
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

			<br>

		</div>

		<?php include "footer.php"; ?>

    </div>

</body>

</html>
