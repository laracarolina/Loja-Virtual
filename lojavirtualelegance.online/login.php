<?php 

session_start();
    require "conexaoMySql.php";

    function filtraEntrada($dado)
    {
      $dado = trim($dado);
      $dado = stripslashes($dado);
      $dado = htmlspecialchars($dado);

      return $dado;
    }

    $msgErro = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $senha = "";

    $email = filtraEntrada($_POST['usuario']);
    $senha = filtraEntrada($_POST['senha']);

    try{
        $conn = conectaAoMySQL();

       //checkUsuarioLogadoOrDie($conn);

        $sql = "
               SELECT cpf, email, senha 
               FROM Cliente WHERE email = ?
               LIMIT 1;
               ";

               $stmt = $conn->prepare($sql);
               $stmt->bind_param('s', $email);
               $stmt->execute();
               $stmt->store_result();

               $stmt->bind_result($cpfCliente, $emailCliente, $senhaCliente);
               $stmt->fetch();

               if ($stmt->num_rows == 1)
      {

       // if (password_verify($senha, $senhaHash))
        if($senha == $senhaCliente){

          $_SESSION['cpfCliente'] = $cpfCliente;
          $_SESSION['email'] = $emailCliente;
        //  $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
           $_SESSION['senha'] = $senhaCliente;
          header("Location: /homeCliente.php");
        }
        else
        {
        $msgErro = "Senha incorreta";
        }
      }
    }

    catch (Exception $e)
    {
        $msgErro = $e->getMessage();
    }
    }

    function checkUsuarioLogado($mysqli)
    {
      // Check if all session variables are set
      if (!isset($_SESSION['cpfCliente'], $_SESSION['loginString']))
        return false;

      $cpfCliente = $_SESSION['cpfCliente'];
      $loginString = $_SESSION['senha'];

      $SQL = "
        SELECT senha 
        FROM Cliente
        WHERE cpf = ?
        LIMIT 1
      ";

      $stmt = $mysqli->prepare($SQL);
      $stmt->bind_param('s', $cpfCliente);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows == 1)
      {
        $stmt->bind_result($senhaHash);
        $stmt->fetch();

        $loginStringCheck = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);

        if (hash_equals($loginStringCheck, $loginString))
          return true;
      }

      return false;
    }

    function checkUsuarioLogadoOrDie($mysqli)
    {
      if (!checkUsuarioLogado($mysqli))
      {
        echo "vixi";
        $mysqli->close();
        header("Location: login.php");
        die();
      }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Login </title>
    <meta charset="utf-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/eventos.js"></script>
    <script src="js/buscaComAjax.js"></script>
    <link rel="shortcut icon" href="images/logo1.png" type="image/png" />

</head>

<body>

    <div class="container-fluid">

        <?php include "header.php"; ?>

        <?php include "barraDeNavegacao.php"; ?>
		
		<?php include "modalCarrinho.php"; ?>

        <div id="login">

            <div  id="corpoDaPagina" class="container corpo">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h4>Entrar na minha conta</h4><br>

                        <input type="email" name="usuario" class="form-control" placeholder="Digite seu email">
                        <br><br><input type="password" name="senha" class="form-control" placeholder="Digite sua senha">

                        <br><br><button type="submit" class="btn btn-md estilo" >ENTRAR</button>
                        <br><br><label class="fonteRoboto text-info">Não possui uma conta? <a class="text-info" href="cadastro.php"> Cadastre-se </a></label>

                </form>

            </div>

        </div>

        <br>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if ($msgErro != "")
                    echo "<h5 class='text-danger' style='text-align: center;'>Erro ao fazer login: $msgErro</h5>";

            }

        ?>
        
        <?php include "footer.php"; ?>

    </div>
	
</body>

</html>
