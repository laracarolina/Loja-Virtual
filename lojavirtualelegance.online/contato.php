<?php

    require "conexaoMySql.php";

    function filtraEntrada($dado)
    {
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado);
        return $dado;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $msgErro = "";

        $nome = $telefone = $email = $mensagem = "";

        $nome = filtraEntrada($_POST["nome"]);
        $telefone = filtraEntrada($_POST["telefone"]);
        $email = filtraEntrada($_POST["email"]);
        $mensagem = filtraEntrada($_POST["mensagem"]);
    
        try
        {    
            $conn = conectaAoMySQL();
    
            $sql = "
                INSERT INTO Contato (idContato, nome, telefone, email, mensagem)
                VALUES (null, ?, ?, ?, ?);
            ";
    
        if (! $stmt = $conn->prepare($sql))
	       throw new Exception("Falha na operacao prepare: " . $conn->error);
	 
        if (! $stmt->bind_param("ssss", $nome, $telefone, $email, $mensagem))
           throw new Exception("Falha na operacao bind_param: " . $stmt->error);
 
        if (! $stmt->execute())
           throw new Exception("Falha na operacao execute: " . $stmt->error);

        }
        catch (Exception $e)
        {
            $msgErro = $e->getMessage();
        }
    }
  
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Contato </title>
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

            <h3> Formulário de Contato </h3>

            <form name="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nome"> Nome </label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                </div>
    
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="tel"> Telefone </label>
                        <input type="text" class="form-control" name="telefone" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email"> E-mail </label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mensagem"> Mensagem </label>
                        <input type="text" class="form-control" name="mensagem" placeholder="Deixe aqui sua mensagem">
                    </div>
                </div>
    
                <div class="row">
                    <div class="form-group col-md-6">
                    <button name="botaoEnviar" class="btn btn-lg estilo"> Enviar </button></td>
                    </div>
                </div>
        
            </form>


            <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if ($msgErro == "")
                        echo "<h5 class='text-success'>Mensagem enviada com sucesso!</h5>";
                    else
                        echo "<h5 class='text-danger'>Mensagem não enviada: $msgErro</h5>";
                }

            ?>

        </div>

        <?php include "footer.php"; ?>

    </div>

</body>

</html>
