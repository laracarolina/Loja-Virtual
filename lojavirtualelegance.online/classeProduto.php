<?php

    class Produto
    {
        public $id;
        public $nome;
        public $fabricante;
        public $descricao;
        public $preco;
        public $quantidade;
        public $foto;
    }

    function getProdutoPeloId($conn, $id)
    {
        $arrayProdutos = [];

        $SQL = "
            SELECT idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto
            FROM Produto WHERE idProduto = ?
        ";

        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->bind_param("i", $id))
            throw new Exception("Falha na operacao bind_param: " . $stmt->error);

        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($id, $nome, $fabricante, $descricao, $preco, $quantidade, $foto))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
               $produto = new Produto();

            $produto->id            = $id;
            $produto->nome          = $nome;
            $produto->fabricante         = $fabricante;
            $produto->descricao   = $descricao;
            $produto->preco = $preco;
            $produto->quantidade = $quantidade;
            $produto->foto = $foto;

                $arrayProdutos[] = $produto;
        }

        return $arrayProdutos;

    }

    function getProdutos($conn)
    {
        $arrayProdutos = [];

        $SQL = "
            SELECT idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto
            FROM Produto
            ORDER BY nome ASC;
        ";

        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($id, $nome, $fabricante, $descricao, $preco, $quantidade, $foto))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
               $produto = new Produto();

                $produto->id            = $id;
                $produto->nome          = $nome;
                $produto->fabricante         = $fabricante;
                $produto->descricao   = $descricao;
                $produto->preco = $preco;
                $produto->quantidade = $quantidade;
                $produto->foto = $foto;

                $arrayProdutos[] = $produto;
        }

        return $arrayProdutos;

    }

    function getProdutosPalavraChave($conn, $palavraChave)
    {
        $arrayProdutos = [];

        $SQL = "
            SELECT *
            FROM Produto 
            WHERE descricao like '%$palavraChave%'
        ";

        $result = $conn->query($SQL);
        if (!$result)
            throw new Exception('Ocorreu uma falha ao gerar o relatorio de testes: ' . $conn->error);

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $produto = new Produto();

                $produto->id            = $row["idProduto"];
                $produto->nome          = $row["nome"];
                $produto->fabricante         = $row["fabricante"];
                $produto->descricao   = $row["descricao"];
                $produto->preco = $row["preco"];
                $produto->quantidadeEmEstoque = $row["quantidadeEmEstoque"];
                $produto->foto = $row["foto"];

                $arrayProdutos[] = $produto;
            }
        }
        else{
            $arrayProdutos[0] = "Sem resultados para a busca";
        }

        return $arrayProdutos;

    }

    function getProdutosAdicionadosAoCarrinho($conn, $string) // $string contém os cookies que estão na forma "produto1 = 1; produto2 = 2;...."
    {
        $cookies = explode(";", $string); // cookies é um vetor onde cada posição possui um cookie

        $arrayProdutos = [];

        for($i=0;$i<count($cookies);$i++){
            $id = explode("=", $cookies[$i]); // a primeira posição de id tem o nome do cookie e a segunda posicao contem o valor, ou seja, o id do produto
           if($id[0] != "PHPSESSID"){
            $array = getProdutoPeloId($conn, intval($id[1]));
            $arrayProdutos[] = $array[0]; // adiciona o produto encontrado pelo id ao fim do arrayProdutos
        }
    }

        return $arrayProdutos;

    }

    function getNovidades($conn)
    {
        $arrayProdutos = [];

        $SQL = "
            SELECT idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto
            FROM Produto
            ORDER BY idProduto desc LIMIT 3
        ";

        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($id, $nome, $fabricante, $descricao, $preco, $quantidade, $foto))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
               $produto = new Produto();

                $produto->id            = $id;
                $produto->nome          = $nome;
                $produto->fabricante         = $fabricante;
                $produto->descricao   = $descricao;
                $produto->preco = $preco;
                $produto->quantidade = $quantidade;
                $produto->foto = $foto;

                $arrayProdutos[] = $produto;
        }

        return $arrayProdutos;

    }

    function getCamisetas($conn)
    {
        $arrayProdutos = [];

        $categoria = "Camiseta";

        $SQL = "
            SELECT idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto
            FROM Produto
            WHERE categoria = ?
            ORDER BY nome ASC;
        ";

        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->bind_param("s", $categoria))
            throw new Exception("Falha na operacao bind_param: " . $stmt->error);


        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($id, $nome, $fabricante, $descricao, $preco, $quantidade, $foto))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
               $produto = new Produto();

                $produto->id            = $id;
                $produto->nome          = $nome;
                $produto->fabricante         = $fabricante;
                $produto->descricao   = $descricao;
                $produto->preco = $preco;
                $produto->quantidade = $quantidade;
                $produto->foto = $foto;

                $arrayProdutos[] = $produto;
        }

        return $arrayProdutos;

    }


    function getMoletons($conn)
    {
        $arrayProdutos = [];

        $categoria = "Moletom";

        $SQL = "
            SELECT idProduto, nome, fabricante, descricao, preco, quantidadeEmEstoque, foto
            FROM Produto
            WHERE categoria = ?
            ORDER BY nome ASC;
        ";

        if (!$stmt = $conn->prepare($SQL))
            throw new Exception("Falha na operacao prepare: " . $conn->error);

        if (!$stmt->bind_param("s", $categoria))
            throw new Exception("Falha na operacao bind_param: " . $stmt->error);


        if (!$stmt->execute())
            throw new Exception("Falha na operacao execute: " . $stmt->error);

        if (!$stmt->bind_result($id, $nome, $fabricante, $descricao, $preco, $quantidade, $foto))
            throw new Exception("Falha na operacao bind_result: " . $stmt->error);

        // Navega pelas linhas do resultado
        while ($stmt->fetch()) {
               $produto = new Produto();

                $produto->id            = $id;
                $produto->nome          = $nome;
                $produto->fabricante         = $fabricante;
                $produto->descricao   = $descricao;
                $produto->preco = $preco;
                $produto->quantidade = $quantidade;
                $produto->foto = $foto;

                $arrayProdutos[] = $produto;
        }

        return $arrayProdutos;

    }

?>