<?php

    require "conexaoMySql.php";
    require "retornaDadosPessoais.php";

    try
    {
        $conn = conectaAoMySQL();

        session_start();

        $dados = new Dados();
        $enderecoResidencial = new EnderecoResidencial();
        $enderecoEntrega = new EnderecoDeEntrega();

        //if (isset($_SESSION['cpfCliente'], $_SESSION['email'], $_SESSION['senha'])){
        $cpfCliente = $_SESSION['cpfCliente'];
        $dados = getDados($conn, $cpfCliente);
        $enderecoEntrega = getEnderecoDeEntrega($conn, $cpfCliente);
        $enderecoResidencial = getEnderecoResidencial($conn, $cpfCliente);

    }

    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Dados Pessoais </title>
    <meta charset="utf-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/eventos.js"></script>
    <script src="js/cookie.js"></script>
    <link rel="shortcut icon" href="images/logo1.png" type="image/png" />

	<script src="js/buscaComAjax.js"></script>

</head>

<body>

	<div class="container-fluid">

		<?php include "headerCliente.php"; ?>

        <?php include "barraDENavegacaoCliente.php"; ?>
        
        <?php include "modalCarrinho.php"; ?>

	    <div id="corpoDaPagina" class="container corpo">
	
		    <h3> Meus Dados </h3>

            <?php

                if($dados != null && $enderecoEntrega != null && $enderecoResidencial != null){


                    echo "<div class='card mb-3' style='max-width: 1200px'>
                    
                        <div class='row no-gutters'>
                        
                            <div class='card-body'>
                            
                                <div class='row'>
                                    <div class='col-lg-12'>
                                        <h3 class='card-title text-align='center'>$dados->nome</h3><br>
                                    </div>
                                </div>
            
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <h5 class='text-info'>Dados pessoais</h3>
                                    </div>
                                    <div class='col-lg-4'>
                                        <h5 class='text-info'>Endereço Residencial</h3>
                                    </div>
                                    <div class='col-lg-4'>
                                        <h5 class='text-info'>Endereço De Entrega</h3>
                                    </div>
                                </div>
                                
                                <br>
                                
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>CPF: $dados->cpf </p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Rua: $enderecoResidencial->logradouro</p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Rua: $enderecoEntrega->logradouro</p>
                                    </div>
                                </div>
                                
                                
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Email: $dados->email </p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Bairro: $enderecoResidencial->bairro</p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Bairro: $enderecoEntrega->bairro</p>
                                    </div>
                                </div>
            
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Telefone: $dados->telefone </p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Número: $enderecoResidencial->numero</p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Número: $enderecoEntrega->numero</p>
                                    </div>
                                </div>
                                
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Profissao: $dados->profissao </p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Cidade: $enderecoResidencial->cidade</p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Cidade: $enderecoEntrega->cidade</p>
                                    </div>
                                </div>
                            
                                <div class='row'>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Data de Nascimento: $dados->dataNascimento </p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Estado: $enderecoResidencial->estado</p>
                                    </div>
                                    <div class='col-lg-4'>
                                        <p class='card-text'>Estado: $enderecoEntrega->estado</p>
                                    </div>
                                </div>
                
                                <br>
                                
                                <div class='row'>
                                    <div class='col-lg-12'>
                                        <br><a href=alterarDados.php?cpfCliente=$dados->cpf><button class='btn btn-sm estilo'> Alterar Cadastro </button></a>
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

        </div>

        <?php include "footer.php"; ?>

    </div>
	
</body>

</html>
