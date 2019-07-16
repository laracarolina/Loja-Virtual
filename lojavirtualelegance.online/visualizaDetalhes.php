<?php

session_start();

    require "conexaoMySql.php";
    require "classeProduto.php";

    class Cookie{
        public $nome;
        public $valor;
    }

    if(is_string(($_GET['idProduto']))){ // o id foi passado como uma string json 
     $idProduto = json_decode($_GET['idProduto']);
    }
    else{
        $idProduto = $_GET['idProduto'];
    }

     $id = intval($idProduto);
     $arrayProduto = null;

     try {
        $conn = conectaAoMySQL();
        $arrayProduto = getProdutoPeloId($conn, $id);
     }

    catch (Exception $e) {
        $msgErro = $e->getMessage();
    }



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php echo "<title> $idProduto </title>"; ?>
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

        <?php
         if(isset($_SESSION['cpfCliente'], $_SESSION['email'], $_SESSION['senha'])){
            
            include "headerCliente.php";
            include "barraDENavegacaoCliente.php";  
         }
         else{
            include "header.php";
            include "barraDeNavegacao.php";
         }
      
            include "modalCarrinho.php";
        ?>

	    <div id="corpoDaPagina" class="container corpo">
	
	        <div class="card mb-3" style="max-width: 1200px;">
		
		        <div class="row no-gutters">
		
                    <!--<div class="col-lg-1">

                        <img <img src="camisetas/c1_branca.png" alt="Branca" width="auto" class="card-img">
                        <img <img src="camisetas/c1_red.png" alt="Vermelha" width="auto" class="card-img">
                        <img <img src="camisetas/c1_cinza.png" alt="Cinza" width="auto" class="card-img">
                        <img <img src="camisetas/c1_marinho.png" alt="Marinho" width="auto" class="card-img">
                    </div>-->

                    <?php
                        if($arrayProduto != ""){
                            $caminho = "imagens/";
                            $produto = $arrayProduto[0];
                            $img = $caminho . $produto->foto;
                            $cookie = new Cookie();
                            $cookie->nome = "produto" . $produto->id;
                            $cookie->valor = $produto->id;
                            $cookieJson = json_encode($cookie);
                            $str = "oi";
                            
                            echo "<div class='col-lg-6'>
                                <img src='$img' width='500' heigth='500' class='card-img'> 
                            </div>
                            <div class='col-lg-6'>
                                <div class='card-body'>
                                    <h3 class='card-title'> $produto->nome </h3>
                                    <h4 class='card-title'> R$ $produto->preco </h4>
                                    <p class='card-text'> $produto->descricao</p>
                                    <input type='hidden' value=$produto->id id='idProduto'>
                                    <br><br><button class='btn btn-sm estilo' onclick='setCookie()'> ADICIONAR AO CARRINHO </button><br>    
                                </div>
                            </div>";
                        }
                        else{
                            echo "Não foi possível concluir a solicitação!";
                        }
                    ?>

		        </div>

	        </div>
	
        </div>

        <?php include "footer.php"; ?>

    </div>
	
</body>

</html>
