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

        $cpf = $nome = $email = $senha = $telefone = $dataNascimento = $profissao =  "";
        $cep = $log = $bairro = $num = $cidade = "";
        $cep2 = $log2 = $bairro2 = $num2 = $cidade2 = "";

        $nome             = filtraEntrada($_POST["nome"]);
        $cpf              = filtraEntrada($_POST["cpf"]);
        $email            = filtraEntrada($_POST["email"]);
        $senha            = filtraEntrada($_POST["senha"]);
        $telefone         = filtraEntrada($_POST["tel"]);
        $dataNascimento   = filtraEntrada($_POST["data"]);
        $profissao        = filtraEntrada($_POST["prof"]);
        $cep              = filtraEntrada($_POST["cep"]);
        $log              = filtraEntrada($_POST["log"]);
        $bairro           = filtraEntrada($_POST["bairro"]);
        $numTemp          = filtraEntrada($_POST["num"]);
        $num              = intval($numTemp);
        $cidade           = filtraEntrada($_POST["cidade2"]);
        $estado           = filtraEntrada($_POST["estado"]);
        $cep2             = filtraEntrada($_POST["cep2"]);
        $log2             = filtraEntrada($_POST["log2"]);
        $bairro2          = filtraEntrada($_POST["bairro2"]);
        $numTemp2         = filtraEntrada($_POST["num2"]);
        $num2             = intval($numTemp2);
        $cidade2          = filtraEntrada($_POST["cidade2"]);
        $estado2          = filtraEntrada($_POST["estado2"]);

        try
        {
            $conn = conectaAoMySQL();

            $sql1 = "
                SELECT email
                FROM Cliente
                WHERE email = ?
            ";

            if (!$stmt = $conn->prepare($sql1))
                throw new Exception("Falha na operacao prepare: " . $conn->error);

            if (!$stmt->bind_param("s", $email))
                throw new Exception("Falha na operacao bind_param: " . $stmt->error);

            if (!$stmt->execute())
                throw new Exception("Falha na operacao execute: " . $stmt->error);

            if (!$stmt->bind_result($emailResult))
                throw new Exception("Falha na operacao bind_result: " . $stmt->error);

            if(!$stmt->fetch()){ // email esta disponivel

            $conn->begin_transaction();

            // $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "
                INSERT INTO Cliente (cpf, nome, email, senha, telefone, dataNascimento, profissao)
                VALUES (?, ?, ?, ?, ?, ?, ?);
            ";

            if (!$stmt = $conn->prepare($sql))
                throw new Exception("Falha na operacao prepare: " . $conn->error);

            if (!$stmt->bind_param("sssssss", $cpf, $nome, $email, $senha, $telefone, $dataNascimento, $profissao))
                throw new Exception("Falha na operacao bind_param: " . $stmt->error);

            if (!$stmt->execute())
                throw new Exception("Falha na operacao execute: " . $stmt->error);

            // ----------- inserindo endereco residencial na tabela de endereco -----------------
            $sql2 = "
                INSERT INTO EnderecoResidencial (logradouro, bairro, numero, cep, cidade, estado, cpfCliente)
                VALUES (?, ?, ?, ?, ?, ?, ?);
            ";

            if (!$stmt = $conn->prepare($sql2))
                throw new Exception("Falha na operacao prepare: " . $conn->error);

            if (!$stmt->bind_param("ssissss", $log, $bairro, $num, $cep, $cidade, $estado, $cpf))
                throw new Exception("Falha na operacao bind_param: " . $stmt->error);

            if (!$stmt->execute())
                throw new Exception("Falha na operacao execute: " . $stmt->error);

            // ----------- inserindo endereco de entrega na tabela de endereco -----------------
            $sql2 = "
                INSERT INTO EnderecoEntrega (logradouro, bairro, numero, cep, cidade, estado, cpfCliente)
                VALUES (?, ?, ?, ?, ?, ?, ?);
            ";

            if (!$stmt = $conn->prepare($sql2))
                throw new Exception("Falha na operacao prepare: " . $conn->error);

            if (!$stmt->bind_param("ssissss", $log2, $bairro2, $num2, $cep2, $cidade2, $estado2, $cpf))
                 throw new Exception("Falha na operacao bind_param: " . $stmt->error);

            if (!$stmt->execute())
                 throw new Exception("Falha na operacao execute: " . $stmt->error);

            $conn->commit();
            }

            else{
                $msgErro = "Email ja cadastrado";
            }

        }

        catch (Exception $e)
        {
            $conn->rollback();
            $msgErro = $e->getMessage();
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> Cadastro </title>
    <meta charset="utf-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/eventos.js"></script>
    <script src="js/buscaEndereco.js"></script>
    <script src="js/buscaComAjax.js"></script>
    <link rel="shortcut icon" href="images/logo1.png" type="image/png" />

</head>

<body>

    <div class="container-fluid">

        <?php include "header.php"; ?>

        <?php include "barraDeNavegacao.php"; ?>
		
		<?php include "modalCarrinho.php"; ?>

	    <div id="corpoDaPagina" class="container corpo">

		    <h3>Cadastre-se</h3>

		    <form name="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
		
			    Para realizar seu cadastro, por favor preencha os campos abaixo.<br><br>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nome"> Nome </label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cpf"> CPF </label>
                        <input type="text" class="form-control" name="cpf" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="tel"> Telefone </label>
                        <input type="text" class="form-control" name="tel" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="data"> Data de Nascimento </label>
                        <input type="data" class="form-control" name="data" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="prof"> Profissão </label>
                        <input type="text" class="form-control" name="prof" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="text-info"> <br><br> Este é o seu endereço residencial </label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="cep"> CEP (Insira no formato XXXXX-XXX)</label>
                        <input type="text" class="form-control" name="cep" onkeyup="buscaEnderecoResidencial(this.value)" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="log"> Logradouro </label>
                        <input type="text" class="form-control" name="log" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bairro"> Bairro </label>
                        <input type="text" class="form-control" name="bairro" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="num"> Número </label>
                        <input type="text" class="form-control" name="num" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estado"> Estado </label>
                        <select id="estadoSelect" name="estado" class="form-control" required>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cidade"> Cidade </label>
                        <input type="text" class="form-control" name="cidade" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="text-info"> <br><br> Este é endereço onde você receberá os produtos </label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="cep2"> CEP (Insira no formato XXXXX-XXX) </label>
                        <input type="text" class="form-control" name="cep2" onkeyup="buscaEnderecoDeEntrega(this.value)" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="log2"> Logradouro </label>
                        <input type="text" class="form-control" name="log2" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bairro2"> Bairro </label>
                        <input type="text" class="form-control" name="bairro2" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="num2"> Número </label>
                        <input type="text" class="form-control" name="num2" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estado2"> Estado </label>
                        <select id="estado2Select" name="estado2" class="form-control" required>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cidade2"> Cidade </label>
                        <input type="text" class="form-control" name="cidade2" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email"> E-mail </label>
                        <input type="email" class="form-control" name="email" placeholder="Digite o e-mail para login">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="senha"> Senha </label>
                        <input type="password" class="form-control" name="senha" placeholder="Digite a senha para login">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <button name="botaoCadastro" class="btn btn-lg estilo"> Finalizar Cadastro </button></td>
                    </div>
                </div>

            </form>


            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                        if ($msgErro == "")
                            echo "<h5 class='text-success'>Cadastro feito com sucesso! Realize seu login.</h5>";
                        else
                            echo "<h5 class='text-danger'>Cadastro não realizado: $msgErro</h5>";
                }
            ?>

	    </div>

        <?php include "footer.php"; ?>

    </div>

</body>

</html>
