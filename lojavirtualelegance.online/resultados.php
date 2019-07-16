<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Resultados </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/eventos.js"></script>



</head>


<body>

    <div class="container-fluid">

        <?php include "header.php"; ?>

        <?php include "barraDeNavegacao.php"; ?>
		
		<?php include "modalCarrinho.php"; ?>

        <div class="container corpo">

            <h3> Resultados </h3>
            
			<br>
			
            <div class="row">

                <div class="col-md-3 centerContent">
                    <a href="basicone.php"><img float="left" src="camisetas/c1_preta.png" alt="Preta" width="250" height="250"></a>
                </div>

                <div class="col-md-7">
                    <label><a href="basicone.php"> CAMISETA LIVE BASIC ONE </a></label>
                    <br><label> Descrição </label>
                    <br><label class="text-info"> R$ 59,90 </label>
                    <br><br><button class="btn btn-sm estilo"> COMPRAR </button><br>
                </div>

                <div class="col-md-2">
                </div>

            </div>

            <br>

            <div class="row">

                <div class="col-md-3 centerContent">
					<a href="basictwo.php"><img float="left" src="camisetas/c2_red.png" alt="Vermelha" width="250" height="250"></a>
                </div>

                <div class="col-md-7">
                    <label><a href="basictwo.php"> CAMISETA LIVE BASIC TWO </a></label>
                    <br><label> Descrição </label>
                    <br><label class="text-info"> R$ 59,90 </label>
                    <br><br><button class="btn btn-sm estilo"> COMPRAR </button><br>
                </div>

                <div class="col-md-2">
                </div>

            </div>
			
			<br><br><br>
			<br><br><br>
	
			<h3 style="text-align: center"> PRODUTOS RELACIONADOS </h3>
		
			<br>
		
			<div class="row">

				<div class="col-md-3 centerContent">
					<a href="elegancethree.php"><img src="camisetas/c5_red.png" alt="Vermelha" width="250" height="250"></a>
					<br><br><a href="elegancethree.php"><label> CAMISETA ELEGANCE THREE </label></a>
					<br><label> R$ 59,90 </label>
					<br><a href="elegancethree.php"><button class="btn btn-sm estilo">COMPRAR</button></a><br>
				</div>

				<div class="col-md-3 centerContent">
					<a href="eleganceone.php"><img src="camisetas/c4_cinza.png" alt="Cinza" width="250" height="250"></a>
					<br><br><a href="eleganceone.php"><label> CAMISETA ELEGANCE ONE </label></a>
					<br><label> R$ 59,90 </label>
					<br><a href="eleganceone.php"><button class="btn btn-sm estilo">COMPRAR</button></a><br>
				</div>

				<div class="col-md-3 centerContent">
					<a href="elegancetwo.php"><img src="camisetas/c3_marinho.png" alt="Marinho" width="250" height="250"></a>
					<br><br><a href="elegancetwo.php"><label> CAMISETA ELEGANCE TWO </label></a>
					<br><label> R$ 59,90 </label>
					<br><a href="elegancetwo.php"><button class="btn btn-sm estilo"> COMPRAR </button> </a> <br>
				</div>

				<div class="col-md-3 centerContent">
					<a href="elegancethree.php"><img src="camisetas/c5_branca.png" alt="Branca" width="250" height="250"></a>
					<br><br><a href="elegancethree.php"><label> CAMISETA ELEGANCE THREE </label></a>
					<br><label> R$ 59,90 </label>
					<br><a href="elegancethree.php"><button class="btn btn-sm estilo"> COMPRAR </button> </a> <br>
				</div>

			</div>

        </div>

        <?php include "footer.php"; ?>

    </div>
	
</body>

</html>