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

        // Define e inicializa as variáveis
        $nome = $fab = $preco = $qde = $descricao = $categoria =  "";

        $nome = filtraEntrada($_POST["nome"]);
        $fab = filtraEntrada($_POST["fab"]);
        $preco1 = filtraEntrada($_POST["preco"]);
        $preco = doubleval($preco1);
        $qde = filtraEntrada($_POST["qde"]);
        $quantidade = intval($qde);
        $descricao = filtraEntrada($_POST["descricao"]);
        $categoria = filtraEntrada($_POST["categoria"]);

       /*if($imagem != null){
        $nomeFinal = time().'.jpg';
        if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
            $tamanhoImg = filesize($nomeFinal);

            $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));
    */

    if(isset($_FILES['foto']))
    {
        $ext = strtolower(substr($_FILES['foto']['name'],-4));
        $nome_foto = date("Y.m.d-H.i.s") . $ext;
        $dir = './imagens/';
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$nome_foto);
     }

    else{
        echo "Falha";
    }
        try
        {
            $conn = conectaAoMySQL();

            /* $sql = "
                INSERT INTO Produto (idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto)
                 VALUES (null, '$nome', '$fab', '$descricao', '$preco', '$quantidade', '$nome_foto');
            ";*/
            $sql = "
                INSERT INTO Produto (idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto, categoria)
                VALUES (null, ?, ?, ?, ?, ?, ?, ?);
            ";

            if (!$stmt = $conn->prepare($sql))
                throw new Exception("Falha na operacao prepare: " . $conn->error);

            if (!$stmt->bind_param("sssdiss", $nome, $fab, $descricao, $preco, $quantidade, $nome_foto, $categoria))
                throw new Exception("Falha na operacao bind_param: " . $stmt->error);

            if (!$stmt->execute())
                throw new Exception("Falha na operacao execute: " . $stmt->error);

            /*  if (! $conn->query($sql))
                throw new Exception("Falha na inserção dos dados: " . $conn->error);*/
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

    <title> Cadastro de Produto </title>
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

            <h3>Cadastrar Produto</h3>

            <form name="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            
                Para realizar o cadastro do produto, por favor preencha os campos abaixo.<br><br>
    
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nome"> Nome de identificação </label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fab"> Fabricante </label>
                        <input type="text" class="form-control" name="fab" required>
                    </div>
                </div>
    
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="preco"> Preço </label>
                        <input type="text" class="form-control" name="preco" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="qde"> Quantidade em estoque </label>
                        <input type="text" class="form-control" name="qde" required>
                    </div>
    
                    <div class="form-group col-md-3">
                        <label for="foto"> Foto do produto </label>
                        <input type="file" class="form-control" name="foto" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="categoria"> Categoria </label>
                        <select name="categoria" class="form-control" required>
                                 <option value="Camiseta">Camiseta</option>
                                 <option value="Moletom">Moletom</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="descricao"> Descrição </label>
                        <textarea  name="descricao" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <button type="submit" name="botaoCadastroProduto" class="btn btn-lg estilo"> Finalizar Cadastro </button></td>
                    </div>
                </div>

            </form>

            <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if ($msgErro == "")
                        echo "<h5 class='text-success'> Produto cadastrado com sucesso! </h5>";
                    else
                        echo "<h5 class='text-danger'> Cadastro não realizado: $msgErro</h5>";
                }

            ?>

        </div>

        <?php include "footer.php"; ?>

    </div>

</body>

</html>
