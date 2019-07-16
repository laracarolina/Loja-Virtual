<?php
   
   session_start();

    require "conexaoMySql.php";
    require "retornaDadosPessoais.php";
    require "classeProduto.php";

    try
    {
        $conn = conectaAoMySQL();

        $dados = new Dados();
        $enderecoEntrega = new EnderecoDeEntrega();

        $cpfCliente = $_SESSION['cpfCliente'];
        $dados = getDados($conn, $cpfCliente);
        $enderecoEntrega = getEnderecoDeEntrega($conn, $cpfCliente);
    }

    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Concluir Pedido </title>
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

            <h3> Produtos </h3>

            <br>

            <div id="produtosDoCarrinho" class="card" style="width: 100%">
          
            <!-- os produtos serão inseridos dinamicamente com ajax-->
           <script>getProdutosAdicionados2();</script>
            </div>

            <br><br>

            <input type="hidden" id="cpfDoCliente" class="form-control" value="<?php echo $dados->cpf;?>" required>

            <h4> Endereço de Entrega </h4>

            <?php

            if($enderecoEntrega != null){

                echo "<div class='card mb-3' style='max-width: 1200px'>
                    
                        <div class='row no-gutters'>
                        
                            <div class='card-body'>
                            
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Rua: $enderecoEntrega->logradouro</p>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Bairro: $enderecoEntrega->bairro</p>
                                    </div>
                                </div>
            
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Número: $enderecoEntrega->numero</p>
                                    </div>
                                </div>
                                
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Cidade: $enderecoEntrega->cidade</p>
                                    </div>
                                </div>
                                
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Estado: $enderecoEntrega->estado</p>
                                    </div>
                                </div>
                                
                            </div>		
                            
                        </div>
                        
                    </div>";
            }

            else{
                echo "<p class='text-danger'>Erro ao recuperar informações!</p>";
            }

            ?>

            <br><br>

            <h4> Forma de Pagamento </h4>

            <div class="card" style="max-width: 400px;">

            <div class="row no-gutters">

            <div class="card-body">


                <div class="row">

                    <div class="col-lg-12">
                        <form style="font-size:20px;">
                            <input type="radio" name="pagamento" value="Boleto" checked> Boleto
                            <br><input type="radio" name="pagamento" value="Debito em Conta"> Débito em Conta
                            <br><input type="radio" name="pagamento" value="Cartao de Credito"> Cartão de crédito
                        <form>
                    </div>

                </div>

            </div>
            </div>
            </div>

            <br>

            <div class="row">

                <div class="col-lg-12">
                    <br><button class="btn btn-sm estilo" onclick="enviarPedido()" style="width:200px; height:60px; font-size:25px;"> Concluir Pedido </button>
                </div>

            </div>

        </div>
	
	
	</div>

	
	<?php include "footer.php"; ?>


    </div>
	
</body>

</html>
